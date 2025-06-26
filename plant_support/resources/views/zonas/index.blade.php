<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Zonas de Riego') }}
            </h2>
            <a href="{{ route('zonas.create') }}" class="w-full sm:w-auto text-center bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                Crear Nueva Zona
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if(session('success'))
                        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                            <p>{{ session('success') }}</p>
                        </div>
                    @endif

                    {{-- INICIO: VISTA PARA MÓVILES (Tarjetas) --}}
                    <div class="grid grid-cols-1 gap-4 lg:hidden">
                        @forelse($zonas as $zona)
                            <div class="bg-white p-4 rounded-lg shadow border border-gray-200">
                                <div class="flex justify-between items-start">
                                    <p class="font-bold text-lg text-indigo-600">{{ $zona->nombre_zona }}</p>
                                    {{-- CAMBIO: Badge de estado --}}
                                    <span @class([
                                        'px-2 inline-flex text-xs leading-5 font-semibold rounded-full',
                                        'bg-green-100 text-green-800' => $zona->estado === 'Activo',
                                        'bg-gray-100 text-gray-800' => $zona->estado === 'Inactivo',
                                        'bg-yellow-100 text-yellow-800' => $zona->estado === 'Mantenimiento',
                                    ])>
                                        {{ $zona->estado }}
                                    </span>
                                </div>
                                <div class="mt-2 text-sm text-gray-700">
                                    <p><strong>Cultivo:</strong> {{ $zona->tipo_cultivo }}</p>
                                    {{-- CAMBIO: Mostrar Área --}}
                                    <p><strong>Área:</strong> {{ $zona->area_metros ?? 'N/A' }} m²</p>
                                    <p><strong>Registrado por:</strong> {{ $zona->user->name ?? 'N/A' }}</p>
                                </div>
                                <div class="mt-4 pt-4 border-t border-gray-200 flex justify-end items-center gap-4">
                                    <a href="{{ route('zonas.show', $zona) }}" class="text-indigo-600 hover:text-indigo-900 font-semibold">Ver Detalles</a>
                                    @can('manage-zones')
                                        <a href="{{ route('zonas.edit', $zona) }}" class="text-yellow-600 hover:text-yellow-900 font-semibold">Editar</a>
                                        <form action="{{ route('zonas.destroy', $zona) }}" method="POST" onsubmit="return confirm('¿Estás seguro?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 font-semibold">Eliminar</button>
                                        </form>
                                    @endcan
                                </div>
                            </div>
                        @empty
                            <p>No hay zonas de riego creadas.</p>
                        @endforelse
                    </div>
                    {{-- FIN: VISTA PARA MÓVILES --}}


                    {{-- INICIO: VISTA PARA ESCRITORIO (Tabla) --}}
                    <div class="hidden lg:block">
                         <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    {{-- CAMBIO: Columnas actualizadas --}}
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Zona</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Registrado por</th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($zonas as $zona)
                                    <tr>
                                        {{-- CAMBIO: Celda de Zona con área --}}
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <p class="text-sm font-medium text-gray-900">{{ $zona->nombre_zona }} ({{ $zona->area_metros ?? 'N/A' }} m²)</p>
                                            <p class="text-sm text-gray-500">{{ $zona->tipo_cultivo }}</p>
                                        </td>
                                        {{-- CAMBIO: Celda de Estado con badge --}}
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span @class([
                                                'px-2 inline-flex text-xs leading-5 font-semibold rounded-full',
                                                'bg-green-100 text-green-800' => $zona->estado === 'Activo',
                                                'bg-gray-100 text-gray-800' => $zona->estado === 'Inactivo',
                                                'bg-yellow-100 text-yellow-800' => $zona->estado === 'Mantenimiento',
                                            ])>
                                                {{ $zona->estado }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $zona->user->name ?? 'N/A' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="{{ route('zonas.show', $zona) }}" class="text-indigo-600 hover:text-indigo-900">Ver Detalles</a>
                                            @can('manage-zones')
                                                <a href="{{ route('zonas.edit', $zona) }}" class="text-yellow-600 hover:text-yellow-900 ml-4">Editar</a>
                                                <form action="{{ route('zonas.destroy', $zona) }}" method="POST" class="inline-block ml-4" onsubmit="return confirm('¿Estás seguro?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900">Eliminar</button>
                                                </form>
                                            @endcan
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="4" class="px-6 py-4 text-center">No hay zonas de riego creadas.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                     {{-- FIN: VISTA PARA ESCRITORIO --}}

                    <div class="mt-4">
                        {{ $zonas->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
