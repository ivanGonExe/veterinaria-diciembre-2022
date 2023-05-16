<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\Articulo;
use App\Models\Categoria;
use App\Models\DetalleClinico;
use App\Models\DetalleVenta;
use App\Models\Empresa;
use App\Models\HistorialClinico;
use App\Models\LoteDescripcion;


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
     * Creacion de copia seguridad.
     * @param  \App\Models\loteDescripcion  $loteDescripcion
     * @return \Illuminate\Http\Response
     */
    public function createBackup()
    {
    // crear backup a pata de mysql
    
        //creacion script sql para articulos
        $articulos      = Articulo::all();
        if($articulos){
            $i              = 0;
            $cantArticulo   = count($articulos);
            $tablaArticulo  = "INSERT INTO articulos ";
            $tablaArticulo .= "(id, created_at, updated_at, codigo, descripcion, precioVenta, cantidadTotal, minimoStock, iva, alerta, estado, categoria_id, porcentGanancia) "."\n";
            $tablaArticulo .= "VALUES ";
            foreach ($articulos as $unArticulo){
                $i++;
                $tablaArticulo .="(";
                $tablaArticulo .=      $unArticulo->id.                                ",";
                $tablaArticulo .= "'". $unArticulo->created_at.                    "'".",";
                $tablaArticulo .= "'". $unArticulo->updated_at.                    "'".",";
                $tablaArticulo .=      $unArticulo->codigo.                            ",";
                $tablaArticulo .= "'". $unArticulo->descripcion.                   "'".",";
                $tablaArticulo .=      str_replace($unArticulo->precioVenta,',','.').  ",";
                $tablaArticulo .=      str_replace($unArticulo->cantidadTotal,',','.').",";
                $tablaArticulo .=      $unArticulo->minimoStock.                       ",";
                $tablaArticulo .=      $unArticulo->iva.                               ",";
                $tablaArticulo .=      $unArticulo->alerta.                            ",";
                $tablaArticulo .=      $unArticulo->categoria_id.                      ",";
                $tablaArticulo .=      str_replace($unArticulo->porcentGanancia,',','.')  ;
                if($i==$cantArticulo){
                    $tablaArticulo .= ");"."\n";
                } else{
                    $tablaArticulo .= "), "."\n";
                }
            }
        }
        dump($tablaArticulo);
        // ------------------------------------------------------------------------------------------------
        //creacion script sql para categoria de articulo
        $categorias      = Categoria::all();
        if($categorias){
            $j               = 0;
            $cantCategoria   = count($categorias);
            $tablaCategoria  = "INSERT INTO categorias";
            $tablaCategoria .= "(id, created_at, updated_at, descripcion)"."\n";
            $tablaCategoria .= "VALUES ";
            foreach ($categorias as $unaCategoria){
                $j++;
                $tablaCategoria .="(";
                $tablaCategoria .=      $unaCategoria->id.              ",";
                $tablaCategoria .= "'". $unaCategoria->created_at.  "'".",";
                $tablaCategoria .= "'". $unaCategoria->updated_at.  "'".",";
                $tablaCategoria .= "'". $unaCategoria->descripcion. "'";
                if($j==$cantCategoria){
                    $tablaCategoria .= ");"."\n";
                } else{
                    $tablaCategoria .= "), "."\n";
                }
            }
        }
        dump($tablaCategoria);
    // ------------------------------------------------------------------------------------------------
    //creacion script sql para detalles clinicos
        $detalleClinicos = DetalleClinico::all();
        if($detalleClinicos){
            $i                    = 0;
            $cantDetalleclinico   = count($detalleClinicos);
            $tablaDetalleClinico  = "INSERT INTO detalle_clinicos";
            $tablaDetalleClinico .= "(id, created_at, updated_at, observaciones, fechaAtencion, tratamiento, patologia, peso, historialClinico_id) "."\n";
            $tablaDetalleClinico .= "VALUES ";
            foreach ($detalleClinicos as $unDetalleClinico){
                $i++;
                $tablaDetalleClinico .="(";
                $tablaDetalleClinico .=      $unDetalleClinico->id.                        ",";
                $tablaDetalleClinico .= "'". $unDetalleClinico->created_at.            "'".",";
                $tablaDetalleClinico .= "'". $unDetalleClinico->updated_at.            "'".",";
                $tablaDetalleClinico .= "'". $unDetalleClinico->observaciones.         "'".",";
                $tablaDetalleClinico .= "'". $unDetalleClinico->fechaAtencion.         "'".",";
                $tablaDetalleClinico .= "'". $unDetalleClinico->tratamiento.           "'".",";
                $tablaDetalleClinico .= "'". $unDetalleClinico->patologia.             "'".",";
                $tablaDetalleClinico .       str_replace($unDetalleClinico->peso,',','.'). ",";
                $tablaDetalleClinico .=      $unDetalleClinico->historialClinico_id    ;
                if($i==$cantDetalleclinico){
                    $tablaDetalleClinico .= ");"."\n";
                } else{
                    $tablaDetalleClinico .= "), "."\n";
                }
            }
        }
        dump($tablaDetalleClinico);
        // ------------------------------------------------------------------------------------------------
        //creacion script sql para detalle venta
        $detalleVenta = DetalleVenta::all();
        if($detalleVenta){
            $i                  = 0;
            $cantDetalleVenta   = count($detalleVenta);
            $tablaDetalleVenta  = "INSERT INTO detalle_ventas ";
            $tablaDetalleVenta .= "(id, cantidad, subtotal, descuento, created_at, updated_at, idVenta, idLote) "."\n";
            $tablaDetalleVenta .= "VALUES ";
            foreach ($detalleVenta as $undetalleVenta){
                $i++;
                $tablaDetalleVenta .="(";
                $tablaDetalleVenta .=      $undetalleVenta->id.             ",";
                $tablaDetalleVenta .=      $undetalleVenta->cantidad.       ",";
                $tablaDetalleVenta .=      $undetalleVenta->subtotal.       ",";
                $tablaDetalleVenta .=      $undetalleVenta->descuento.      ",";
                $tablaDetalleVenta .= "'". $undetalleVenta->created_at. "'".",";
                $tablaDetalleVenta .= "'". $undetalleVenta->updated_at. "'".",";
                $tablaDetalleVenta .=      $undetalleVenta->idVenta.        ",";
                $tablaDetalleVenta .=      $undetalleVenta->idLote             ;
                if($i==$cantDetalleVenta){
                    $tablaDetalleVenta .= ");"."\n";
                } else{
                    $tablaDetalleVenta .= "), "."\n";
                }
            }
        }
        dump($tablaDetalleVenta);
        // ------------------------------------------------------------------------------------------------
        //creacion script sql para tabla empresa
        $empresa = Empresa::all();
        if($empresa){
            $i              = 0;
            $cant           = count($empresa);
            $tablaEmpresa  = "INSERT INTO empresas ";
            $tablaEmpresa .= "(id, descripcion, instagram, telefonoFijo, celular, direccion, mapa, created_at, updated_at) "."\n";
            $tablaEmpresa .= "VALUES ";
            foreach ($empresa as $unaEmpresa){
                $i++;
                $tablaEmpresa .="(";
                $tablaEmpresa .=      $unaEmpresa->id.              ",";
                $tablaEmpresa .= "'". $unaEmpresa->descripcion. "'".",";
                $tablaEmpresa .= "'". $unaEmpresa->instagram.   "'".",";
                $tablaEmpresa .= "'". $unaEmpresa->telefonoFijo."'".",";
                $tablaEmpresa .= "'". $unaEmpresa->celular.     "'".",";
                $tablaEmpresa .= "'". $unaEmpresa->direccion.   "'".",";
                $tablaEmpresa .= "'". $unaEmpresa->mapa.        "'".",";
                $tablaEmpresa .= "'". $unaEmpresa->created_at.  "'".",";
                $tablaEmpresa .= "'". $unaEmpresa->updated_at.   "'";
                if($i==$cant){
                    $tablaEmpresa .= ");"."\n";
                } else{
                    $tablaEmpresa .= "), "."\n";
                }
            }
        }
        dump($tablaEmpresa);
        // ------------------------------------------------------------------------------------------------
        //creacion script sql para historial clinico
        $historialClinico = HistorialClinico::all();
        if($historialClinico){
            $i                      = 0;
            $cantHistorialClinico   = count($historialClinico);
            $tablaHistorialClinico  = "INSERT INTO historial_clinicos";
            $tablaHistorialClinico .= "(id, created_at, updated_at, mascota_id) "."\n";
            $tablaHistorialClinico .= "VALUES ";
            foreach ($historialClinico as $unHistorialClinico){
                $i++;
                $tablaHistorialClinico .="(";
                $tablaHistorialClinico .=      $unHistorialClinico->id.             ",";
                $tablaHistorialClinico .= "'". $unHistorialClinico->created_at. "'".",";
                $tablaHistorialClinico .= "'". $unHistorialClinico->updated_at. "'".",";
                $tablaHistorialClinico .=      $unHistorialClinico->mascota_id         ;
                if($i==$cantHistorialClinico ){
                    $tablaHistorialClinico .= ");"."\n";
                } else{
                    $tablaHistorialClinico .= "), "."\n";
                }
            }
        }
        dump($tablaHistorialClinico);
        // ------------------------------------------------------------------------------------------------
        //creacion script sql para lote_descripcions
        $lotes = LoteDescripcion::all();
        if($lotes){
            $i           = 0;
            $cantlote    = count($lotes);
            $tablaLotes  = "INSERT INTO lote_descripcions";
            $tablaLotes .= "(id, created_at, updated_at, unidad, precioCompra, vencimiento, estado, articulo_id) "."\n";
            $tablaLotes .= "VALUES ";
            foreach ($lotes as $unLote){
                $i++;
                $tablaLotes .="(";
                $tablaLotes .=      $unLote->id.              ",";
                $tablaLotes .= "'". $unLote->created_at.  "'".",";
                $tablaLotes .= "'". $unLote->updated_at.  "'".",";
                $tablaLotes .=      $unLote->unidad.          ",";
                $tablaLotes .=      $unLote->precioCompra.    ",";
                $tablaLotes .= "'". $unLote->vencimiento. "'".",";
                $tablaLotes .=      $unLote->estado.          ",";
                $tablaLotes .=      $unLote->articulo_id         ;
                if($i==$cantlote ){
                    $tablaLotes .= ");"."\n";
                } else{
                    $tablaLotes .= "), "."\n";
                }
            }
        }
        dump($tablaLotes);
        $mascotas = Mascotas::all();
        $data = json_decode($jsonString, true); 

        dd($data);
        DB::table('users')->insert($data);

    }

    /**
     * Update the specified resource in storage.
     * @param $id
     * @param  \Illuminate\Http\Request  $request
     
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   $request->validate([
        'nombre'   => 'required| string |max:255 ',
        'mail'     => 'required| string |email |max:255 ',
        'tipo'     => 'required| string',
     ]);

        $usuario = user::find($id);
        $usuario->name   = $request->nombre;
        $usuario->email  = $request->mail;
        $usuario->tipo   = $request->tipo;
        $usuario->save();
        return redirect('/usuario');
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
        //if(auth()->user()->tipo == 'admin'){
        //    return view('auth.registro');
       // }
        // else{
        //     return redirect('/login');
        // }
    }

 /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // if(auth()->user()->tipo != 'admin'){
        //     return redirect('/login');
        // }

        $request->validate([
             'name'     => 'required| string | max:255',
             'email'    => 'required| string |email |max:255 |unique:users',
             'password' => 'required| string|min:8|confirmed',
             'tipo'     => 'required| string',
        ]);

        $usuario = User::Where('email',$request->email)->get();

        if($usuario->isEmpty()){
        
            $usuario = new User();
            $usuario->name     = $request->name;
            $usuario->email    = $request->email;
            $usuario->password = Hash::make($request->password);
            $usuario->tipo     = $request->tipo;
            $usuario->save();
        return redirect('/usuario');

        }
        else{
            
        Session::flash('message','El usuario ingresado ya se encuentra registrado');
        return redirect('/registro/usuario');
        }
    }


        /**
         * Remove the specified resource from storage.
        * 
        * @param  \Illuminate\Http\Request  $request
        * @param  int  $id
        * @return \Illuminate\Http\Response
        */
        public function destroy($id, Request $request)
        {   if(auth()->user()->id != $id){
                $usuario = user::find($id);
                $usuario->delete();
            }
            return redirect('/usuario');
        }


}
