<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Str;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
    
        $data = Post::all();
       
        return view('administrador.posteo.home',['data' => $data]);
    }
    public function create()
    {


        return view('administrador.posteo.create');



    }
    public function store(Request $request)
    {  
        $request->validate([
            'titulo'   => 'required| string ',
            'asunto'   => 'required| string ',
        
        ]); 
        
        $data = new Post(); 
        $data->titulo = $request->titulo;
        $data->asunto = $request->asunto;
        $data->fecha = Carbon::now()->format('Y-m-d H:i:s');
        $data->save();

        return redirect('/entradaNoticia');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dato = Post::find($id);
        $dato->delete(); 
        return redirect('/entradaNoticia');
    }

  /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dato = Post::find($id);
 
     
    return view('administrador.posteo.edit')->with ('dato',$dato);
                                
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
            'titulo'   => 'required| string ',
            'asunto'   => 'required| string ',
        
        ]); 
        
    $dato = Post::find($id);  
    $dato->titulo = $request->titulo;
    $dato->asunto = $request->asunto;
    $dato->fecha = Carbon::now()->format('Y-m-d H:i:s');
    $dato->save(); 

    return redirect('/entradaNoticia');  
    }


    
}
