<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    // GET /categories
    public function getCategories()
    {
        return Category::all();
    }

    // POST /categories
    public function createCategory(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = Category::create($validated);
        return response()->json($category, 201);
    }

    // GET /categories/{categoryId}
    public function getCategory($categoryId)
    {
        $category = Category::findOrFail($categoryId);
        return response()->json($category);
    }

    // PATCH /categories/{categoryId}
    public function updateCategory(Request $request, $categoryId)
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
        ]);

        $category = Category::findOrFail($categoryId);
        $category->update($validated);
        return response()->json($category);
    }

    // DELETE /categories/{categoryId}
    public function deleteCategory($categoryId)
    {
        $category = Category::findOrFail($categoryId);
        $category->delete();
        return response()->json(null, 204);
    }
}