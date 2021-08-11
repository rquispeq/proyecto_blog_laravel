@extends('layouts.template.admin.app')

@section('title')
Gestión de Categorías
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Actualización de Categoría</h3>
                <div class="card-tools">
                    <a href="{{route('admin.categories.create')}}">Agregar</a>
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
                <form action="{{ route('admin.categories.update',$category->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                        <div class="col-md-6">
                            <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" value="{{old('name',$category->name)}}" name="name" required>

                            @error('name')
                            <strong class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </strong>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="content" class="col-md-4 col-form-label text-md-right">Estado</label>
                        <div class="col-md-6">
                            @foreach($status as $key => $state)
                                <div class="custom-control custom-radio">
                                    <input type="radio" name="active" class="custom-control-input @error('active') is-invalid @enderror " id="active{{$key}}" value="{{$key}}" {{ old('active',$category->active) == $key ?  'checked' : ''}}>
                                    <label for="active{{$key}}" class="custom-control-label">{{$state}}</label>
                                </div>
                            @endforeach

                            @error('active')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-primary">Actualizar Categoría</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

