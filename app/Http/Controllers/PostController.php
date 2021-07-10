<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth')->except(['show']);
    }
    public function show(Post $post){
        return view('posts.show',['post' => $post]);
    }
}