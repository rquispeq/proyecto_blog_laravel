@extends('layouts.template.admin.app')

@section('title')
Gestión de Posts
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ $post->title }}</h3><br>
                <span>Creado: {{$post->created_at}}</span><br>
                <span>Estado: {{ $post->estados[$post->active] }}</span><br>
                <span>Autor: {{ $user->name }}</span>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="row"><a href="{{ route('admin.posts.edit',$post->id) }}">Editar</a></div>
                {{ $post->content }}
            </div>
        </div>
    </div>
</div>
@endsection