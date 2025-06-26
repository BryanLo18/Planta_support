<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detalle de: {{ $zona->nombre_zona }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                    <p>{{ session('success') }}</p>
                </div>
            @endif
            <!-- Detalles de la Zona -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Información General</h3>
                <p><strong>Tipo de Cultivo:</strong> {{ $zona->tipo_cultivo }}</p>
                <p><strong>Ubicación:</strong> {{ $zona->ubicacion ?? 'No especificada' }}</p>
            </div>

            <!-- Horarios de Riego -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-medium text-gray-900">Horarios de Riego Programados</h3>
                    <a href="{{ route('zonas.horarios.create', ['zona' => $zona->id]) }}"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-sm">Añadir
                        Horario</a>
                </div>

                <div class="divide-y divide-gray-200">
                    @forelse($zona->horarios as $horario)
                        <div class="flex justify-between items-center py-3">
                            <div>
                                <span class="font-semibold">{{ $horario->dia_semana }}</span> a las <span
                                    class="font-mono">{{ \Carbon\Carbon::parse($horario->hora_inicio)->format('h:i A') }}</span>
                                <span class="text-sm text-gray-500"> (durante {{ $horario->duracion_minutos }}
                                    min)</span>
                            </div>
                            <div class="flex items-center space-x-4">
                                <a href="{{ route('horarios.edit', $horario) }}"
                                    class="text-sm text-yellow-600 hover:text-yellow-900">Editar</a>
                                <form action="{{ route('horarios.destroy', $horario) }}" method="POST"
                                    onsubmit="return confirm('¿Eliminar este horario?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="text-sm text-red-500 hover:text-red-800">Eliminar</button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <p class="py-3 text-gray-500">No hay horarios programados para esta zona.</p>
                    @endforelse
                </div>
            </div>


            <!-- Pega este bloque al final, dentro del div con la clase `max-w-7xl` -->

            <!-- Historial de Riegos -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-medium text-gray-900">Historial de Riegos Recientes</h3>
                    <a href="{{ route('zonas.registros.create', ['zona' => $zona->id]) }}"
                        class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded text-sm">Añadir
                        Registro</a>
                </div>

                <div class="divide-y divide-gray-200">
                    @forelse($zona->registros->sortByDesc('fecha_hora') as $registro)
                        <div class="flex justify-between items-center py-3">
                            <div>
                                <p class="font-semibold">{{ $registro->cantidad_agua }} Litros</p>
                                <p class="text-sm text-gray-500">
                                    Registrado por {{ $registro->user->name ?? 'N/A' }}
                                    el
                                    {{ \Carbon\Carbon::parse($registro->fecha_hora)->format('d/m/Y \a \l\a\s H:i') }}
                                </p>
                            </div>
                            <form action="{{ route('registros.destroy', $registro) }}" method="POST"
                                onsubmit="return confirm('¿Eliminar este registro?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-xs text-red-500 hover:text-red-800">Eliminar</button>
                            </form>
                        </div>
                    @empty
                        <p class="py-3 text-gray-500">Todavía no hay registros de riego para esta zona.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
