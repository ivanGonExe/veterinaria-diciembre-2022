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

        $historialServicios = Detalle_servicio::where('id', $id)
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
     * Show the form for creating a new resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $servicio = Historial_servicio::find($id);
        $mascota  = Mascota::find($servicio->mascota_id);

        return view('servicios.historialServicios')
        ->with('servicio', $servicio)
        ->with('mascota', $mascota);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
