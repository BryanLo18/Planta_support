<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Muestra una lista de TODOS los usuarios registrados.
     * Esto cumple con tu requisito de traer a todos los usuarios.
     */
    public function index()
    {
        // Obtenemos todos los usuarios, mostrando los más recientes primero.
        // Se excluye al usuario actual para que no pueda modificarse a sí mismo desde la lista.
        $users = User::where('id', '!=', auth()->id())->latest()->paginate(15);
        return view('users.index', compact('users'));
    }

    /**
     * Muestra el formulario para editar un usuario existente.
     * Aquí es donde se asignará el nuevo rol.
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Actualiza la información de un usuario, principalmente su rol.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            // Aseguramos que el email sea único, ignorando al usuario actual
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'rol' => ['required', 'string', 'in:admin,usuario'],
        ]);

        // Solo actualizamos el nombre, email y rol. No tocamos la contraseña.
        $user->update($request->only('name', 'email', 'rol'));

        return redirect()->route('users.index')->with('success', 'Usuario actualizado con éxito.');
    }

    /**
     * Elimina un usuario de la base de datos.
     */
    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'No puedes eliminar a tu propio usuario.');
        }

        $user->delete();
        return redirect()->route('users.index')->with('success', 'Usuario eliminado con éxito.');
    }
}