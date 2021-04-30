@extends('layouts.app')

@section('content')
<div class="container">
<h1 class="text-dark font-weight-bold text-center">Listado de Trailers</h1>
<hr><br>
    <div>
        <div class="row row-cols-1 row-cols-md-4 g-4 ">
            
            
            @foreach($peliculas as $pelicula )
                
                <div class="col">
                    <div class="card border-info mb-3" style="width: 16rem;">
                        <img class="card-img-top" class="img-thumbnail img-fluid" src="{{asset('storage').'/'.$pelicula->Link}}" width="25" height="fa-stack-1x000" alt="">
                        <div class="card-body">
                            <ul class="list-group list-group-flush text-center">
                                <li class="list-group-item"><a href=""><h3><b>{{$pelicula->Titulo}}</b></h3></a></li>
                                <li class="list-group-item">Sinópsis<br><em>{{$pelicula->Resumen}}</em></li>
                                <li class="list-group-item">Director: {{$pelicula->Director}}</li>
                                <li class="list-group-item">Género: {{$pelicula->Genero}}</li>
                                <li class="list-group-item">Fecha de estreno:<br> {{$pelicula->Fecha}}</li>
                            </ul>
                        </div>
                    </div>
                </div>
                
            @endforeach
                
        </div>
    </div>
</div>
@endsection