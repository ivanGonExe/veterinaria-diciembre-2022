<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TurnoController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TelefonoController;
use App\Http\Controllers\MascotaController;
use App\Http\Controllers\HistorialClinicoController;
use App\Http\Controllers\DetalleClinicoController;
use App\Http\Controllers\VentaController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Rutas universales
    Route::get ('register',           [App\Http\Controllers\Auth\LoginController   ::class,'redirecion'  ]);
    Route::get ('/',                  [     App\Http\Controllers\EmpresaController ::class,'index'       ]);
    Route::post('/turnos/agregar',    [     App\Http\Controllers\TurnoController   ::class,'agregar'     ]);
    Route::post('turnos/mostrarTurno',[     App\Http\Controllers\TurnoController   ::class,'mostrarTurno']);
    Route::get ('/contacto',          [     App\Http\Controllers\ContactoController::class,'index'       ]);
    Route::get ('/seleccionTurno',    [     App\Http\Controllers\TurnoController   ::class,'indexTurno'  ]);

    /*Rutas login*/  
    Route::get ('/login',           [App\Http\Controllers\Auth\LoginController       ::class,'index'     ]);
    Route::get ('/vistaRoles',      [App\Http\Controllers\Auth\VerificationController::class,'vistaRoles']);
    Route::post('/registrado',      [     App\Http\Controllers\Usuario               ::class,'store'     ]);
    Route::get ('/registro/usuario',[     App\Http\Controllers\Usuario               ::class,'create'    ]);

//Rutas con control de usuarios
Route::group(['middleware' => 'auth'], function () {

    Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');

    Route::get('/appblade', function () {
            return view('layouts.app');
        });
    
    Route::get('logout',[App\Http\Controllers\Auth\LoginController ::class,'logout']);
    });  
    
    //Rutas de usuario cajero
    Route::group(['middleware' => 'UsuarioCajero'], function () {

            Route::get('/vistaRoles/cajero', function () {
                return view('empresa.cajero.cajero');
            });
            Route::resource('/ventas','App\Http\Controllers\VentaController');

        /*Rutas articulos */
            Route::post    ('/articulos/create',           [App\Http\Controllers\ArticuloController        ::class,'store'                ]);
            Route::post    ('categorias/all',              [App\Http\Controllers\CategoriaController       ::class,'all'                  ]);
            Route::post    ('articulos/filter',            [App\Http\Controllers\ArticuloController        ::class,'filter'               ]);
            Route::get     ('Lotes/{id}/Vencimientodelete',[App\Http\Controllers\loteDescripcionController ::class,'Vencimientodelete'    ]);
            Route::get     ('/Articulo/Por/Categoria/{id}', [App\Http\Controllers\ArticuloController        ::class,'ArticulosPorCategoria']);
            Route::resource('/articulos','App\Http\Controllers\ArticuloController');
        /*Rutas ventas*/
            Route::get     ("/precioEspecial/{id}",         [App\Http\Controllers\VentaController::class,'cambiarEstadoPrecio'  ]);
            Route::get     ("/agregarArticuloVenta/{id}",   [App\Http\Controllers\VentaController::class,'agregarArticuloVenta' ]);
            Route::get     ("/eleminarUnArticuloVenta/{id}",[App\Http\Controllers\VentaController::class,'quitarUnArticuloVenta']);
            Route::delete  ("/quitarArticuloDeVenta",       [App\Http\Controllers\VentaController::class,'quitarArticuloDeVenta'])->name('quitarArticulo');
            Route::get     ("/cancelarVenta",               [App\Http\Controllers\VentaController::class,'cancelarVenta'        ]);
            Route::get     ("/terminarVenta",               [App\Http\Controllers\VentaController::class,'terminarVenta'        ]);
            Route::get     ("/ventas/total/{id}",           [App\Http\Controllers\VentaController::class,'ventasTotal'          ])->name('ventasTotal');
            Route::get     ("/buscarProducto/{id}",         [App\Http\Controllers\VentaController::class,'buscarProducto'       ]);
            Route::post    ("/ventas/confirmarVenta/{id}",  [App\Http\Controllers\VentaController::class,'confirmarVenta'       ]);
            Route::post    ("/aplicarDescuento/{id}",       [App\Http\Controllers\VentaController::class,'aplicarDescuento'     ]);
            Route::resource('/ventas','App\Http\Controllers\VentaController');

        /*Rutas lote*/
            Route::get     ('/articulos/{id}/delete',[App\Http\Controllers\ArticuloController       ::class,'@destroy'        ]);
            Route::get     ('vencimientos',          [App\Http\Controllers\ArticuloController       ::class,'Vencimiento'     ])->name('vencimiento');
            Route::get     ('/Lotes/{id}/delete',    [App\Http\Controllers\loteDescripcionController::class,'destroy'         ]);
            Route::get     ('/Lotes/{id}/lote',      [App\Http\Controllers\loteDescripcionController::class,'lote_For_Article']);
            Route::get     ('/Lotes/{id}/create',    [App\Http\Controllers\loteDescripcionController::class,'crear_por_id'    ]);
            Route::post    ('/Lotes/{id}/store',     [App\Http\Controllers\loteDescripcionController::class,'store_por_id'    ]);
            Route::resource('/lotes','App\Http\Controllers\loteDescripcionController');

        /*Rutas historial de ventas */
            Route::get('historialVenta/index',[App\Http\Controllers\ventaController::class,'historialventas']);
        /*Rutas de categoria */
            Route::get     ('/quitarUnaCategoria/{id}',[App\Http\Controllers\categoriaController::class,'destroy']);
            Route::resource('/categorias','App\Http\Controllers\categoriaController');
        /* ruta de notificacion */
            Route::get     ('/notificacion/{id}/delete',[App\Http\Controllers\notificacionesController::class,'destroy']);
            Route::resource('/notificaciones','App\Http\Controllers\notificacionesController'); 
        /* rutas de estadísticas */
            Route::get('/estadistica/ganancia/por_mes/{id}',     [App\Http\Controllers\VentaController::class,'gananciaPorMes'      ]);
            Route::get('/estadistica/articulos/MasVendidos/{id}',[App\Http\Controllers\VentaController::class,'articulosMasVendidos']);
    });


