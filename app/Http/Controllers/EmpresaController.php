<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

use App\Models\empresa;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{

 /**
     * Display a listing of the resource.
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
            'detalle_clinicos',
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

        return redirect("/copiadeseguridad");
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'descripcion'     => 'required| string',
            'direccion'       => 'required| string',
            'celular'         => 'required| string',
            'direccion'       => 'required| string',
            'instagram'       => 'nullable| string',
            'mapa '           => 'nullable| string',
            'telefonoFijo'    => 'required| string',  
        ]);
        $empresa= Empresa::all();

        $empresa[0]->descripcion = $request->descripcion;
        $empresa[0]->direccion   = $request->direccion;
        $empresa[0]->celular     = $request->celular;
        $empresa[0]->telefonoFijo   = $request->telefonoFijo;
        $empresa[0]->instagram   = $request->instagram;
        $empresa[0]->mapa        = $request->mapa;
        $empresa[0]->save();

        return redirect('/login/administrador'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function show(empresa $empresa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function edit(empresa $empresa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, empresa $empresa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function destroy(empresa $empresa)
    {
        //
    }
}
