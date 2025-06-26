<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Añadir Horario a: {{ $zona->nombre_zona }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- LÍNEA CORREGIDA: Se pasa $zona como parámetro a la ruta --}}
                    <form action="{{ route('zonas.horarios.store', $zona) }}" method="POST">
                        @csrf
                        {{-- El ID de la zona ahora se obtiene de la URL, pero lo dejamos en el POST por si el controlador lo necesita directamente del request --}}
                        <input type="hidden" name="zona_riego_id" value="{{ $zona->id }}">

                        <div>
                            <x-input-label for="dia_semana" :value="__('Día de la Semana')" />
                            <select name="dia_semana" id="dia_semana" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                <option>Lunes</option>
                                <option>Martes</option>
                                <option>Miércoles</option>
                                <option>Jueves</option>
                                <option>Viernes</option>
                                <option>Sábado</option>
                                <option>Domingo</option>
                            </select>
                            <x-input-error :messages="$errors->get('dia_semana')" class="mt-2" />
                        </div>
                        <div class="mt-4">
                            <x-input-label for="hora_inicio" :value="__('Hora de Inicio')" />
                            <x-text-input id="hora_inicio" class="block mt-1 w-full" type="time" name="hora_inicio" required />
                            <x-input-error :messages="$errors->get('hora_inicio')" class="mt-2" />
                        </div>
                        <div class="mt-4">
                            <x-input-label for="duracion_minutos" :value="__('Duración (minutos)')" />
                            <x-text-input id="duracion_minutos" class="block mt-1 w-full" type="number" name="duracion_minutos" required min="1" />
                            <x-input-error :messages="$errors->get('duracion_minutos')" class="mt-2" />
                        </div>
                         <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('zonas.show', $zona) }}" class="text-gray-600 hover:text-gray-900 mr-4">Cancelar</a>
                            <x-primary-button>
                                {{ __('Guardar Horario') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>