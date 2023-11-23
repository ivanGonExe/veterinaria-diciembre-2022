<?php

namespace App\Http\Controllers;

use App\Models\categoria;
use App\Models\articulo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorias  = Categoria::all();
        
      return view ('categoria.index')->with('categorias',$categorias); 
    }
    
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias  = Categoria::all();
        return view('categoria.create')->with('categorias',$categorias); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'descripcion'     => 'required| string |max:50',
        ]);

        $esta = DB::TABLE('categorias')
                  ->where('descripcion','like',$request->get('descripcion'))
                  ->get();
        if(empty($esta[0])){
            $categoria = new Categoria();
            $categoria->descripcion = strtoupper($request->descripcion);
            $categoria-> save();
        }
            $categorias  = Categoria::all();
            $urlAnterior = url()->previous();
            if(strpos($urlAnterior, '/articulos') !== false)
            {
                return redirect(url()->previous());
            }
        
            return view ('categoria.index')
                    ->with('categorias',$categorias);

    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function show(categoria $categoria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * @param  int $id
     * @param  \App\Models\categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categoria = Categoria::find($id);
        $categorias  = Categoria::all();
        return view('categoria.edit')->with('categoria',$categoria)
                                    ->with('categorias',$categorias);
    }

    /**
     * Update the specified resource in storage.
     * @param  int $id
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $categoria = Categoria::find($id);
        $categoria->descripcion = strtoupper($request->descripcion);
        $categoria-> save();

        $categorias  = Categoria::all();
        
        return view ('categoria.index')
                    ->with('categorias',$categorias);

    }

    /**
     * Remove the specified resource from storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function borrarCategoria(Request $request)
    {   
        $categoriaArticulo = Articulo::where('categoria_id', $request->id)
                                    ->get();

        if(count($categoriaArticulo)>0){
            return json_encode(["errores" => [0 =>"¡La categoria deseada a borrar se encuentra en uso de un articulo!"]]);
        }

        try {
            
            $categoria = Categoria::find($request->id);
            $categoria->delete();
            return json_encode(["valido" => [0 =>"¡Categoria borrada correctamante!"]]);

        } catch (Exeption $e) {
            return json_encode(["errores" => "¡Error inesperado!"]);
        }
    }
}