//-------------------------------------------------------------------------------------------------------
    Route::group(['middleware' => 'Usuario_Vet_pel'], function () {
        /*Rutas mascotas*/
            Route::get     ('/mascotas/verMascotasDeshabitadas',[App\Http\Controllers\MascotaController::class,'verBajaMascota'] );
            route::get     ('/mascotas/{id}/delete',            [App\Http\Controllers\MascotaController::class,'destroy'       ] );
            Route::get     ('/mascotas/verMascota/{id}',        [App\Http\Controllers\MascotaController::class,'verMascota'    ] )->name('verMascotas'); 
            Route::get     ('/mascotas/habilitar/{id}',         [App\Http\Controllers\MascotaController::class,'habitarMascota'] );
            Route::get     ('/mascotas/create/{id}',            [App\Http\Controllers\MascotaController::class,'create'        ] )->name('crearMascota');
            Route::resource('/mascotas','App\Http\Controllers\MascotaController');
            /*Rutas turno peluquero y veterinario*/
            Route::post('/mascotas/create/{id}',     [App\Http\Controllers\TurnoController::class,'storeUnTurno'      ] );
            Route::post('/turnos/superpuesto',       [App\Http\Controllers\TurnoController::class,'turnoSuperpuesto'  ] );
            Route::post('/turnos/unTurnoSuperpuesto',[App\Http\Controllers\TurnoController::class,'unTurnoSuperpuesto'] );
            Route::get ('/turnos/createUnTurno',     [App\Http\Controllers\TurnoController::class,'crearUnTurno'      ] ); 
            Route::post('/turnos/darTurno/{id}',     [App\Http\Controllers\TurnoController::class,'DarTurno'          ] );
            Route::post('/unTurno',                  [App\Http\Controllers\TurnoController::class,'storeUnTurno'      ] );
               
            /*Rutas personas*/
            Route::get     ('/personas/{id}/delete',      [App\Http\Controllers\PersonaController   ::class,'destroy'         ] );
            Route::get     ('/personas/estado/{id}',      [App\Http\Controllers\PersonaController   ::class,'personasEstado'  ] );
            Route::get     ('/personas/{id}/habilitar',   [App\Http\Controllers\PersonaController   ::class,'habilitarCliente'] );
            Route::get     ('/turnos/mostrar',            [App\Http\Controllers\TurnoController     ::class,'show'            ] );
            Route::get     ('turnos/cancelar/{id}',       [App\Http\Controllers\TurnoController     ::class,'cancelar'        ] )->name('cancelarTurno');  
            Route::get     ('/tipoTurno/{id}',            [App\Http\Controllers\TurnoController     ::class,'tipoTurno'       ] );
            Route::get     ('/turnos/{id}/delete',        [App\Http\Controllers\TurnoController     ::class,'destroy'         ] );
            Route::get     ('/turnos/mensaje/{id}',       [App\Http\Controllers\TurnoController     ::class,'mensaje'         ] );
            Route::get     ('/telefonos/{id}/delete',     [App\Http\Controllers\TelefonoController  ::class,'destroy'         ] );
            Route::post    ('telefono/ver',               [App\Http\Controllers\TelefonoController  ::class,'ver'             ] );
            Route::get     ('telefonos/create/{id}',      [App\Http\Controllers\TelefonoController  ::class, 'create'         ] )->name('creartelefono');
            //Ruta de estadística
            Route::get('/estadistica/clientesNuevosPorMes/{id}',[App\Http\Controllers\PersonaController::class,'clientesNuevosPorMes'] );
            Route::resource('/personas','App\Http\Controllers\PersonaController');
            Route::resource('/turnos','App\Http\Controllers\TurnoController');
            Route::resource('/telefonos','App\Http\Controllers\TelefonoController');
        });
