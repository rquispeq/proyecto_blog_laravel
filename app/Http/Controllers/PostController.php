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

    public function create(){
        return view('posts.create');
    }

    public function store(Request $request){
        $validated = $request->validate([
            'title' => ['required','max:150'],
            'content' => ['required', 'max:225']
        ]);

        $validated['user_id'] = Auth::user()->id;

        Post::create($validated);

        $request->session()->flash('success','Post created successfully');
        return view('posts.create');
    }
}
