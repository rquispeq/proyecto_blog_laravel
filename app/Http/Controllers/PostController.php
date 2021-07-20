<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('ensureIsAdmin')->except(['show']);
    }

    public function show(Post $post){
        return view('posts.show',['post' => $post]);
    }

}
