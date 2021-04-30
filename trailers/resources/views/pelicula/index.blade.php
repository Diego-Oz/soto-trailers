@extends('layouts.app')
<style>
    
</style>

@section('content')
<div class="container">
<h1 class="text-dark font-weight-bold text-center">Listado de Trailers</h1>
<hr>


@if(Session::has('mensaje'))
    <div class="alert alert-success alert-dismissible" role="alert">
        {{Session::get('mensaje')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>
@endif

    


<a href="{{url('pelicula/create')}}" class="btn btn-success"><i class="material-icons">library_add</i></a>
<a href="{{url('pelicula/show')}}" class="btn btn-primary"><i class="material-icons">movie</i></a>
<br><br>

<table class="table table-light">
    
    <thead class="thead-light">
        <tr>
            <th>#</th>
            <th>Poster</th>
            <th>Titulo</th>
            <th>Resumen</th>
            <th>Director</th>
            <th>Genero</th>
            <th>Fecha de estreno</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach( $peliculas as $pelicula )
        <tr>
            <td>{{$pelicula->id}}</td>
            <td><img class="img-thumbnail img-fluid" src="{{asset('storage').'/'.$pelicula->Link}}" width="50" height="fa-stack-1x00" alt=""></td>
            <td>{{$pelicula->Titulo}}</td>
            <td>{{$pelicula->Resumen}}</td>
            <td>{{$pelicula->Director}}</td>
            <td>{{$pelicula->Genero}}</td>
            <td>{{$pelicula->Fecha}}</td>
            <td>

            <a href="{{url('/pelicula/'.$pelicula->id.'/edit')}}" class="btn btn-warning"><i class="material-icons">edit</i></a>            
            <form action="{{url('/pelicula/'.$pelicula->id)}}" class="d-inline" method="post">
            @csrf
            {{method_field('DELETE')}}
            <input class="btn btn-danger text-dark font-weight-bold" type="submit" onclick="return confirm('Quierer eliminar este trailer?')" value="  X  ">
            </form>

            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{!! $peliculas->links() !!}
</div>
@endsection