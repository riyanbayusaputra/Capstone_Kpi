<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoriesController extends Controller
{
    /**
     * Menampilkan daftar kategori.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $categories = Categories::all();
        return view('admin.categoriespsikotes.index', compact('categories'));
    }

    /**
     * Menampilkan form untuk membuat kategori baru.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.categoriespsikotes.create');
    }

    /**
     * Menyimpan kategori baru ke database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categoriespsikotes,name',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image
        ]);

        $category = new Categories();
        $category->name = $request->input('name');
        $category->description = $request->input('description', ''); // Set default value
        
        // Handle image upload
        if ($request->hasFile('image')) {
            $path = $request->file('image')->move(public_path('images'), $request->file('image')->getClientOriginalName()); // Move the image to public/images
            $category->image = 'images/' . $request->file('image')->getClientOriginalName(); // Save the image path to the database
        }

        $category->save();

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    /**
     * Menampilkan form untuk mengedit kategori.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $category = Categories::findOrFail($id);
        return view('admin.categoriespsikotes.edit', compact('category'));
    }

    /**
     * Memperbarui kategori di database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categoriespsikotes,name,' . $id,
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image
        ]);

        $category = Categories::findOrFail($id);
        $category->name = $request->input('name');
        $category->description = $request->input('description', $category->description); // Pertahankan nilai default

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($category->image) {
                $oldImagePath = public_path($category->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath); // Delete the old image
                }
            }
            // Move the new image
            $path = $request->file('image')->move(public_path('images'), $request->file('image')->getClientOriginalName());
            $category->image = 'images/' . $request->file('image')->getClientOriginalName(); // Save the new image path to the database
        }

        $category->save();

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    /**
     * Menghapus kategori dari database.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $category = Categories::findOrFail($id);
        
        // Delete image if exists
        if ($category->image) {
            $oldImagePath = public_path($category->image);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath); // Delete the old image
            }
        }

        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}