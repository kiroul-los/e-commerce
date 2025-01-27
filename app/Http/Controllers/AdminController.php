<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function view_category()
    {
        $categories = Category::all();
        return view('admin.category.category', compact('categories'));
    }

    public function add_category(Request $request)
    {
        // Validate the request data
        $request->validate([
            'cat_name' => 'required|string|max:255|unique:categories,name',
        ]);

        // Create a new category
        Category::create([
            'name' => $request->cat_name,
        ]);

        // Redirect with a success message
        return redirect()->to(url('view_category'))->with('success', 'Category added successfully!');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id); // Find category by ID

        return view('admin.category.editcategory', compact('category')); // Return the edit view with category data
    }

    // Handle the form submission and update the category
    public function update(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'cat_name' => 'required|string|max:255',
        ]);

        $category = Category::findOrFail($id); // Find the category by ID

        // Update the category
        $category->name = $request->input('cat_name');
        $category->save(); // Save the changes

        return redirect()->to(url('view_category'))->with('success', 'Category updated successfully!');
    }

    public function delete($id)
    {
        // Find the category by ID
        $category = Category::find($id);

        // Check if the category exists
        if ($category) {
            // Delete the category
            $category->delete();

            // Redirect back with success message
            return redirect()->back()->with('success', 'Category deleted successfully.');
        } else {
            // Redirect back with error message if category not found
            return redirect()->back()->with('error', 'Category not found.');
        }

    }
}
