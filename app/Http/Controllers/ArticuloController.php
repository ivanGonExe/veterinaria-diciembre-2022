<?php

namespace App\Http\Controllers;

use App\Models\Articulo;
use App\Models\Categoria;
use App\Models\LoteDescripcion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class ArticuloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $articulos = Articulo::where('estado',1)
                             ->orderBy('descripcion','Asc')
                             ->get();

        $categoria = Categoria::all();

      return view ('articulo.index')
                ->with('articulos',$articulos)
                ->with('categoria',$categoria)
                ->with('idCategoria', 0); 
    }
//-------------------------------------------------------------------------
/**
     * Display a listing of the resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
public function ArticulosPorCategoria($id)
{
    if($id == 0){
        return redirect('/articulos');
    } 

    $articulos = Articulo::where('estado',1)
                         ->where('articulos.categoria_id',$id)
                         ->orderBy('descripcion','Asc')
                         ->get();
    
    $categoria = Categoria::orderby('descripcion','Asc')
                          ->get();

    return view ('articulo.index')
            ->with('articulos',$articulos)
            ->with('categoria',$categoria)
            ->with('idCategoria',$id); 
}
//-------------------------------------------------------------------------
    /** traigo los articulos vencidos
     
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function Vencimiento(Request $request)
    { 
        // filtro vencimiento
        $fechaActual = Carbon::now();

        $resultados = DB::select('select lote_descripcions. *, articulos.descripcion,articulos.alerta, TIMESTAMPDIFF(DAY,CURDATE(), lote_descripcions.vencimiento) AS dias from lote_Descripcions inner join articulos on (articulos.id = lote_Descripcions.articulo_id) where ((lote_descripcions.vencimiento <= CURDATE())and(lote_Descripcions.estado = 1)) or ((articulos.alerta >= TIMESTAMPDIFF(DAY,CURDATE(), lote_descripcions.vencimiento) )and(lote_Descripcions.estado = 1)and(articulos.alerta <> 0))');
        session()->forget('notificacionVencido');

        return view('articulo.vencidos')
                  ->with('resultados',$resultados);
    }
//-------------------------------------------------------------------------
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = categoria::all();
        return view('articulo.create')
                  ->with('categorias',$categorias);
    }
//-------------------------------------------------------------------------
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( Request  $request)
    {   
        $request->validate([
            'descripcion'    => 'required| string | max:200 |min:2',
            'precioVenta'    => 'required| numeric |max:99999',
            'iva'            => 'required| numeric |max:100',
            'minimoStock'    => 'nullable| numeric',
            'alerta'         => 'nullable| integer |max:100',
            'porcentGanancia'=> 'numeric',
        ]);

        $articulosAux = DB::TABLE('articulos')
                                ->where('descripcion','=',$request->descripcion)
                                ->get();

        if(count($articulosAux) == 0){

            $Articulos                  = new Articulo();
            $Articulos->descripcion     = strtoupper($request->descripcion);
            $Articulos->precioVenta     = $request->precioVenta;
            $Articulos->minimoStock     = $request->minimoStock;
            $Articulos->alerta          = $request->alerta;
            $Articulos->iva             = $request->iva;
            $Articulos->estado          = 1;
            $Articulos->categoria_id    = $request->categoria;
            $Articulos->porcentGanancia = $request->porcentGanancia;
            $Articulos->save();
            $Articulos->codigo          = $request->categoria.'-'.$Articulos->id;
            $Articulos->save();
            
         }

    $articulos = Articulo::where('estado',1)
                         ->orderBy('updated_at','Desc')
                         ->get();
    $categoria = Categoria::orderby('descripcion','Asc')
                         ->get();
    return view ('articulo.index')
                         ->with('articulos',$articulos)
                         ->with('categoria',$categoria)
                         ->with('idCategoria', 0); 
        }
//-------------------------------------------------------------------------
/**
     * Guardar configuracion de ganacia de un articulo por id (request->id).
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function GuardarConfigArticulo(Request $request)
    {
        $salida = false;
        
        $articulos = Articulo::find($request->id);
        
       
        if(!$articulos){
            $salida = false;
            return response(json_encode($salida),200)->header('Content-type','text/plain');
        }
        else{
            $articulos->porcentGanancia = $request->porcentaje;
            $articulos->precioVenta     = $request->precioVenta;
            $articulos->save();            
            $salida = true;

        return response(json_encode($salida),200)->header('Content-type','text/plain');
        }
        
    }
        
//-------------------------------------------------------------------------
    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id )
    {   
        $Articulos = Articulo::find($id);

        return view('articulo.show')
                   ->with ('articulos',$Articulos);
    }
//-------------------------------------------------------------------------
    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $articulos  = Articulo::find($id);
        $categorias = categoria::all();

    return view('articulo.edit')
                ->with ('articulos',$articulos)
                ->with ('estado',1)
                ->with('categorias',$categorias);
    }
//-------------------------------------------------------------------------
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'descripcion'    => 'required| string | max:200 |min:2',
            'precioVenta'    => 'required| numeric |max:99999',
            'iva'            => 'required| numeric |max:100',
            'minimoStock'    => 'nullable| numeric',
            'alerta'         => 'nullable| integer |max:100',
            'porcentGanancia'=> 'numeric',
        ]);
        
    $Articulos                  = Articulo::find($id);  
    $Articulos->descripcion     = strtoupper($request->descripcion);
    $Articulos->precioVenta     = $request->precioVenta;
    $Articulos->minimoStock     = $request->minimoStock;
    $Articulos->alerta          = $request->alerta;
    $Articulos->iva             = $request->iva;
    $Articulos->categoria_id    = $request->categoria;
    $Articulos->porcentGanancia = $request->porcentGanancia;
    $Articulos->save();
    $Articulos->codigo          = $request->categoria.'-'.$Articulos->id;
    $Articulos->save();
    

    $articulos = Articulo::where('estado',1)
                         ->orderBy('updated_at','Desc')
                         ->get();

    $categoria = Categoria::orderby('descripcion','Asc')
                         ->get();
    return view ('articulo.index')
                         ->with('articulos',$articulos)
                         ->with('categoria',$categoria)
                         ->with('idCategoria', 0); 
    }
//-------------------------------------------------------------------------
    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $articulos = Articulo::find($id);
        
        $lote      = loteDescripcion::where('articulo_id',$id)
                                    ->get();
        if( $lote == null){
            $articulos->delete();  
        }else{
            $articulos->estado = 0;
            $articulos->save();
        }
       
        return redirect('/articulos');  
    }
}
