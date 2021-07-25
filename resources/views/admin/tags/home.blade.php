@extends('layouts.template.admin.app')

@section('title')
Gestión de tags
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Tags</h3>
                <div class="card-tools">
                    <a href="{{route('admin.tags.create')}}">Agregar</a>
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Estado</th>
                            <th>Fecha de creación</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tags as $tag)
                            <tr>
                                <td>{{ $tag->name }}</td>
                                <td>{{ $estados[$tag->active] }}</td>
                                <td>{{ $tag->created_at }}</td>
                                <td>
                                    <a href="{{ route('admin.tags.edit',$tag->id) }}">Actualizar</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer clearfix">
                {{$tags->links()}}
            </div>
        </div>
    </div>
</div>
@endsection