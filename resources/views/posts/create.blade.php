@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center ">
        <div class="col-md-8">
            @if (session()->has('success'))
            <div class="alert alert-success">
                {{session()->get('success')}}
            </div>
            @endif
            <h1 class="text-center">Creación de Post</h1>
            <form action="{{ route('posts.store') }}" method="post">
                <div class="form-group row">
                    @csrf
                    <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Título') }}</label>

                    <div class="col-md-6">
                        <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>

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
                        <textarea name="content" id="content" cols="30" class="form-control @error('content') is-invalid @enderror" rows="10" required>{{ old('content') }}</textarea>

                        @error('content')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-8 offset-md-4">
                        <button type="submit" class="btn btn-primary">Crear Post</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection