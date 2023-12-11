<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Exception;


class Usuario extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = user::all();
        return view('administrador.usuarios')->with('usuarios', $usuarios);
    }



    /**
     * Show the form for editing the specified resource.
     * @param  int $id
     * @param  \App\Models\loteDescripcion  $loteDescripcion
     * @return \Illuminate\Http\Response
     */
    public function CambioEstadoInicio($id)
    {
        $idUsuario              = auth()->user()->id;
        $usuario                = user::find($idUsuario);
        if($id == 1){
            $usuario->estadoIngreso ='veterinario';
            $usuario->save();
        }

        if($id == 2){
            $usuario->estadoIngreso ='peluquero';
            $usuario->save();
        }
        if($id == 3){
            $usuario->estadoIngreso ='cajero';
            $usuario->save();
        }
        if($id == 4){
            $usuario->estadoIngreso ='';
            $usuario->save();  
        }
        return redirect('/vistaRoles');
    }


    

     /**
     * Show the form for editing the specified resource.
     * @param  int $id
     * @param  \App\Models\loteDescripcion  $loteDescripcion
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $usuario = user::find($id);
        return view ('administrador.editar')->with('usuario',$usuario);
    }

    /**
     * Show the form for editing the specified resource.
     * @param  int $id
     * @param  \App\Models\loteDescripcion  $loteDescripcion
     * @return \Illuminate\Http\Response
     */
    public function editPassword($id)
    {
        $usuario = user::find($id);
        return view ('administrador.editPassword')->with('usuario',$usuario);
    }

    /**
     * Update the specified resource in storage.
     * @param $id
     * @param  \Illuminate\Http\Request  $request
     
     * @return \Illuminate\Http\Response
     */
    public function editarUsuario(Request $request, $id)
    
    {   
        $validator = Validator::make($request->all(), 
            [
                'name'     => 'required| string | max:255',
                'email'    => 'required| string |email |max:255 ',
                'tipo'     => 'required| string',
            ], $messages = [
                
            ],
            [
                'name' => 'nombre de usuario',
                'tipo'     => 'rol',
            ]
        );
        
        $consulta = User::where('email', '=',$request->email)
                        ->where('id','<>', $id)
                        ->get();

        if ($consulta != null) {
            return json_encode(["errores" => [0 => 'Ya existe un usuario con el correo ingresado']]);
        }

        if ($validator->fails()) {
            $errores = $validator->errors()->all();
            return json_encode(["errores" => $errores]);
        }

        $usuario         = user::find($id);
        $usuario->name   = $request->nombre;
        $usuario->email  = $request->mail;
        $usuario->tipo   = $request->tipo;
        $usuario->save();

        return json_encode(["valido" => [0 => "¡Usuario editado exitosamente!"]]);

    }



     /**
     * Update the specified resource in storage.
     * @param $id
     * @param  \Illuminate\Http\Request  $request
     
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request, $id)
    {  
     $request->validate([
        'password' => 'required| string|min:8',
     ]);
        $usuario = user::find($id);
       
        $usuario->password = Hash::make($request->password);
        $usuario->save();
        return redirect('/usuario');
    }
    



     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auth.registro');
        
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function crearUsuario(Request $request)
    {

        $request->validate([
             
        ]);

        $validator = Validator::make($request->all(), 
            [
                'name'     => 'required| string | max:255',
                'email'    => 'required| string |email |max:255 |unique:users',
                'password' => 'required| string|min:8|confirmed',
                'tipo'     => 'required| string',
            ], $messages = [
                'email.unique' => '¡Ya existe un usuario con el email ingresado!',
            ],
            [
                'name' => 'nombre de usuario',
                'tipo'     => 'rol',
                'password' => 'contraseña'
            ]
        );

        if ($validator->fails()) {
            $errores = $validator->errors()->all();
            return json_encode(["errores" => $errores]);
        }

        $usuario = new User();
        $usuario->name     = $request->name;
        $usuario->email    = $request->email;
        $usuario->password = Hash::make($request->password);
        $usuario->tipo     = $request->tipo;
        $usuario->save();

        return json_encode(["valido" => [0 => "¡Usuario creado exitosamente!"]]);

    }


        // /**
        //  * Remove the specified resource from storage.
        // * 
        // * @param  \Illuminate\Http\Request  $request
        // * @param  int  $id
        // * @return \Illuminate\Http\Response
        // */
        // public function destroy($id, Request $request)
        // {   if(auth()->user()->id != $id){
        //         $usuario = user::find($id);
        //         $usuario->delete();
        //     }
        //     return redirect('/usuario');
        // }

        /**
         * Remove the specified resource from storage.
        * 
        * @param  \Illuminate\Http\Request  $request
        * @param  int  $id
        * @return \Illuminate\Http\Response
        */
        public function eliminarUsuario(Request $request)
        {   
            try {
                if(auth()->user()->id != $request->idUsuario){
                    $usuario = user::find($request->idUsuario);
                    $usuario->delete();
                }
    
                return json_encode(["valido" => [0 => "¡Usuario eliminado exitosamente!"]]);
    
            } catch (Exception $e) {
                return json_encode(["errores" => "¡Error inesperado!"]);
            }
        }


}