//-------------------------------------------------------------------------------------------------------
    Route::group(['middleware' => 'UsuarioVeterinario'], function () {
            Route::get('/vistaRoles/veterinario', function () {
                return view('empresa.veterinario.veterinario');
            });
            Route::get('DetallesClinicos/create/{id}',[App\Http\Controllers\DetalleClinicoController::class, 'create'] )->name('crearDetalleClinico');
            Route::resource('/historialesClinicos','App\Http\Controllers\HistorialClinicoController');
            Route::resource('/detallesClinicos','App\Http\Controllers\DetalleClinicoController');
    });
//-------------------------------------------------------------------------------------------------------
    Route::group(['middleware' => 'UsuarioPeluquero'], function () {

            Route::get('/vistaRoles/peluquero', function () {
                return view('empresa.peluquero.peluquero');
            });
    });
    
    Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
            return view('dashboard');
    })->name('dashboard');


Route::group(['middleware' => 'UsuarioAdministrador'], function () {
  
        Route::get('/login/administrador', function () {
            return view('administrador.administrador');
        });
        Route::get('/login/administrador/vistas', function () {
            return view('administrador.vistas');
        });
        Route::get ('/infoEmpresa',              [App\Http\Controllers\EmpresaController::class,'indexEmpresa'] );
        Route::post('/storeEmpresa',             [App\Http\Controllers\EmpresaController::class,'store'       ] );
        Route::get ('/usuario',                  [App\Http\Controllers\Usuario          ::class,'index'       ] );
        Route::get ('/usuario/{id}/delete',      [App\Http\Controllers\Usuario          ::class,'destroy'     ] );
        Route::get ('/usuario/{id}/edit',        [App\Http\Controllers\Usuario          ::class,'edit'        ] );
        Route::get ('/usuario/{id}/editPassword',[App\Http\Controllers\Usuario          ::class,'editPassword'] );
        Route::post('/storeEmpresa','App\Http\Controllers\EmpresaController@store');
        Route::post('/usuario/guardarPassword/{id}','App\Http\Controllers\Usuario@updatePassword');
        Route::post('/usuario/guardar/{id}','App\Http\Controllers\Usuario@update');
        Route::get ('/usuario/Admin/ingresoAOtro/{id}','App\Http\Controllers\Usuario@CambioEstadoInicio');
    /* posteo ckeditor */
    //noticias 
        Route::post('/guardarNoticia',         [App\Http\Controllers\HomeController::class, 'store'  ] )->name('store');
        Route::post('/actualizarNoticia/{id}', [App\Http\Controllers\HomeController::class, 'update' ] )->name('update');
        Route::get ('/entradaNoticia',         [App\Http\Controllers\HomeController::class, 'index'  ] );
        Route::get ('/create',                 [App\Http\Controllers\HomeController::class, 'create' ] )->name('create');
        Route::get ('/eliminarNoticia/{id}',   [App\Http\Controllers\HomeController::class, 'destroy'] );
        Route::get ('/editarNoticia/{id}',     [App\Http\Controllers\HomeController::class, 'edit'   ] );

        Route::get('/estadisticas', function () {
            return view('estadistica.estadisticas');
    });
    
    Route::get('/estadistica/ganancia/por_mes/{id}','App\Http\Controllers\VentaController@gananciaPorMes');
    Route::get('/estadistica/articulos/MasVendidos/{id}','App\Http\Controllers\VentaController@articulosMasVendidos');
    Route::get('/estadistica/clientesNuevosPorMes/{id}','App\Http\Controllers\PersonaController@clientesNuevosPorMes');
    Route::get('/Estadistica/ventas/{id}',[App\Http\Controllers\VentaController::class, 'estadisticaVentas'] );
    
    });
    Route::get('/noticias', [App\Http\Controllers\HomeController::class, 'posteos']);
    Route::get('/noticias/posteo/{id}', [App\Http\Controllers\HomeController::class, 'unPosteo']);
//estan dentro de los que estan registrados
    Auth::routes();
    
//Estadisticas




