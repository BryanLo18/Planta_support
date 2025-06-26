<?php

namespace App\Http\Controllers;

use App\Models\ZonaRiego;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ZonaRiegoController extends Controller
{
    // Métodos relacionados con la gestión de zonas de riego

    public function index()
    {
        $zonas = ZonaRiego::with('user')->latest()->paginate(10);
        return view('zonas.index', compact('zonas'));
    }

    public function create()
    {
        return view('zonas.create');
    }

    public function show(ZonaRiego $zona)
    {
        $zona->load('horarios', 'registros');
        return view('zonas.show', compact('zona'));
    }

    public function edit(ZonaRiego $zona)
    {
        return view('zonas.edit', compact('zona'));
    }

    /**
     * Guarda la nueva zona con los campos adicionales.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre_zona' => 'required|string|max:255',
            'ubicacion' => 'nullable|string|max:255',
            'tipo_cultivo' => 'required|string|max:255',
            'area_metros' => 'nullable|numeric|min:0',
            'estado' => 'required|string|in:Activo,Inactivo,Mantenimiento',
        ]);

        $request->user()->zonasRiego()->create($request->all());

        return redirect()->route('zonas.index')->with('success', 'Zona de riego creada con éxito.');
    }

    /**
     * Actualiza una zona con los campos adicionales.
     */
    public function update(Request $request, ZonaRiego $zona)
    {
        Gate::authorize('manage-zones');

        $request->validate([
            'nombre_zona' => 'required|string|max:255',
            'ubicacion' => 'nullable|string|max:255',
            'tipo_cultivo' => 'required|string|max:255',
            'area_metros' => 'nullable|numeric|min:0',
            'estado' => 'required|string|in:Activo,Inactivo,Mantenimiento',
        ]);

        $zona->update($request->all());

        return redirect()->route('zonas.index')->with('success', 'Zona de riego actualizada con éxito.');
    }

    // ... (el método destroy se mantiene igual)
    public function destroy(ZonaRiego $zona)
    {
        Gate::authorize('manage-zones');

        $zona->delete();
        return redirect()->route('zonas.index')->with('success', 'Zona de riego eliminada con éxito.');
    }
}
