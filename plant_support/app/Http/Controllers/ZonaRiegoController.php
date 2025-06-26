<?php

namespace App\Http\Controllers;

use App\Models\ZonaRiego;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate; // <-- Importante añadir esta línea

class ZonaRiegoController extends Controller
{
    // index(), create(), store() y show() se quedan como están, abiertos a todos.

    public function index()
    {
        $zonas = ZonaRiego::with('user')->latest()->paginate(10);
        return view('zonas.index', compact('zonas'));
    }

    public function create()
    {
        return view('zonas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_zona' => 'required|string|max:255',
            'ubicacion' => 'nullable|string|max:255',
            'tipo_cultivo' => 'required|string|max:255',
        ]);
        $request->user()->zonasRiego()->create($request->all());
        return redirect()->route('zonas.index')->with('success', 'Zona de riego creada con éxito.');
    }

    public function show(ZonaRiego $zona)
    {
        $zona->load('horarios', 'registros');
        return view('zonas.show', compact('zona'));
    }
    
    // edit() también se queda abierto para que todos vean el formulario, pero la acción de guardar estará protegida.
    public function edit(ZonaRiego $zona)
    {
        return view('zonas.edit', compact('zona'));
    }

    /**
     * Actualiza una zona. ESTA ACCIÓN ESTÁ PROTEGIDA.
     */
    public function update(Request $request, ZonaRiego $zona)
    {
        // Solo los usuarios que pasen el Gate 'manage-zones' (admins) pueden continuar.
        Gate::authorize('manage-zones');

        $request->validate([
            'nombre_zona' => 'required|string|max:255',
            'ubicacion' => 'nullable|string|max:255',
            'tipo_cultivo' => 'required|string|max:255',
        ]);

        $zona->update($request->all());

        return redirect()->route('zonas.index')->with('success', 'Zona de riego actualizada con éxito.');
    }

    /**
     * Elimina una zona. ESTA ACCIÓN ESTÁ PROTEGIDA.
     */
    public function destroy(ZonaRiego $zona)
    {
        // Solo los usuarios que pasen el Gate 'manage-zones' (admins) pueden continuar.
        Gate::authorize('manage-zones');

        $zona->delete();
        return redirect()->route('zonas.index')->with('success', 'Zona de riego eliminada con éxito.');
    }
}