<h1>{{$modo}} Trailer</h1>
<br>
@if(count($errors)>0)

<div class="alert alert-danger" role="alert">
    <ol>
        @foreach($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
    </ol>
</div>

@endif
<br>
<div class="form-group">
<label for="Titulo">Título</label>
<input type="text" class="form-control" name="Titulo" value="{{ isset($pelicula->Titulo)?$pelicula->Titulo:old('Titulo') }}" id="Titulo">
</div>

<div class="form-group">
<label for="Resumen">Resumen</label>
<input type="text" class="form-control" name="Resumen" value="{{ isset($pelicula->Resumen)?$pelicula->Resumen:old('Resumen') }}" id="Resumen">
</div>

<div class="form-group">
<label for="Director">Director</label>
<input type="text" class="form-control" name="Director" value="{{ isset($pelicula->Director)?$pelicula->Director:old('Director') }}" id="Director">
</div>

<div class="form-group">
<label for="Genero">Género</label>
<input type="text" class="form-control" name="Genero" value="{{ isset($pelicula->Genero)?$pelicula->Genero:old('Genero') }}" id="Genero">
</div>

<div class="form-group">
<label for="Fecha">Fecha de estreno</label>
<input type="date" class="form-control" name="Fecha" value="{{ isset($pelicula->Fecha)?$pelicula->Fecha:old('Fecha') }}" id="Fecha">
</div>

<div class="form-group">
<label for="Link">Poster</label>
@if(isset($pelicula->Link))
<img class="img-thumbnail img-fluid" src="{{asset('storage').'/'.$pelicula->Link}}" width="70" height="100" alt="">
@endif
<input type="file" class="form-control" name="Link" value="" id="Link">
</div>

<div class="form-group">
<label for="Pais">Video</label>
<input type="text" class="form-control" name="Pais" value="{{ isset($pelicula->Pais)?$pelicula->Pais:old('Pais') }}" id="Pais">
</div>

<a class="btn btn-secondary font-weight-bold" href="{{url('pelicula/')}}"><-</a> |
<input class="btn btn-success font-weight-bold" type="submit" value="{{$modo}}">
