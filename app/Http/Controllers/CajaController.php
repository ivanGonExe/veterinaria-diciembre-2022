<?php

namespace App\Http\Controllers;

use App\Models\Caja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CajaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cajas  = Cajas::all();
        
      return view ('cajas.index')->with('cajas',$cajas); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function abrirCaja(Request $request)
    {   
        $fecha = Carbon::now();
        $cajaExistente = Caja::where('user_id',$request->usuarioId)
        ->whereDate('fecha','=',$fecha)
        ->get();

        if(count($cajaExistente) == 0){
            $caja = new Caja();
            $caja->user_id = $request->usuarioId;
            $caja->fondoInicial = $request->fondoInicial;
            $caja->fecha = Carbon::now();
            $caja->estado = 1;

            $caja->save();

            //seteo el id de la caja en session
            session(["cajaId" => $caja->id,]);
            // $request->validate([
            //     'descripcion'     => 'required| string |max:50',
            // ]);

            // $esta = DB::TABLE('categorias')
            // ->where('descripcion','like',$request->get('descripcion'))
            // ->get();
            // if(empty($esta[0])){
            //     $categoria = new Categoria();
            //     $categoria->descripcion = $request->get('descripcion');
            //     $categoria-> save();
            // }
            //     $categorias  = Categoria::all();
            
            //     return view ('categoria.index')->with('categorias',$categorias);

            //Esta variable de estado sólo sirve para el javascript, no es el valor real de estado de caja, chequea si está abierta o no para saber qué modal abrir al presionar el botón "abrir caja"
            $estado = 1;
        }
        else if($cajaExistente[0]->estado == 2){
            $estado = 1;
        }
        else{
            $estado = 2;
        }
        return response(json_encode($estado),200)->header('Content-type','text/plain');

    
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function cerrarJornada(Request $request)
    {   
        $fecha = Carbon::now();
        $cajaExistente = Caja::where('user_id',$request->usuarioId)
        ->whereDate('fecha','=',$fecha)
        ->where('estado', '=', 1)
        ->get();

        if(count($cajaExistente) == 1){
            $cajaExistente[0]->estado = 2;

            $cajaExistente[0]->save();

            session()->forget('cajaId');
            // $request->validate([
            //     'descripcion'     => 'required| string |max:50',
            // ]);

            // $esta = DB::TABLE('categorias')
            // ->where('descripcion','like',$request->get('descripcion'))
            // ->get();
            // if(empty($esta[0])){
            //     $categoria = new Categoria();
            //     $categoria->descripcion = $request->get('descripcion');
            //     $categoria-> save();
            // }
            //     $categorias  = Categoria::all();
            
            //     return view ('categoria.index')->with('categorias',$categorias);

            //Esta variable de estado sólo sirve para el javascript, no es el valor real de estado de caja, chequea si está abierta o no para saber qué modal abrir al presionar el botón "abrir caja"
            $estado = 1;
        }
        else{
            $estado = 2;
        }
        return response(json_encode($estado),200)->header('Content-type','text/plain');

    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function abrirCajaAnterior(Request $request)
    {   
        $fecha = Carbon::now();
        $cajaExistente = Caja::where('user_id',$request->usuarioId)
        ->whereDate('fecha','=',$fecha)
        ->where('estado', '=',2)
        ->get();

        if(count($cajaExistente) == 1){

            $cajaExistente[0]->estado = 1;

            $cajaExistente[0]->save();

            session(["cajaId" => $cajaExistente[0]->id,]);
            // $request->validate([
            //     'descripcion'     => 'required| string |max:50',
            // ]);

            // $esta = DB::TABLE('categorias')
            // ->where('descripcion','like',$request->get('descripcion'))
            // ->get();
            // if(empty($esta[0])){
            //     $categoria = new Categoria();
            //     $categoria->descripcion = $request->get('descripcion');
            //     $categoria-> save();
            // }
            //     $categorias  = Categoria::all();
            
            //     return view ('categoria.index')->with('categorias',$categorias);

            //Esta variable de estado sólo sirve para el javascript, no es el valor real de estado de caja, chequea si está abierta o no para saber qué modal abrir al presionar el botón "abrir caja"
            $estado = 1;
        }
        else if($cajaExistente[0]->estado == 2){
            $estado = 1;
        }
        else{
            $estado = 2;
        }
        return response(json_encode($estado),200)->header('Content-type','text/plain');

    
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
     return view ('categoria.edit')->with('categoria',$categoria);
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
        $categoria->descripcion = $request->get('descripcion');
        $categoria-> save();

        $categorias  = Categoria::all();
        
        return view ('categoria.index')->with('categorias',$categorias);

    }

    /**
     * Remove the specified resource from storage.
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categoria = Categoria::find($id);
        $categoria->delete();
        $categorias  = Categoria::all();
        
        return view ('categoria.index')->with('categorias',$categorias);
    }
}
