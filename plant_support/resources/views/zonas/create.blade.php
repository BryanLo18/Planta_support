    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Crear Nueva Zona de Riego') }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <form action="{{ route('zonas.store') }}" method="POST">
                            @csrf
                            <div>
                                <x-input-label for="nombre_zona" :value="__('Nombre de la Zona')" />
                                <x-text-input id="nombre_zona" class="block mt-1 w-full" type="text"
                                    name="nombre_zona" :value="old('nombre_zona')" required autofocus />
                            </div>
                            <div class="mt-4">
                                <x-input-label for="tipo_cultivo" :value="__('Tipo de Cultivo')" />
                                <x-text-input id="tipo_cultivo" class="block mt-1 w-full" type="text"
                                    name="tipo_cultivo" :value="old('tipo_cultivo')" required />
                            </div>
                            <div class="mt-4">
                                <x-input-label for="ubicacion" :value="__('Ubicación (Opcional)')" />
                                <x-text-input id="ubicacion" class="block mt-1 w-full" type="text" name="ubicacion"
                                    :value="old('ubicacion')" />
                            </div>

                            {{-- NUEVOS CAMPOS --}}
                            <div class="mt-4">
                                <x-input-label for="area_metros" :value="__('Área (en metros cuadrados)')" />
                                <x-text-input id="area_metros" class="block mt-1 w-full" type="number" step="0.01"
                                    name="area_metros" :value="old('area_metros')" />
                            </div>
                            <div class="mt-4">
                                <x-input-label for="estado" :value="__('Estado')" />
                                <select name="estado" id="estado"
                                    class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="Activo" @selected(old('estado') == 'Activo')>Activo</option>
                                    <option value="Inactivo" @selected(old('estado') == 'Inactivo')>Inactivo</option>
                                    <option value="Mantenimiento" @selected(old('estado') == 'Mantenimiento')>Mantenimiento</option>
                                </select>
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <a href="{{ route('zonas.index') }}"
                                    class="text-gray-600 hover:text-gray-900 mr-4">Cancelar</a>
                                <x-primary-button>{{ __('Guardar Zona') }}</x-primary-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
