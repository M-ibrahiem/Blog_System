<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Category::withTrashed()->with('translations', 'parentCategory')->get();
        return view('dash.category.all', compact('data'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('dash.category.add', compact('categories'));
    }

    public function store(Request $request)
    {
        $locales = LaravelLocalization::getSupportedLocales();
        $rules = [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'parent' => 'nullable|exists:categories,id',
        ];

        foreach ($locales as $localeCode => $properties) {
            $rules["{$localeCode}.title"] = 'required|string|max:255';
            $rules["{$localeCode}.content"] = 'required|string';
        }

        $request->validate($rules);

        $category = new Category();
        $category->parent = $request->parent;
        $category->save();

        foreach ($locales as $localeCode => $properties) {
            $category->translateOrNew($localeCode)->title = $request->input("{$localeCode}.title");
            $category->translateOrNew($localeCode)->content = $request->input("{$localeCode}.content");
        }
        $category->save();

        if ($request->hasFile('image')) {
            $upload = $category->addMediaFromRequest('image')->toMediaCollection('images');
            $category->update([
                'image' => $upload->getUrl()
            ]);
        }

        return redirect()->route('dashboard.categories.index')->with('success', 'Category added successfully');
    }



    /**
     * Display the specified resource.
     */
    public function show(category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $categories = Category::all();

        // التأكد من أن الفئة موجودة
        if (!$category) {
            return redirect()->route('dashboard.categories.index')->with('error', 'Category not found');
        }

        return view('dash.category.edit', compact('category', 'categories'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $locales = LaravelLocalization::getSupportedLocales();
        $rules = [
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'parent' => 'nullable|exists:categories,id',
        ];

        foreach ($locales as $localeCode => $properties) {
            $rules["{$localeCode}.title"] = 'required|string|max:255';
            $rules["{$localeCode}.content"] = 'required|string';
        }

        $request->validate($rules);

        // Update category parent
        $category->parent = $request->parent;
        $category->save();

        // Update translations
        foreach ($locales as $localeCode => $properties) {
            $category->translateOrNew($localeCode)->title = $request->input("{$localeCode}.title");
            $category->translateOrNew($localeCode)->content = $request->input("{$localeCode}.content");
        }
        $category->save();

        // Handle image upload
        if ($request->hasFile('image')) {
            $category->clearMediaCollection('images');
            $category->addMediaFromRequest('image')->toMediaCollection('images');
        }

        return redirect()->route('dashboard.categories.index')->with('success', 'Category updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(category $category)
    {
        $category->delete();
        return redirect()->route('dashboard.categories.index')->with('success', 'Category added successfully');
    }
    public function restore(category $category)
    {
        $category->restore();
        return redirect()->route('dashboard.categories.index')->with('success', 'Category added successfully');
    }
    public function erase(category $category)
    {
        $category->clearMediaCollection('images');
        $category->forceDelete();
        return redirect()->route('dashboard.categories.index')->with('success', 'Category added successfully');
    }
}
