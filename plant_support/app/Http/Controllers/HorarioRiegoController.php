<?php

namespace App\Http\Controllers;

use App\Models\HorarioRiego;
use App\Models\ZonaRiego;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;


class HorarioRiegoController extends Controller
{
    public function create(Request $request)
    {
        $zona = ZonaRiego::findOrFail($request->zona);
        Gate::authorize('update', $zona); // Solo el dueño de la zona puede añadir horarios
        return view('horarios.create', compact('zona'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'zona_riego_id' => 'required|exists:zona_riegos,id',
            'dia_semana' => 'required|string',
            'hora_inicio' => 'required|date_format:H:i',
            'duracion_minutos' => 'required|integer|min:1',
        ]);

        $zona = ZonaRiego::findOrFail($request->zona_riego_id);
        Gate::authorize('update', $zona);

        $zona->horarios()->create($request->all());

        return redirect()->route('zonas.show', $zona)->with('success', 'Horario añadido con éxito.');
    }

    public function edit(HorarioRiego $horario)
    {
        Gate::authorize('update', $horario->zonaRiego);
        return view('horarios.edit', compact('horario'));
    }

    public function update(Request $request, HorarioRiego $horario)
    {
        Gate::authorize('update', $horario->zonaRiego);

        $request->validate([
            'dia_semana' => 'required|string',
            'hora_inicio' => 'required|date_format:H:i',
            'duracion_minutos' => 'required|integer|min:1',
        ]);

        $horario->update($request->all());
        
        return redirect()->route('zonas.show', $horario->zona_riego_id)->with('success', 'Horario actualizado con éxito.');
    }

    public function destroy(HorarioRiego $horario)
    {
        Gate::authorize('delete', $horario->zonaRiego);
        $zonaId = $horario->zona_riego_id;
        $horario->delete();
        return redirect()->route('zonas.show', $zonaId)->with('success', 'Horario eliminado con éxito.');
    }
}