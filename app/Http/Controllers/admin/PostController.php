<?php

namespace App\Http\Controllers\admin;

use App\Models\Post;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Category;
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
        $user = $post->user;
        return view('admin.posts.show',compact('post','user'));
    }

    public function create(){
        $post = new Post;
        $estados = $post->estados;
        $banner_status = $post->banner_status;

        $tags = Tag::where('active',1)->orderBy('name')->get();
        $categories = Category::where('active',1)->orderBy('name')->get();

        return view('admin.posts.create',compact('estados','tags','categories','banner_status'));
    }

    public function store(PostRequest $request){
        $validated = $request->validated();
        $validated['user_id'] = Auth::user()->id;


        $post = Post::create($validated);

        $this->createTagsForPost($validated['tags'],$post);


        $request->session()->flash('success','Post created successfully');
        
        return redirect()->route('admin.posts.create');
    }
    
    public function edit(Post $post){
        $tags = Tag::where('active',1)->get();
        $categories = Category::where('active',1)->get();
        
        $banner_status = $post->banner_status;
        $post_tags = $post->tags();
        $selected_tags = $post_tags->pluck('tag_id')->toArray();
        
        return view('admin.posts.update',compact('post','tags','selected_tags','categories','banner_status'));
    }

    public function update(PostRequest $request, Post $post){
        $validated = $request->validated();

        $data_post = $post->attributesToArray();
        foreach ($validated as $key => $value) {
            if (array_key_exists($key ,$data_post)) {
                $post->$key = $value;
            }
        }

        $post->tags()->detach();
        $this->createTagsForPost($validated['tags'],$post);

        $post->save();


        $request->session()->flash('success','Post updated successfully');

        return redirect()->route('admin.posts.edit',['post'=>$post]);
    }

    public function createTagsForPost($tags, $post){
        foreach ($tags as $tag_id) {
            $tag = Tag::find($tag_id);
            $atributes = ['post_id' => $post->id,'tag_id' => $tag->id];
            PostTag::create($atributes);
        }
    }

}
