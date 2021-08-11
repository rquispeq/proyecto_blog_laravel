@extends('layouts.template.admin.app')

@section('title')
Gestión de Categories
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Categories</h3>
                <div class="card-tools">
                    <a href="{{route('admin.categories.create')}}">Agregar</a>
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                @if($categories->isEmpty())
                    <div class="alert alert-info">
                        <span>No hay categorías disponibles</span>
                    </div>
                @endif

                @if(!$categories->isEmpty())
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Estado</th>
                                <th>Fecha de creación</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->slug }}</td>
                                    <td>{{ $category->estados[$category->active] }}</td>
                                    <td>{{ $category->created_at }}</td>
                                    <td>{{ $category->updated_at }}</td>
                                    <td>
                                        <a href="{{ route('admin.categories.edit',$category->id) }}">Actualizar</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
            @if(!$categories->isEmpty())
            <div class="card-footer clearfix">
                {{$categories->links('pagination::bootstrap-4')}}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection