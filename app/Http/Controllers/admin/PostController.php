<?php

namespace App\Http\Controllers\admin;

use App\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function __construct()
    {
    }

    public function index(){
        // $posts = Post::all()->sortByDesc('create_at');
        $posts = Post::orderBy('created_at')->paginate(5);
        return view('admin.posts.home',['posts'=> $posts]);
    }

    public function show(Post $post){
        return view('admin.posts.show',['post' => $post]);
    }

    public function create(){
        $post = new Post;
        $estados = $post->estados;
        return view('admin.posts.create',compact('estados'));
    }

    public function store(Request $request){
        $validated = $request->validate([
            'title' => ['required','max:150'],
            'content' => ['required', 'max:225'],
            'active' => 'required'
        ]);

        $validated['user_id'] = Auth::user()->id;

        Post::create($validated);

        $post = new Post;
        $estados = $post->estados;

        $request->session()->flash('success','Post created successfully');
        return view('admin.posts.create',compact('estados'));
    }
    
    public function edit(Post $post){
        return view('admin.posts.update',['post' => $post]);
    }

    public function update(Request $request, Post $post){
        $validated = $request->validate([
            'title' => ['required','max:150'],
            'content' => ['required', 'max:225'],
            'active' => 'required'
        ]);

        $post->title = $validated['title'];
        $post->content = $validated['content'];
        $post->active = $validated['active'];
        $post->save();

        $request->session()->flash('success','Post updated successfully');

        return redirect()->route('admin.posts.edit',['post'=>$post]);
    }

}
