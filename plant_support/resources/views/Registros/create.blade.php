<!-- En resources/views/registros/create.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Registrar Riego en: {{ $zona->nombre_zona }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('zonas.registros.store', $zona) }}" method="POST">
                        @csrf
                        <div class="mt-4">
                            <x-input-label for="fecha_hora" :value="__('Fecha y Hora del Riego')" />
                            <x-text-input id="fecha_hora" class="block mt-1 w-full" type="datetime-local" name="fecha_hora" :value="now()->format('Y-m-d\TH:i')" required />
                            <x-input-error :messages="$errors->get('fecha_hora')" class="mt-2" />
                        </div>
                        <div class="mt-4">
                            <x-input-label for="cantidad_agua" :value="__('Cantidad de Agua (en Litros)')" />
                            <x-text-input id="cantidad_agua" class="block mt-1 w-full" type="number" step="0.01" name="cantidad_agua" required />
                            <x-input-error :messages="$errors->get('cantidad_agua')" class="mt-2" />
                        </div>
                         <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('zonas.show', $zona) }}" class="text-gray-600 hover:text-gray-900 mr-4">Cancelar</a>
                            <x-primary-button>
                                {{ __('Guardar Registro') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>