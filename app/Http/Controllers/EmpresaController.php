<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

use App\Models\empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;

class EmpresaController extends Controller
{

 /**
     * Visualización de listado de backups.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexBackup()
    {
        // Obtener la lista de archivos JSON en el directorio "storage"
        $archivo=Storage::disk('local')->allFiles();
        
        // Filtrar solo los archivos JSON
        $archivos = array_filter($archivo, function ($file) {
            return pathinfo($file, PATHINFO_EXTENSION) === 'json';
        });
        return view('administrador.backup')->with('archivos', $archivos);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empresa= Empresa::all();
      return view('index')->with('empresa', $empresa);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexEmpresa()
    {
        $empresa= Empresa::all();
      return view('administrador.infoEmpresa')->with('empresa', $empresa);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createBackup()
    {   
        $fileName = 'backup_Veterinaria_' . Carbon::now()->format('Y-m-d_H-i-s').'.json';

        $tables = [
            'users',
            'password_resets',
            'failed_jobs',
            'personal_access_tokens',
            'categorias',
            'articulos',
            'personas',
            'mascotas', 
            'migrations',
            'telefonos',
            'turnos',
            'historial_clinicos',
            'historial_servicios',
            'detalle_clinicos',
            'detalle_servicios',
            'lote_descripcions',
            'ventas',
            'detalle_ventas',
            'notificaciones',
            'empresas', 
            'noticias', 
            'posts' ]; // Agrega aquí los nombres de las tablas que deseas respaldar
                    
       
        $data = [];


        foreach ($tables as $table) {
            $query = DB::table($table)->get();
            $data[$table] = $query;
            
        }
      
        

        $jsonData = json_encode($data);
        
        Storage::disk('local')->put($fileName, $jsonData);

        $jsonData = Storage::get($fileName);

        if($jsonData != null){
            return json_encode(["valido" => [ 0 => "¡Copia de seguridad creada exitosamente!"]]);
        }
        else{
            return json_encode(["errores" => "¡Error inesperado!"]);
        }

    }
    
    
    /**
     * Show the form for creating a new resource.
     * @param  string $nombreArchivo
     * @return \Illuminate\Http\Response
     */
    public function upBackup($nombreArchivo)
    {
    // Obtener el contenido del archivo JSON
    
     $jsonData = Storage::get($nombreArchivo);


    //  DB::beginTransaction();

    //   try {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');   //desahabilitar la clase foraneas 

            $tables = DB::select('SHOW TABLES');
            
            foreach ($tables as $table) 
            {
                $tableName = $table->{'Tables_in_' . env('DB_DATABASE')};
                DB::table($tableName)->truncate();
            }
            
            $data = json_decode($jsonData, true);

            foreach ($tables as $table) 
            {
                $tableName = $table->{'Tables_in_' . env('DB_DATABASE')};
                DB::table($tableName)->insert($data[$tableName]);
            }
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            
            DB::commit(); // Confirmar la transacción
           
           
            return redirect("/copiadeseguridad");
            // return response(json_encode($mensaje),200)->header('Content-type','text/plain');

    //   } catch (\Exception $e)
    //   {
    //         DB::rollBack(); // Deshacer la transacción en caso de error
    //         $mensaje="false";
    //           dump($mensaje);
    //          return redirect("/copiadeseguridad");
    //        //  return response(json_encode($mensaje),200)->header('Content-type','text/plain');
    //  }

   
    }

    /**
     * Chequeo, validación y almacenamiento de empresa editada.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function editarInformacionEmpresa(Request $request)
    {  
        $validator = Validator::make($request->all(), 
            [
                'descripcion'     => 'required| string',
                'direccion'       => 'required| string',
                'celular'         => 'required| string',
                'instagram'       => 'nullable| string',
                'mapa '           => 'nullable| string',
                'telefonoFijo'    => 'required| string',
            ], $messages = [
                
            ],
            [
                'descripcion' => 'descripción',
                'direccion' => 'dirección',
                'telefonoFijo' => 'teléfono fijo'
            ]
        );
 
        if ($validator->fails()) {
            $errores = $validator->errors()->all();
            return json_encode(["errores" => $errores]);
        }
        
        try {
            $empresa= Empresa::all();

            $empresa[0]->descripcion = $request->descripcion;
            $empresa[0]->direccion   = $request->direccion;
            $empresa[0]->celular     = $request->celular;
            $empresa[0]->telefonoFijo   = $request->telefonoFijo;
            $empresa[0]->instagram   = $request->instagram;
            $empresa[0]->mapa        = $request->mapa;
            $empresa[0]->save();

            return json_encode(["valido" => [ 0 => "¡Información editada exitosamente!"]]);

        } catch (Exception $e) {
            return json_encode(["errores" => "¡Error inesperado!"]);
        }
        
    }

}
