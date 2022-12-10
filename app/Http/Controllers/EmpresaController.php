<?php

namespace App\Http\Controllers;

use App\Models\empresa;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{
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
    public function create()
    {
        //
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

        $empresa[0]->descripcion    = $request->descripcion;
        $empresa[0]->direccion      = $request->direccion;
        $empresa[0]->celular        = $request->celular;
        $empresa[0]->telefonoFijo   = $request->telefonoFijo;
        $empresa[0]->instagram      = $request->instagram;
        $empresa[0]->mapa           = $request->mapa;
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
