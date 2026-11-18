<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::orderBy('name')->get();
        return view('settings.roles.index', compact('roles'));
    }

    public function create()
    {
        return view('settings.roles.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:50|unique:roles',
            'description' => 'nullable|max:255',
        ]);

        Role::create($validated);
        return to_route('roles.index')->with('ok', 'Rol registrado correctamente.');
    }

    public function edit(Role $role)
    {
        return view('settings.roles.edit', compact('role'));
    }

    public function update(Request $request, Role $role)
    {
        $validated = $request->validate([
            'name' => 'required|max:50|unique:roles,name,' . $role->id,
            'description' => 'nullable|max:255',
        ]);

        $role->update($validated);
        return to_route('roles.index')->with('ok', 'Rol actualizado correctamente.');
    }

    public function destroy(Role $role)
    {
        if ($role->users()->exists()) {
            return back()->with('error', 'No se puede eliminar: tiene usuarios asignados.');
        }

        $role->delete();
        return to_route('roles.index')->with('ok', 'Rol eliminado correctamente.');
    }
}