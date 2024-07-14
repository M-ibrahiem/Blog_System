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
        ];

        foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
            $rules["{$localeCode}.title"] = 'required|string|max:255';
            $rules["{$localeCode}.content"] = 'required|string';
            $rules["{$localeCode}.small_description"] = 'required|string|max:500';
        }

        $request->validate($rules);

        $post = new Post([
            'category_id' => $request->category_id,
            'user_id' => Auth::id(),
        ]);

        foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
            $post->translateOrNew($localeCode)->title = $request->input("{$localeCode}.title");
            $post->translateOrNew($localeCode)->content = $request->input("{$localeCode}.content");
            $post->translateOrNew($localeCode)->small_description = $request->input("{$localeCode}.small_description");
        }

        $post->save();

        if ($request->hasFile('image')) {
            $upload = $post->addMediaFromRequest('image')->toMediaCollection('images');
            $post->update(['image' => $upload->getUrl()]);
        }

        return redirect()->route('dashboard.posts.index')->with('success', 'Post created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('dash.post.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $rules = [
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tags' => 'nullable|string|max:255',
        ];

        foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
            $rules["{$localeCode}.title"] = 'required|string|max:255';
            $rules["{$localeCode}.content"] = 'required|string';
            $rules["{$localeCode}.small_description"] = 'required|string|max:500';
        }

        $all = $request->validate($rules);
        $post->update(['category_id' => $request->category_id]);
        $post->update($all);


        if ($request->hasFile('image')) {
            $post->clearMediaCollection('images');
            $upload = $post->addMediaFromRequest('image')->toMediaCollection('images');
            $post->update(['image' => $upload->getUrl()]);
        }

        return redirect()->route('dashboard.posts.index')->with('success', 'Post updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('dashboard.posts.index')->with('success', 'Post deleted successfully!');
    }

    public function restore(Post $post)
    {
        $post->restore();
        return redirect()->route('dashboard.posts.index')->with('success', 'posts added successfully');
    }
    public function erase(Post $post)
    {
        $post->clearMediaCollection('images');
        $post->forceDelete();
        return redirect()->route('dashboard.posts.index')->with('success', 'posts added successfully');
    }
}
