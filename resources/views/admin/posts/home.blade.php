@extends('layouts.template.admin.app')

@section('title')
Gestión de Posts
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Posts</h3>
                <div class="card-tools">
                    <a href="{{route('admin.posts.create')}}">Agregar</a>
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Título</th>
                            <th>Estado</th>
                            <th>Fecha de creación</th>
                            <th>Última edición</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($posts as $post)
                            <tr>
                                <td>{{ $post->title }}</td>
                                <td>{{ $post->active }}</td>
                                <td>{{ $post->created_at }}</td>
                                <td>{{ $post->updated_at }}</td>
                                <td>
                                    <a href="{{ route('admin.posts.show',$post->id) }}">Ver</a>
                                    <a href="{{ route('admin.posts.edit',$post->id) }}">Actualizar</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer clearfix">
                {{$posts->links('pagination::bootstrap-4')}}
            </div>
        </div>
    </div>
</div>
@endsection