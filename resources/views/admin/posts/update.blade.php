@extends('layouts.template.admin.app')

@section('title')
Gestión de Posts
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Actualización de Post</h3><br>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                @if (session()->has('success'))
                    <div class="alert alert-success">
                        {{session()->get('success')}}
                    </div>
                @endif
                <form action="{{ route('admin.posts.update',$post->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Título') }}</label>
                        <div class="col-md-6">
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') ? old('title') : $post->title }}">
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="content" class="col-md-4 col-form-label text-md-right">{{ __('Contenido') }}</label>

                        <div class="col-md-6">
                            <textarea name="content" id="content" cols="30" class="form-control @error('content') is-invalid @enderror" rows="10" required>{{ old('content') ? old('content') : $post->content }}</textarea>
                            @error('content')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="content" class="col-md-4 col-form-label text-md-right">{{ __('Estado') }}</label>

                        <div class="col-md-6">

                            @foreach($post->estados as $key => $estado)
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input @error('active') is-invalid @enderror" type="radio" id="radio{{ $key }}" {{$key == $post->active ? 'checked' : ''}} value="{{ $key }}" name="active">
                                <label for="radio{{$key}}" class="custom-control-label">{{$estado}}</label>
                            </div>
                            @endforeach
                            
                            @error('active')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-primary">Actualizar Post</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection