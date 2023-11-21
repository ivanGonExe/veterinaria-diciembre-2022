<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mascota;
use App\Models\Persona;
use App\Models\HistorialClinico;
use App\Models\historial_servicio;
use App\Models\Especie;
use App\Models\Raza;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


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
        //$especie = Especie::all();
        
        return view('mascota.create')
                                ->with('persona_id', $id)
                                //->with('especie', $especie)
                                ;
    }

    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function store(Request $request)
    // {

    //     $request->validate([
    //         'nombre'        => 'required| string |max:20',
    //         'raza'          => 'required| string',
    //         'especie'       => 'required| string',
    //         'sexo'          => 'required| string|max:6|min:5',
    //         'color'         => 'required| string| max:40',  
    //         'esterilizado'  => 'required| string |max:2|min:2', 
    //         'anioNacimiento'=> 'required|date', 

    //     ]);

    //     $mascota = Mascota::where([
    //         ['nombre',         '=', mb_strtoupper($request->nombre,'UTF-8')],
    //         ['raza',           '=', mb_strtoupper($request->raza,'UTF-8')],
    //         ['especie',        '=', mb_strtoupper($request->especie,'UTF-8')],
    //         ['sexo',           '=', mb_strtoupper($request->sexo,'UTF-8')],
    //         ['color',          '=', mb_strtoupper($request->color,'UTF-8')],
    //         ['esterilizado',   '=', mb_strtoupper($request->esterilizado,'UTF-8')],
    //         ['anioNacimiento', '=', $request->get('anioNacimiento')],
    //         ['persona_id',     '=', $request->get('id')],
    //     ])->get();

    //     if(count($mascota) > 0){
    //         dd();
    //     }
    //     else{
    //         dd("No existe");
    //     }

    //     $mascota = new Mascota();

    //     $persona = Persona::find($request->get('id'));

    //     $mascota->nombre         = mb_strtoupper($request->nombre,'UTF-8');
    //     $mascota->raza           = mb_strtoupper($request->raza,'UTF-8');
    //     $mascota->especie        = mb_strtoupper($request->especie,'UTF-8');
    //     $mascota->sexo           = mb_strtoupper($request->sexo,'UTF-8');
    //     $mascota->color          = mb_strtoupper($request->color,'UTF-8');
    //     $mascota->esterilizado   = mb_strtoupper($request->esterilizado,'UTF-8');
    //     $mascota->estado         = 1;
    //     $mascota->anioNacimiento = $request->get('anioNacimiento');
    //     $mascota->persona_id     = $request->get('id');
        
    //     $mascota->save();

    //     $historialClinico             = new HistorialClinico();
    //     $historialClinico->mascota_id = $mascota->id;
    //     $historialClinico->save();

    //     $historialServicio             = new historial_servicio();
    //     $historialServicio->mascota_id = $mascota->id;
    //     $historialServicio->save();


    //     return redirect($request->get('urlAnterior'));

    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function crearMascota(Request $request, $id)
    {   
        //Primero chequeo que no exista la mascota para el mismo cliente
        $mascota = Mascota::where([
            ['nombre',         '=', mb_strtoupper($request->nombre,'UTF-8')],
            ['raza',           '=', mb_strtoupper($request->raza,'UTF-8')],
            ['especie',        '=', mb_strtoupper($request->especie,'UTF-8')],
            ['sexo',           '=', mb_strtoupper($request->sexo,'UTF-8')],
            ['color',          '=', mb_strtoupper($request->color,'UTF-8')],
            ['esterilizado',   '=', mb_strtoupper($request->esterilizado,'UTF-8')],
            ['anioNacimiento', '=', $request->get('anioNacimiento')],
            ['persona_id',     '=', $id],
        ])->get();
    
        if(count($mascota) > 0){
            return json_encode(["errores" => [0 =>"¡La mascota ingresada ya existe!"], "mascota" => $mascota]);
        }

        $validator = Validator::make($request->all(), 
            [
                'nombre'        => 'required| string |max:20',
                'raza'          => 'required| string',
                'especie'       => 'required| string',
                'sexo'          => 'required| string|max:6|min:5',
                'color'         => 'required| string| max:40',  
                'esterilizado'  => 'required| string |max:2|min:2', 
                'anioNacimiento'=> 'required|date', 
            ], $messages = [
                
            ],
            [
                'anioNacimiento' => 'año de nacimiento'
            ]
        );
 
        if ($validator->fails()) {
            $errores = $validator->errors()->all();
            return json_encode(["errores" => $errores]);
        }

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
        $mascota->persona_id     = $id;
        
        $mascota->save();

        $historialClinico             = new HistorialClinico();
        $historialClinico->mascota_id = $mascota->id;
        $historialClinico->save();

        $historialServicio             = new historial_servicio();
        $historialServicio->mascota_id = $mascota->id;
        $historialServicio->save();


        return json_encode(["valido" => "¡Mascota creada exitosamente!"]);

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

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(Request $request, $id)
    // {   
    //     $mascota = Mascota::find($id);

    //     //Primero chequeo que no exista la mascota para el mismo cliente
    //     $mascotaAux = Mascota::where([
    //         ['nombre',         '=', mb_strtoupper($request->nombre,'UTF-8')],
    //         ['raza',           '=', mb_strtoupper($request->raza,'UTF-8')],
    //         ['especie',        '=', mb_strtoupper($request->especie,'UTF-8')],
    //         ['sexo',           '=', mb_strtoupper($request->sexo,'UTF-8')],
    //         ['color',          '=', mb_strtoupper($request->color,'UTF-8')],
    //         ['esterilizado',   '=', mb_strtoupper($request->esterilizado,'UTF-8')],
    //         ['anioNacimiento', '=', $request->get('anioNacimiento')],
    //         ['persona_id',     '=', $mascota->persona_id],
    //     ])->get();
        
    //     if(count($mascotaAux) > 0 && $mascota->id != $mascotaAux[0]->id){
    //         dd("Entró");
    //         return json_encode(["errores" => [0 =>"¡La mascota ingresada ya existe!"], "mascota" => $mascota]);
    //     }

    //     $validator = Validator::make($request->all(), 
    //         [
    //             'nombre'        => 'required| string |max:20',
    //             'raza'          => 'required| string',
    //             'especie'       => 'required| string',
    //             'sexo'          => 'required| string|max:6|min:5',
    //             'color'         => 'required| string| max:40',  
    //             'esterilizado'  => 'required| string |max:2|min:2', 
    //             'anioNacimiento'=> 'required|date', 
    //         ], $messages = [
                
    //         ],
    //         [
    //             'anioNacimiento' => 'año de nacimiento'
    //         ]
    //     );
 
    //     if ($validator->fails()) {
    //         $errores = $validator->errors()->all();
    //         return json_encode(["errores" => $errores]);
    //     }
        
    //     $mascota->nombre         = mb_strtoupper($request->nombre, 'UTF-8');
    //     $mascota->raza           = mb_strtoupper($request->raza,'UTF-8');
    //     $mascota->especie        = mb_strtoupper($request->especie,'UTF-8');
    //     $mascota->sexo           = mb_strtoupper($request->sexo,'UTF-8');
    //     $mascota->color          = mb_strtoupper($request->color,'UTF-8');
    //     $mascota->esterilizado   = mb_strtoupper($request->esterilizado,'UTF-8');
    //     $mascota->anioNacimiento = $request->anioNacimiento;
    //     //$mascota->persona_id     = $request->get('id');

    //     $mascota->save();

    //     return redirect($request->get('urlAnterior'));
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editarMascota(Request $request, $id)
    {
        $mascota = Mascota::find($id);

        //Primero chequeo que no exista la mascota para el mismo cliente
        $mascotaAux = Mascota::where([
            ['nombre',         '=', mb_strtoupper($request->nombre,'UTF-8')],
            ['raza',           '=', mb_strtoupper($request->raza,'UTF-8')],
            ['especie',        '=', mb_strtoupper($request->especie,'UTF-8')],
            ['sexo',           '=', mb_strtoupper($request->sexo,'UTF-8')],
            ['color',          '=', mb_strtoupper($request->color,'UTF-8')],
            ['esterilizado',   '=', mb_strtoupper($request->esterilizado,'UTF-8')],
            ['anioNacimiento', '=', $request->get('anioNacimiento')],
            ['persona_id',     '=', $mascota->persona_id],
        ])->get();
    
        if(count($mascotaAux) > 0 && $mascota->id != $mascotaAux[0]->id){
            return json_encode(["errores" => [0 =>"¡La mascota ingresada ya existe!"], "mascota" => $mascota]);
        }

        $validator = Validator::make($request->all(), 
            [
                'nombre'        => 'required| string |max:20',
                'raza'          => 'required| string',
                'especie'       => 'required| string',
                'sexo'          => 'required| string|max:6|min:5',
                'color'         => 'required| string| max:40',  
                'esterilizado'  => 'required| string |max:2|min:2', 
                'anioNacimiento'=> 'required|date', 
            ], $messages = [
                
            ],
            [
                'anioNacimiento' => 'año de nacimiento'
            ]
        );
 
        if ($validator->fails()) {
            $errores = $validator->errors()->all();
            return json_encode(["errores" => $errores]);
        }
        
        $mascota->nombre         = mb_strtoupper($request->nombre, 'UTF-8');
        $mascota->raza           = mb_strtoupper($request->raza,'UTF-8');
        $mascota->especie        = mb_strtoupper($request->especie,'UTF-8');
        $mascota->sexo           = mb_strtoupper($request->sexo,'UTF-8');
        $mascota->color          = mb_strtoupper($request->color,'UTF-8');
        $mascota->esterilizado   = mb_strtoupper($request->esterilizado,'UTF-8');
        $mascota->anioNacimiento = $request->anioNacimiento;
        //$mascota->persona_id     = $request->get('id');

        $mascota->save();

        return json_encode(["valido" => "¡Mascota editada exitosamente!"]);
    }

    /**
     * Remove the specified resource from storage.
     * 
     *@param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function darDeBajaMascota(Request $request)
    {   
        
        try {
            $mascota         = Mascota::find($request->idMascota);
            $mascota->estado = 0;
            $mascota->save();

        return json_encode(["valido" => "¡Mascota dada de baja exitosamente!"]);

        } catch (Exeption $e) {
            return json_encode(["errores" => "¡Error inesperado!"]);
        }
    }
        
    
     /**
     * Enable the specified resource from storage.
     * 
     *@param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function habilitarMascota(Request $request)
    {
        $mascota         = Mascota::find($request->idMascota);
        $mascota->estado = 1;
        $mascota->save();

        return json_encode(["valido" => "¡Mascota habilitada exitosamente!"]);

        //return redirect()->route('mascotas.index');
        
    }
    
    
}
