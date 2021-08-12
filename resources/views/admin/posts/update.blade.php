@extends('layouts.template.admin.app')

@section('specific-head')
<link rel="stylesheet" href="{{url('template/admin/plugins/select2/css/select2.min.css')}}">
@endsection

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
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title',$post->title) }}" required>
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
                            <textarea name="content" id="content" cols="30" class="form-control @error('content') is-invalid @enderror" rows="10" required>{{ old('content',$post->content) }}</textarea>
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
                                <input class="custom-control-input @error('active') is-invalid @enderror" type="radio" id="radio{{ $key }}" {{$key == old('active',$post->active) ? 'checked' : ''}} value="{{ $key }}" name="active">
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
                        <label for="content" class="col-md-4 col-form-label text-md-right">{{ __('Tags') }}</label>
                        <div class="col-md-6">
                            <select name="tags[]" class="form-control" id="select_tags" required multiple>
                                @foreach($tags as $tag)
                                    <option value="{{$tag->id}}" {{ (in_array($tag->id, old('tags',$selected_tags))) ? 'selected' : ''}}>
                                        {{$tag->name}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('tags')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group row">
                        <label for="select_category" class="col-md-4 col-form-label text-md-right">{{ __('Categoría') }}</label>
                        <div class="col-md-6">
                            <select name="category_id" class="form-control @error('category_id') is-invalid @enderror" id="select_category" required>
                                <option value="">Selecciona una categoría</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}" {{old('category_id',$post->category_id) == $category->id ? 'selected' : ''}} >{{$category->name}}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="content" class="col-md-4 col-form-label text-md-right">{{ __('Publicar en el banner') }}</label>

                        <div class="col-md-6">

                            @foreach($banner_status as $key => $banner_state)
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input @error('banner') is-invalid @enderror" type="radio" id="banner{{ $key }}" {{ $key == old('banner',$post->banner) ? 'checked' : ''}} value="{{ $key }}" name="banner" required>
                                <label for="banner{{$key}}" class="custom-control-label">{{$banner_state}}</label>
                                @error('banner')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            @endforeach
                            
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

@section('specific-scripts')
<script src="{{url('template/admin/plugins/select2/js/select2.full.min.js')}}"></script>
<script>
    $(document).ready(function() {
        $('#select_tags').select2();
    });
</script>
@endsection