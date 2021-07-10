@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2>Publicaciones</h2>
            @foreach($posts as $post)
                <h3>{{ $post->title }}</h3>
                <p>{{ $post->content }}</p>
                <a href="{{ route('posts.show',$post->id) }}">Ver más</a>
            @endforeach
            
        </div>
    </div>
</div>
@endsection
