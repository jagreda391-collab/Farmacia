<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use App\Models\Category;
use Illuminate\Http\Request;

class MedicineController extends Controller
{
    public function index()
    {
        $medicines = Medicine::with('category')->orderBy('name')->get();
        return view('settings.medicines.index', compact('medicines'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('settings.medicines.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|max:120',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        Medicine::create($validated);
        return to_route('medicines.index')->with('ok', 'Medicamento registrado correctamente.');
    }

    public function edit(Medicine $medicine)
    {
        $categories = Category::orderBy('name')->get();
        return view('settings.medicines.edit', compact('medicine', 'categories'));
    }

    public function update(Request $request, Medicine $medicine)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|max:120',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        $medicine->update($validated);
        return to_route('medicines.index')->with('ok', 'Medicamento actualizado correctamente.');
    }

    public function destroy(Medicine $medicine)
    {
        if ($medicine->detailsales()->exists()) {
            return back()->with('error', 'No se puede eliminar: el medicamento tiene ventas registradas.');
        }

        $medicine->delete();
        return to_route('medicines.index')->with('ok', 'Medicamento eliminado correctamente.');
    }
}