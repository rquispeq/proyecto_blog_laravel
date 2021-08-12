<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = Post::where('active',1)->orderBy('created_at','desc')->get();
        $tags = Tag::where('active',1)->get();
        $categories = Category::where('active',1)->get();
        
        return view('home',compact('posts','tags','categories'));
    }
}
