<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;
use App\Models\Telefono;
use App\Models\Turno;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Exception;

class PersonaController extends Controller
{
    /**
     * Visualización de personas habilitadas.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $personas = Persona::where('estado','1')->get();
        return view('persona.index')->with('personas', $personas);
    }

    /**
     * Estaditicas de los clientes nuevos por mes.
      * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function clientesNuevosPorMes($id)
    {   
        $año = $id;
        $fechaActual = Carbon::createFromDate($id.'-12-31');
        $mesfor      = $fechaActual->format('m')-1+1;
        $año         = $fechaActual->format('Y');
        $arreglo=[]; 
        
         for($i=$mesfor; $i>0; $i--){
            $mesFecha    = $fechaActual->format('m');
            $mesInicio   = $año."-".$mesFecha."-01";
            $diasFin     = $fechaActual->lastOfMonth()->endOfday()->format('d');
            $mesFin      = $año."-".$mesFecha."-".$diasFin;
            
            $clientes = DB::table('Personas')
                                      ->select(DB::raw('count(personas.id) as cantidad'))
                                      ->whereBetween('personas.created_at',[$mesInicio, $mesFin ])
                                      ->get();

           if($clientes[0]->cantidad == null){
                $arreglo[$i]=0;
           }
           else{
                $arreglo[$i]= $clientes[0]->cantidad;
           } 
           $mesFecha    = $mesFecha-1;
           $fechaActual = Carbon::createFromDate($año,$mesFecha,12);
        }
        
        
        $labels      = array('Enero','febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'); 
        $titulo      = 'año:'.$año;
        
        return view('estadistica.estadisticaNuevoClientes')
                                    ->with('arreglo', $arreglo)
                                    ->with('labels',$labels)
                                    ->with('año',$año);
    }

     /**
     * Display a listing of the resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function personasEstado($id)
    {
        if($id == 1)
            {
             $personas = Persona::where('estado','1')->get();
             return view('persona.index')->with('personas', $personas);
            }
        if($id == 0)
        {
            $personas = Persona::where('estado','0')->get();
            return view('persona.indexdisabled')->with('personas', $personas); 
        }
    }


    

    /**
     * Visualización del formulario de creación de persona.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('persona.create');
    }

    /**
     * Chequeo, validación y almacenamiento de persona.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function crearPersona(Request $request)
    {
        $validator = Validator::make($request->all(), 
            [
                'nombre'     => 'required| string',
                'apellido'   => 'required| string',
                'dni'        => 'required|integer|unique:personas,dni|max:100000000|min:1000000',
                'direccion'  => 'required|string|max:256| min:4',
                'numeroCalle'=> 'required|integer|min:1|max:9999',
                'codigoArea' => 'required|numeric|max:9999|min:99',
                'telefono'   => 'required|numeric|max:9999999|min:999999',
            ], $messages = [
                'dni.unique' => '¡Ya existe una persona con el dni ingresado!',
            ],
            [
                'direccion' => 'dirección',
                'numeroCalle' => 'número de calle',
                'codigoArea' => 'código área',
                'telefono' => 'teléfono'
            ]
        );
 
        if ($validator->fails()) {
            $errores = $validator->errors()->all();
            return json_encode(["errores" => $errores]);
        }
        
        try {
            $persona = new Persona();

            $persona->nombre      = mb_strtoupper($request->nombre,'UTF-8');
            $persona->apellido    = mb_strtoupper($request->apellido,'UTF-8');
            $persona->dni         = $request->get('dni');
            $persona->direccion   = mb_strtoupper($request->direccion,'UTF-8');
            $persona->numeroCalle = $request->numeroCalle;
            $persona->estado      = 1;
            
            $persona->save();
            $telefono = new Telefono();
            $telefono->numero     = $request->telefono;
            $telefono->codigoArea = $request->codigoArea;
            $telefono->persona_id = $persona->id;
            $telefono->estado     = 1;

            $telefono->save();

            return json_encode(["valido" =>[ 0 => "¡Persona creada exitosamente!"]]);

        } catch (Exception $e) {
            return json_encode(["errores" => "¡Error inesperado!"]);
        }
    }

    /**
     * Chequeo, validación y almacenamiento de persona editada.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editarPersona(Request $request, $id)
    {   

        $validator = Validator::make($request->all(), 
            [
                'nombre'     => 'required| string',
                'apellido'   => 'required| string',
                'dni'        => 'required|integer|max:100000000|min:1000000',
                'direccion'  => 'required|string|max:256| min:4',
                'numeroCalle'=> 'required|integer|min:1|max:9999', 
            ], $messages = [
                'dni.unique' => '¡Ya existe una persona con el dni ingresado!',
            ],
            [
                'direccion' => 'dirección',
                'numeroCalle' => 'número de calle'
            ]
        );
 
        if ($validator->fails()) {
            $errores = $validator->errors()->all();
            return json_encode(["errores" => $errores]);
        }

        try {
            $persona = Persona::find($id);

            $personaAux = Persona::where('dni',$request->get('dni'))
                                ->get();

            if($personaAux[0]->id != $id){
                return json_encode(["errores" => [0 =>"¡Ya existe una persona con el dni ingresado!"]]);
            }

            $persona->nombre      = mb_strtoupper($request->nombre,'UTF-8');
            $persona->apellido    = mb_strtoupper($request->apellido,'UTF-8');
            $persona->dni         = $request->get('dni');
            $persona->direccion   = mb_strtoupper($request->direccion,'UTF-8');
            $persona->numeroCalle = $request->numeroCalle;
            $persona->telefonos($request->get('telefono'));
            
            $persona->save();

            return json_encode(["valido" => [ 0 => "¡Persona editada exitosamente!"]]);

        } catch (Exception $e) {
            return json_encode(["errores" => "¡Error inesperado!"]);
        }

    }

    /**
     * Visualización de una persona.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $persona = Persona::find($id);
        //$telefonos = DB::table('telefonos')->where('persona_id',$id)->get();
        
        return view('persona.show')->with('persona', $persona);
    }

    /**
     * Visialización de formulario de edición de persona.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $persona = Persona::find($id);

        return view('persona.edit')->with('persona', $persona);
    }

    /**
     * Función para deshabilitar una persona.
     * 
     *@param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function deshabilitarPersona(Request $request)
    {   
        try {
            $persona = Persona::find($request->idPersona);
            $persona->estado = 0;
            $persona->telefonos->estado = 0;
            $persona->telefonos->save();
            $persona->save();

            return json_encode(["valido" => [ 0 => "¡Persona deshabilitada exitosamente!"]]);

        } catch (Exception $e) {
            return json_encode(["errores" => "¡Error inesperado!"]);
        }
    }

     /**
     * Función para habilitar una persona.
     * 
     *@param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function habilitarCliente(Request $request)
    {
        try {
            $persona = Persona::find($request->idPersona);
            $persona->estado = 1;
            $persona->telefonos->estado = 1;
            $persona->telefonos->save();
            $persona->save();

            return json_encode(["valido" => [ 0 => "¡Persona habilitada exitosamente!"]]);

        } catch (Exception $e) {
            return json_encode(["errores" => "¡Error inesperado!"]);
        }
        
    }
}
