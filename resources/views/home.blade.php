@extends('layouts.template.public.app')

@section('content')
<section class="blog-posts">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="all-blog-posts">
                        <div class="row">
                            @foreach($posts as $post)
                                <div class="col-lg-12">
                                    <div class="blog-post">
                                        <div class="blog-thumb">
                                            <img src="template/public/assets/images/blog-post-01.jpg" alt="">
                                        </div>
                                        <div class="down-content">
                                            <span>Lifestyle</span>
                                            <a href="post-details.html">
                                                <h4>{{ $post->title }}</h4>
                                            </a>
                                            <ul class="post-info">
                                                <li><a href="#">{{ $post->user()->name }}</a></li>
                                                <li><a href="#">{{ $post->created_at }}</a></li>
                                                <li><a href="#">12 Comments</a></li>
                                            </ul>
                                            <p>
                                                {{ $post->content }}
                                                <a href="{{ route('posts.show',$post->id) }}">Ver más</a>
                                            </p>
                                            <div class="post-options">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <ul class="post-tags">
                                                            <li><i class="fa fa-tags"></i></li>
                                                            @if(count($post->tags) != 0)

                                                                @php $i= 0; @endphp

                                                                @foreach($post->tags as $tag)

                                                                    @php $i++; @endphp

                                                                    @if($i != count($post->tags))
                                                                    <li><a href="#">{{$tag->name}}</a>,</li>
                                                                    @else
                                                                    <li><a href="#">{{$tag->name}}</a></li>
                                                                    @endif

                                                                @endforeach

                                                            @else
                                                            <li>Sin Tags</li>
                                                            @endif
                                                        </ul>
                                                    </div>
                                                    <div class="col-6">
                                                        <ul class="post-share">
                                                            <li><i class="fa fa-share-alt"></i></li>
                                                            <li><a href="#">Facebook</a>,</li>
                                                            <li><a href="#"> Twitter</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            @endforeach
                            <div class="col-lg-12">
                                <div class="main-button">
                                    <a href="blog.html">View All Posts</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="sidebar">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="sidebar-item search">
                                    <form id="search_form" name="gs" method="GET" action="#">
                                        <input type="text" name="q" class="searchText" placeholder="type to search..." autocomplete="on">
                                    </form>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="sidebar-item recent-posts">
                                    <div class="sidebar-heading">
                                        <h2>Recent Posts</h2>
                                    </div>
                                    <div class="content">
                                        <ul>
                                            @for($i = 0; $i < 3 ; $i++)
                                                <li>
                                                    <a href="post-details.html">
                                                        <h5>{{$posts[$i]->title}}</h5>
                                                        <span>{{$posts[$i]->created_at}}</span>
                                                    </a>
                                                </li>
                                            @endfor
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="sidebar-item categories">
                                    <div class="sidebar-heading">
                                        <h2>Categories</h2>
                                    </div>
                                    <div class="content">
                                        <ul>
                                            <li><a href="#">- Nature Lifestyle</a></li>
                                            <li><a href="#">- Awesome Layouts</a></li>
                                            <li><a href="#">- Creative Ideas</a></li>
                                            <li><a href="#">- Responsive Templates</a></li>
                                            <li><a href="#">- HTML5 / CSS3 Templates</a></li>
                                            <li><a href="#">- Creative &amp; Unique</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="sidebar-item tags">
                                    <div class="sidebar-heading">
                                        <h2>Tags</h2>
                                    </div>
                                    <div class="content">
                                        <ul>
                                            @foreach($tags as $tag)
                                                <li><a href="#">{{$tag->name}}</a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection()