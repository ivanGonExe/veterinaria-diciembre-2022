<?php

namespace App\Http\Controllers;

use App\Models\DetalleClinico;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class DetalleClinicoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        return view('detalleClinico.create')->with('historialClinico_id', $id);
    }

    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function store(Request $request)
    // {
    //     $detalleClinico = new DetalleClinico();

    //     $fecha = Carbon::now();

    //     $detalleClinico->observaciones       = $request->get('observaciones');
    //     $detalleClinico->tratamiento         = $request->get('tratamiento');
    //     $detalleClinico->patologia           = $request->get('patologia');
    //     $detalleClinico->peso                = $request->peso;
    //     $detalleClinico->historialClinico_id = $request->get('idHistorialClinico');
    //     $detalleClinico->fechaAtencion       = $fecha;
        
    //     $detalleClinico->save();
        

    //     return redirect('historialesClinicos/'.$detalleClinico->historialClinico_id);
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeDetalleClinico(Request $request)
    {
        $validator = Validator::make($request->all(), 
            [
                'observaciones'     => 'string',
                'tratamiento'       => 'required| string',
                'patologia'         => 'required| string',
                'peso'              => 'nullable| integer',
            ], $messages = [
                
            ],
            [
            
            ]
        );
        
        if ($validator->fails()) {
            $errores = $validator->errors()->all();
            return json_encode(["errores" => $errores]);
        }

        $detalleClinico = new DetalleClinico();

        $fecha = Carbon::now();

        $detalleClinico->observaciones       = $request->observaciones;
        $detalleClinico->tratamiento         = $request->tratamiento;
        $detalleClinico->patologia           = $request->patologia;
        $detalleClinico->peso                = $request->peso;
        $detalleClinico->historialClinico_id = $request->idHistorialClinico;
        $detalleClinico->fechaAtencion       = $fecha;
        
        $detalleClinico->save();
        
        return json_encode(["valido" => "¡Detalle clínico creado exitosamente!"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
