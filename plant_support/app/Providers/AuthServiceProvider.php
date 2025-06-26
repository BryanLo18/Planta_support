<?php

namespace App\Providers;

// Añade estas dos líneas para importar Gate y User
use Illuminate\Support\Facades\Gate;
use App\Models\User;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // Ya no necesitamos la ZonaRiegoPolicy aquí
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        // --- AÑADE ESTE CÓDIGO ---
        // Este Gate define la habilidad 'manage-zones'.
        // Un usuario tendrá este permiso SOLO SI su columna 'rol' es 'admin'.
        Gate::define('manage-zones', function (User $user) {
            return $user->rol === 'admin';
        });
        // --- FIN DEL CÓDIGO A AÑADIR ---
    }
}
