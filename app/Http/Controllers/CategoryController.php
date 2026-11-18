<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
// Esta es la línea "Illuminate" que el profesor está agregando:
use Illuminate\Validation\Rule; 

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('medicines')->orderBy('name')->get();
        return view('settings.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('settings.categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:50|unique:categories',
            'description' => 'nullable|max:255',
        ], $this->mensajes());

        Category::create($validated);

        return to_route('categories.index')->with('ok', 'Categoría registrada correctamente.');
    }

    public function edit(Category $category)
    {
       return view('settings.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        // Aquí el profesor usa $validated y la regla Rule
        $validated = $request->validate([
            'name' => [
                'required', 
                'max:50', 
                Rule::unique('categories', 'name')->ignore($category->id) // Ignora la categoría actual
            ],
            'description' => 'nullable|max:255',
        ], $this->mensajes());

        $category->update($validated);

        return to_route('categories.index')->with('ok', 'Categoría actualizada correctamente.');
    }

    public function destroy(Category $category)
    {
        if ($category->medicines()->exists()) {
            return back()->with('error', 'No se puede eliminar: tiene medicamentos registrados.');
        }

        $category->delete();

        return to_route('categories.index')->with('ok', 'Categoría eliminada correctamente.');
    }

    private function mensajes(): array
    {
        return [
            'name.required' => 'Escribe el nombre de la categoría.',
            'name.max' => 'El nombre admite máximo 50 caracteres.',
            'name.unique' => 'Esa categoría ya está registrada.',
            'description.max' => 'La descripción admite máximo 255 caracteres.',
        ];
    }
}