<?php

namespace App\Http\Controllers;

use App\Models\Pelicula;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Contracts\Service\Attribute\Required;

class PeliculaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $losdatos['peliculas']=Pelicula::paginate(10);
        return view('pelicula.index', $losdatos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pelicula.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validando=[
            'Titulo'=>'required|string|max:80',
            'Resumen'=>'required|string|max:300',
            'Director'=>'required|string|max:80',
            'Pais'=>'required|string|max:100',
            'Genero'=>'required|string|max:80',
            'Fecha'=>'required|string|max:80',
            'Link'=>'required|max:10000|mimes:jpeg,png,jpg',
        ];
        $mensajes=[
            'required'=>'El :attribute es requerido, favor de completar.',
            'Link.required'=>'El poster es requerido!'
        ];
        $this->validate($request, $validando, $mensajes);

        //$datosPelicula = request()->all();
        $datosPelicula = request()->except('_token');

        if($request->hasFile('Link')){
            $datosPelicula['Link']=$request->file('Link')->store('uploads','public');
        } 

        Pelicula::insert($datosPelicula);
        //return response()->json($datosPelicula);

        return redirect('pelicula')->with('mensaje','Trailer agregado!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pelicula  $pelicula
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $losdatos['peliculas']=Pelicula::paginate(10);
        return view('pelicula.mostrar', $losdatos);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pelicula  $pelicula
     * @return \Illuminate\Http\Response
     */


    public function edit($id)
    {
        $pelicula=Pelicula::findOrFail($id);
        return view('pelicula.editar', compact('pelicula'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pelicula  $pelicula
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validando=[
            'Titulo'=>'required|string|max:80',
            'Resumen'=>'required|string|max:300',
            'Director'=>'required|string|max:80',
            'Pais'=>'required|string|max:100',
            'Genero'=>'required|string|max:80',
            'Fecha'=>'required|string|max:80',
        ];
        $mensajes=[
            'required'=>'El :attribute es requerido, favor de completar.'
        ];

        if($request->hasFile('Link')){
            $validando=['Link'=>'required|max:10000|mimes:jpeg,png,jpg'];
            $mensajes=['Link.required'=>'El poster es requerido!'];
        }

        $this->validate($request, $validando, $mensajes);

        $datosPelicula = request()->except(['_token','_method']);
        
        if($request->hasFile('Link')){
            $pelicula=Pelicula::findOrFail($id);
            Storage::delete('public/'.$pelicula->Link);
            $datosPelicula['Link']=$request->file('Link')->store('uploads','public');
        } 

        Pelicula::where('id','=',$id)->update($datosPelicula);

        $pelicula=Pelicula::findOrFail($id);
        //return view('pelicula.editar', compact('pelicula'));
        return redirect('pelicula')->with('mensaje','Trailer editado!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pelicula  $pelicula
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pelicula=Pelicula::findOrFail($id);
        if(Storage::delete('public/'.$pelicula->Link)){
            Pelicula::destroy($id);
        }
        
        return redirect('pelicula')->with('mensaje','Trailer eliminado!');
    }

}
