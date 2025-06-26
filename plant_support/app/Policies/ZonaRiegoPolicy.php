<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ZonaRiego;
use Illuminate\Auth\Access\Response;

class ZonaRiegoPolicy
{
    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ZonaRiego $zonaRiego): bool
    {
        return $user->id === $zonaRiego->user_id;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ZonaRiego $zonaRiego): bool
    {
        return $user->id === $zonaRiego->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ZonaRiego $zonaRiego): bool
    {
        return $user->id === $zonaRiego->user_id;
    }
}