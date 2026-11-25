<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('role')->orderBy('name')->get();
        return view('settings.users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::orderBy('name')->get();
        return view('settings.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:150',
            'email' => 'required|email|unique:users',
            'dni' => 'required|max:8|unique:users',
            'phone' => 'nullable|max:15',
            'role_id' => 'required|exists:roles,id',
            'password' => 'required|min:6',
        ]);

        User::create($validated);
        return to_route('users.index')->with('ok', 'Usuario registrado correctamente.');
    }

    public function edit(User $user)
    {
        $roles = Role::orderBy('name')->get();
        return view('settings.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|max:150',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user)],
            'dni' => ['required', 'max:8', Rule::unique('users')->ignore($user)],
            'phone' => 'nullable|max:15',
            'role_id' => 'required|exists:roles,id',
            'password' => 'nullable|min:6', // Ahora la contraseña es opcional al editar
        ]);

        // Si no escribió una nueva contraseña, la borramos del arreglo para que no se actualice
        if (empty($validated['password'])) {
            unset($validated['password']);
        }

        $user->update($validated);
        return to_route('users.index')->with('ok', 'Usuario actualizado correctamente.');
    }

    public function destroy(User $user)
    {
        // Regla: No borrar si el usuario tiene ventas registradas
        if ($user->sales()->exists()) {
            return back()->with('error', 'No se puede eliminar: el usuario tiene ventas registradas.');
        }

        $user->delete();
        return to_route('users.index')->with('ok', 'Usuario eliminado correctamente.');
    }
}