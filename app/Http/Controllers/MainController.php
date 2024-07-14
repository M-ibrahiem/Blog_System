<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Setting; // Assuming you have a Setting model
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        // $categories = Category::with('posts')->latest()->limit(3)->get();
        $categories = Category::first()->limit(3)->get();
        $posts = Post::first()->limit(3)->get();
        $popularCategories = Category::withCount('posts')->orderBy('posts_count', 'desc')->limit(5)->get();
        // $instagramImages = collect([
        //     (object) ['url' => 'upload/garden_sq_01.jpg'],
        //     (object) ['url' => 'upload/garden_sq_02.jpg'],
        //     (object) ['url' => 'upload/garden_sq_03.jpg'],
        //     // Add more images as needed
        // ]);

        $setting = Setting::first(); // Fetch settings

        return view('welcome', compact('categories', 'posts', 'popularCategories', 'setting'));
    }
}
