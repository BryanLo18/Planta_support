<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editando Horario en: {{ $horario->zonaRiego->nombre_zona }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('horarios.update', $horario) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div>
                            <x-input-label for="dia_semana" :value="__('Día de la Semana')" />
                            <select name="dia_semana" id="dia_semana" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                @foreach(['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'] as $dia)
                                    <option value="{{ $dia }}" @selected(old('dia_semana', $horario->dia_semana) == $dia)>{{ $dia }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mt-4">
                            <x-input-label for="hora_inicio" :value="__('Hora de Inicio')" />
                            <x-text-input id="hora_inicio" class="block mt-1 w-full" type="time" name="hora_inicio" :value="old('hora_inicio', $horario->hora_inicio)" required />
                        </div>
                        <div class="mt-4">
                            <x-input-label for="duracion_minutos" :value="__('Duración (minutos)')" />
                            <x-text-input id="duracion_minutos" class="block mt-1 w-full" type="number" name="duracion_minutos" :value="old('duracion_minutos', $horario->duracion_minutos)" required min="1" />
                        </div>
                         <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('zonas.show', $horario->zonaRiego) }}" class="text-gray-600 hover:text-gray-900 mr-4">Cancelar</a>
                            <x-primary-button>
                                {{ __('Actualizar Horario') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>