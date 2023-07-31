<?php

namespace App\Http\Controllers;

use App\Models\detalle_servicio;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\historial_servicio;
use App\Models\mascota;
use Carbon\Carbon;

class DetalleServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function detalleServicios($id)
    {
        $servicio   = Historial_servicio::find($id);
        $mascota    = $servicio->mascota;

        $historialServicios = Detalle_servicio::where('historialServicios_id', $id)
                            ->orderby('created_at','desc')
                            ->get();
        
        $fachaActual      = Carbon::now();
        $nacimiento       = Carbon::parse($mascota->anioNacimiento);
        $anio             = $nacimiento->diffInYears( $fachaActual );
        $mes              = $nacimiento->diffInMonths( $fachaActual )-$anio*12;
        if($anio>0){
            $edad = $anio.' años y '.$mes.' meses';
        }
        else{
            $edad = $mes.' meses';
        }
                            
        return view('servicios.historialServicios')
                ->with('historialServicios', $historialServicios)
                ->with('servicio', $servicio)
                ->with('mascota' , $mascota)
                ->with('edad'    , $edad);   
    }
    /**
     * listado de servicios aplicado filtrado por una fecha.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function listaServiciosAplicados($id)
    {   
        $historialServicios = Detalle_servicio::where('fechaAtencion',$id)
                                                ->select('personas.nombre as nombre_cliente','personas.apellido as apellido_cliente','mascotas.nombre as nombre_mascota','mascotas.raza','detalle_servicios.fechaAtencion','detalle_servicios.created_at','detalle_servicios.tipo','detalle_servicios.descripcion')
                                                ->join('historial_servicios','historial_servicios.id','=','detalle_servicios.historialServicios_id')
                                                ->join('mascotas','mascotas.id','=','historial_servicios.mascota_id')
                                                ->join('personas','personas.id','=','mascotas.persona_id')
                                                ->orderBY('detalle_servicios.created_at','Desc')
                                            ->get();

        return view('servicios.listadoDetalleServicio')
                ->with('historialServicios', $historialServicios)
                ->with('fecha', $id);
    }

    /**
     * Show the form for creating a new resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $servicio = Historial_servicio::find($id);
        $mascota  = Mascota::find($servicio->mascota_id);
        
        return view('servicios.createDetalleServicio')
                    ->with('servicio', $servicio)
                    ->with('mascota', $mascota);

    }

    /**
     * Store a newly created resource in storage.
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeServicios(Request $request, $id)
    {
        $request->validate([
            'tipo'        => 'required| string',
            'descripcion' => 'required| string |max:300',  
        ]);

        $fachaActual                            = Carbon::now();
        $detalleServicio                        = new Detalle_servicio();
        $detalleServicio->tipo                  = $request->tipo;
        $detalleServicio->descripcion           = $request->descripcion;
        $detalleServicio->fechaAtencion         = $fachaActual;
        $detalleServicio->historialServicios_id	= $id;
        $detalleServicio->save();
        
        return redirect('/historialServicios/'.$id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\detalle_servicio  $detalle_servicio
     * @return \Illuminate\Http\Response
     */
    public function show(detalle_servicio $detalle_servicio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\detalle_servicio  $detalle_servicio
     * @return \Illuminate\Http\Response
     */
    public function edit(detalle_servicio $detalle_servicio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\detalle_servicio  $detalle_servicio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, detalle_servicio $detalle_servicio)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\detalle_servicio  $detalle_servicio
     * @return \Illuminate\Http\Response
     */
    public function destroy(detalle_servicio $detalle_servicio)
    {
        //
    }
}
