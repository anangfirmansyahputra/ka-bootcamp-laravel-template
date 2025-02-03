<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("categories.form");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => "required|string|unique:categories",
            'is_active' => 'boolean',
            'description' => 'string|nullable',
        ]);

        try {
            Category::create([
                'name' => $validated['name'],
                'is_active' => $validated['is_active'],
                'description' => $validated['description']
            ]);

            return redirect()->route('categories.index')->with('success', 'Category created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create category');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::find($id);
        if (!$category) {
            redirect()->route('categories.index');
        }

        return view('categories.form', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::find($id);
        if (!$category) {
            return redirect()->back()->with('error', 'Category not found');
        }

        $validated = $request->validate([
            'name' => "required|string|unique:categories,name,{$category->id}",
            'is_active' => 'boolean',
            'description' => 'string|nullable',
        ]);

        try {
            $category->update([
                'name' => $validated['name'],
                'is_active' => $validated['is_active'],
                'description' => $validated['description']
            ]);

            return redirect()->route('categories.index')->with('success', 'Category update successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update category');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted success');
    }
}
