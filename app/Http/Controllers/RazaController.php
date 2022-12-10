<?php

namespace App\Http\Controllers;

use App\Models\raza;
use Illuminate\Http\Request;

class RazaController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\raza  $raza
     * @return \Illuminate\Http\Response
     */
    public function show(raza $raza)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\raza  $raza
     * @return \Illuminate\Http\Response
     */
    public function edit(raza $raza)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\raza  $raza
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, raza $raza)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\raza  $raza
     * @return \Illuminate\Http\Response
     */
    public function destroy(raza $raza)
    {
        //
    }
    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function ver(Request $request)
    {  
        $raza = raza::where('especie_id',$request->id)->get();
        return response(json_encode($raza),200)->header('content-type','text/plain');
    }
}
