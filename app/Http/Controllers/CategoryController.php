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

        return view('category.index', [
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|unique:categories,name',
            'is_active' =>  'boolean|nullable',
            'description' => 'string'
        ]);

        try {
            Category::create([
                'name' => $request->name,
                'is_active' => $request->is_active,
                'description' => $request->description
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

        return view('category.form', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => "required|min:3|unique:categories,name,{$id}",
            'is_active' => 'boolean',
            'description' => 'string'
        ]);

        try {
            $category = Category::find($id);
            $category->update([
                'name' => $request->name,
                'is_active' => $request->is_active,
                'description' => $request->description
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
