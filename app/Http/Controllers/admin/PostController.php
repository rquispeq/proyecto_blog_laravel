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
        $posts = Post::all()->sortByDesc('create_at');
        // dd($posts);
        // $posts = Post::paginate(2);
        return view('admin.posts.home',['posts'=> $posts]);
    }

    public function show(Post $post){
        return view('admin.posts.show',['post' => $post]);
    }

    public function create(){
        return view('admin.posts.create');
    }

    public function store(Request $request){
        $validated = $request->validate([
            'title' => ['required','max:150'],
            'content' => ['required', 'max:225']
        ]);

        $validated['user_id'] = Auth::user()->id;

        Post::create($validated);

        $request->session()->flash('success','Post created successfully');
        return view('admin.posts.create');
    }
}
