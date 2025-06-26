<?php

namespace App\Http\Controllers;

use App\Models\RegistroRiego;
use App\Models\ZonaRiego;
use Illuminate\Http\Request;

class RegistroRiegoController extends Controller
{
    /**
     * Muestra el formulario para crear un nuevo registro de riego para una zona específica.
     */
    public function create(Request $request)
    {
        $zona = ZonaRiego::findOrFail($request->zona);
        return view('registros.create', compact('zona'));
    }

    /**
     * Guarda el nuevo registro en la base de datos.
     */
    public function store(Request $request, ZonaRiego $zona)
    {
        $request->validate([
            'fecha_hora' => 'required|date',
            'cantidad_agua' => 'required|numeric|min:0',
        ]);

        // Creamos el nuevo registro y le asignamos el ID del usuario actual.
        $zona->registros()->create([
            'user_id' => auth()->id(),
            'fecha_hora' => $request->fecha_hora,
            'cantidad_agua' => $request->cantidad_agua,
        ]);

        return redirect()->route('zonas.show', $zona)->with('success', 'Riego registrado con éxito.');
    }

    /**
     * Elimina un registro de riego.
     */
    public function destroy(RegistroRiego $registro)
    {
        $zonaId = $registro->zona_riego_id;
        $registro->delete();
        return redirect()->route('zonas.show', $zonaId)->with('success', 'Registro de riego eliminado.');
    }
}
