<?php

namespace App\Http\Controllers\admin;

use App\Models\Post;
use App\Http\Controllers\Controller;
use App\Models\PostTag;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function __construct()
    {
    }

    public function index(){
        $posts = Post::orderBy('created_at','desc')->paginate(5);
        return view('admin.posts.home',['posts'=> $posts]);
    }

    public function show(Post $post){
        $user = $post->user();
        return view('admin.posts.show',compact('post','user'));
    }

    public function create(){
        $post = new Post;
        $estados = $post->estados;

        $tags = Tag::where('active',1)->orderBy('name')->get();
        return view('admin.posts.create',compact('estados','tags'));
    }

    public function store(Request $request){
        $validated = $request->validate([
            'title' => ['required','max:150'],
            'content' => ['required', 'max:225'],
            'active' => 'required',
            'tags' => 'required'
        ]);

        $validated['user_id'] = Auth::user()->id;


        $post = Post::create($validated);

        foreach ($validated['tags'] as $tag_id) {
            $tag = Tag::find($tag_id);
            $atributes = ['post_id' => $post->id,'tag_id' => $tag->id];
            PostTag::create($atributes);
        }

        // $post = new Post;
        // $estados = $post->estados;

        $request->session()->flash('success','Post created successfully');
        // return view('admin.posts.create',compact('estados'));
        
        return redirect()->route('admin.posts.create');
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
