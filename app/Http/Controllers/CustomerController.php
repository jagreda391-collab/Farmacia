<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::orderBy('name')->get();
        return view('settings.customers.index', compact('customers'));
    }

    public function create()
    {
        return view('settings.customers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:150',
            'dni' => 'required|max:8|unique:customers',
            'phone' => 'nullable|max:15',
            'age' => 'nullable|integer|min:0|max:120',
        ]);

        Customer::create($validated);
        return to_route('customers.index')->with('ok', 'Cliente registrado correctamente.');
    }

    public function edit(Customer $customer)
    {
        return view('settings.customers.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $validated = $request->validate([
            'name' => 'required|max:150',
            'dni' => ['required', 'max:8', Rule::unique('customers')->ignore($customer)],
            'phone' => 'nullable|max:15',
            'age' => 'nullable|integer|min:0|max:120',
        ]);

        $customer->update($validated);
        return to_route('customers.index')->with('ok', 'Cliente actualizado correctamente.');
    }

    public function destroy(Customer $customer)
    {
        // Regla del diagrama: Un cliente con ventas no se puede borrar
        if ($customer->sales()->exists()) {
            return back()->with('error', 'No se puede eliminar: el cliente tiene ventas registradas.');
        }

        $customer->delete();
        return to_route('customers.index')->with('ok', 'Cliente eliminado correctamente.');
    }
}