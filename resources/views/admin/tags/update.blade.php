@extends('layouts.template.admin.app')

@section('title')
Gestión de Tags
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Actualización de Tag</h3>
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
                <form action="{{ route('admin.tags.update',$tag->id) }}" method="post">
                    <div class="form-group row">
                        @csrf
                        @method('PUT')
                        <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                        <div class="col-md-6">
                            <input id="title" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ? old('name') : $tag->name }}" required autocomplete="name" autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        
                    </div>
                    
                    <div class="form-group row">
                        <label for="content" class="col-md-4 col-form-label text-md-right">{{ __('Estado') }}</label>

                        <div class="col-md-6">
                            
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input @error('active') is-invalid @enderror" type="radio" id="radio1" value="0" name="active" {{(old('active',0) == $tag->active ? 'checked' : '')}}>
                                <label for="radio1" class="custom-control-label">Inactivo</label>
                            </div>

                            <div class="custom-control custom-radio">
                                <input class="custom-control-input @error('active') is-invalid @enderror" type="radio" id="radio2" value="1" name="active" {{old('active',1) == $tag->active ? 'checked' : ''}}>
                                <label for="radio2" class="custom-control-label">Activo</label>
                            </div>
                            
                            @error('active')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-primary">Crear Tag</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection