<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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
        $locales = LaravelLocalization::getSupportedLocales();
        $rules = [
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'required|exists:categories,id',
            'author' => auth()->user()->name,
            'tags' => 'nullable|string',
        ];

        foreach ($locales as $localeCode => $properties) {
            $rules["{$localeCode}.title"] = 'required|string|max:255';
            $rules["{$localeCode}.content"] = 'required|string';
            $rules["{$localeCode}.small_description"] = 'required|string|max:500';
        }

        $request->validate($rules);

        $all = $request->except(['image']);
        $post = Post::create($all);

        if ($request->hasFile('image')) {
            $upload = $post->addMediaFromRequest('image')->toMediaCollection('images');
            $post->update([
                'image' => $upload->getUrl()
            ]);
        }
         // Handle tags
    // if ($request->filled('tags')) {
    //     $tags = array_map('trim', explode(',', $request->tags));
    //     $post->syncTags($tags);
    // }


        return redirect()->route('dashboard.posts.index')->with('success', 'post added successfully');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
