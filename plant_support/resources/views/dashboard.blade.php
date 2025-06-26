<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Sección de Alertas -->
            @if($alertas->isNotEmpty())
            <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-6" role="alert">
                <p class="font-bold">Alertas Climáticas</p>
                @foreach($alertas as $alerta)
                    <p>{{ $alerta->mensaje }} - <span class="text-sm">{{ $alerta->created_at->diffForHumans() }}</span></p>
                @endforeach
            </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium">¡Bienvenido a tu panel de control de riego!</h3>
                    <p class="mt-2">Desde aquí puedes gestionar tus zonas de riego, programar horarios y ver el historial.</p>
                    <div class="mt-6">
                        <a href="{{ route('zonas.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Gestionar Mis Zonas de Riego
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>