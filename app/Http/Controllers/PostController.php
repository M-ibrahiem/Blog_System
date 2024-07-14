<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Post::withTrashed()->get();
        return view('dash.post.all', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('dash.post.add', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'nullable|string|max:255',
            'name' => auth()->user()->name,
        ];

        foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
            $rules["{$localeCode}.title"] = 'required|string|max:255';
            $rules["{$localeCode}.content"] = 'required|string';
            $rules["{$localeCode}.small_description"] = 'required|string|max:500';
        }

        $request->validate($rules);

        $all = $request->except(['image']);
        // $all['user_id'] = Auth::id();
        // $all['category_id'] = $request->category_id;
        $post = Post::create($all);

        if ($request->hasFile('image')) {
            $upload = $post->addMediaFromRequest('image')->toMediaCollection('images');
            $post->update([
                'image' => $upload->getUrl()
            ]);
        }
        // $post->update([
        //     'user_id' => Auth::user()->id,
        // ]);

        // $post->save();

        return redirect()->route('dashboard.posts.index')->with('success', 'Post created successfully!');
    }



    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        // Fetch all categories to populate the category dropdown
        $categories = Category::all();

        // Return the edit view with the post and categories
        return view('dash.post.edit', compact('post', 'categories'));

    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $rules = [
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|string|max:255',
        ];

        foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
            $rules["{$localeCode}.title"] = 'required|string|max:255';
            $rules["{$localeCode}.content"] = 'required|string';
            $rules["{$localeCode}.small_description"] = 'required|string|max:500';
        }

        $request->validate($rules);

            // Update category ID
            $post->update([
                'category_id' => $request->category_id,
            ]);

            // Update translations
            foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
                $post->translateOrNew($localeCode)->title = $request->input("{$localeCode}.title");
                $post->translateOrNew($localeCode)->content = $request->input("{$localeCode}.content");
                $post->translateOrNew($localeCode)->small_description = $request->input("{$localeCode}.small_description");
            }
            $post->save();

            // Handle image upload
            if ($request->hasFile('image')) {
                $post->clearMediaCollection('images');
                $upload = $post->addMediaFromRequest('image')->toMediaCollection('images');
                $post->update([
                    'image' => $upload->getUrl()
                ]);
            }


            return redirect()->route('dashboard.posts.index')->with('success', 'Post updated successfully!');
        }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
