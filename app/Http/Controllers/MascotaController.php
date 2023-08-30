<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mascota;
use App\Models\Persona;
use App\Models\HistorialClinico;
use App\Models\historialServicio;
use App\Models\Especie;
use App\Models\Raza;
use Illuminate\Support\Facades\DB;


class MascotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mascotas = Mascota::where('estado',1)->get();
        return view('mascota.index')->with('mascotas', $mascotas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        // $especie = Especie::all();
        
        return view('mascota.create')
                                ->with('persona_id', $id)
                                // ->with('especie', $especie)
                                ;
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
            'nombre'        => 'required| string |max:20',
            'raza'          => 'required| string',
            'especie'       => 'required| string',
            'sexo'          => 'required| string|max:6|min:5',
            'color'         => 'required| string| max:40',  
            'esterilizado'  => 'required| string |max:2|min:2', 
            'anioNacimiento'=> 'required|date', 

        ]);

        $mascota = new Mascota();

        $persona = Persona::find($request->get('id'));

        $mascota->nombre         = mb_strtoupper($request->nombre,'UTF-8');
        $mascota->raza           = mb_strtoupper($request->raza,'UTF-8');
        $mascota->especie        = mb_strtoupper($request->especie,'UTF-8');
        $mascota->sexo           = mb_strtoupper($request->sexo,'UTF-8');
        $mascota->color          = mb_strtoupper($request->color,'UTF-8');
        $mascota->esterilizado   = mb_strtoupper($request->esterilizado,'UTF-8');
        $mascota->estado         = 1;
        $mascota->anioNacimiento = $request->get('anioNacimiento');
        $mascota->persona_id     = $request->get('id');
        
        $mascota->save();

        $historialClinico             = new HistorialClinico();
        $historialClinico->mascota_id = $mascota->id;
        $historialClinico->save();

        $historialServicio             = new HistorialServicio();
        $historialServivio->mascota_id = $mascota->id;
        $historialServicio->save();


        return redirect($request->get('urlAnterior'));

    }
 /**
     * Show the form for creating a new resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function verMascota($id)
    {
        // $mascotas = DB::Table('mascotas') 
        // ->leftJoin('personas', 'mascotas.persona_id', '=', 'personas.id')
        // ->select('mascotas.*','personas.nombre AS nomPerso','personas.apellido AS apePerso')
        // ->where("persona_id",$id)

        // ->get();
        //dd($mascotas);
        
        $mascotas = Mascota::where('persona_id',$id)
                           ->where('estado',1)    
                           ->get();

        $persona  = Persona::find($id);

        $url = url()->previous();

        return view('mascota.index')
                ->with('mascotas', $mascotas)
                ->with('persona',$persona)
                ->with('url',$url);
    }
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function verBajaMascota()
    {
        $mascotas = Mascota::where('estado',0)->get();

        return view('mascota.deshabilitado')
                  ->with('mascotas', $mascotas);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $mascota = Mascota::find($id);
        
        return view('mascota.show')->with('mascota', $mascota);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mascota = Mascota::find($id);

        return view('mascota.edit')
                  ->with('mascota', $mascota);
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
        $request->validate([
            'nombre'        => 'required| string |max:20',
            'color'         => 'required| string| max:40', 
            'esterilizado'  => 'required| string |max:2|min:2',  
            'raza'          => 'required| string',
            'especie'       => 'required| string',
            'sexo'          => 'required| string|max:6|min:5',
            'anioNacimiento'=> 'required|date', 

        ]);

        $mascota = Mascota::find($id);
        
        $mascota->nombre         = mb_strtoupper($request->nombre, 'UTF-8');
        $mascota->raza           = mb_strtoupper($request->raza,'UTF-8');
        $mascota->especie        = mb_strtoupper($request->especie,'UTF-8');
        $mascota->sexo           = mb_strtoupper($request->sexo,'UTF-8');
        $mascota->color          = mb_strtoupper($request->color,'UTF-8');
        $mascota->esterilizado   = mb_strtoupper($request->esterilizado,'UTF-8');
        $mascota->anioNacimiento = $request->anioNacimiento;
        $mascota->persona_id     = $request->get('id');

        $mascota->save();

        return redirect($request->get('urlAnterior'));
    }

    /**
     * Remove the specified resource from storage.
     * 
     *@param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $mascota         = Mascota::find($id);
        $mascota->estado = 0;
        $mascota->save();
        return redirect()->route('mascotas.index');
        
    }
     /**
     * Enable the specified resource from storage.
     * 
     *@param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function habitarMascota($id, Request $request)
    {
        $mascota         = Mascota::find($id);
        $mascota->estado = 1;
        $mascota->save();
        return redirect()->route('mascotas.index');
        
    }
    
    
}
