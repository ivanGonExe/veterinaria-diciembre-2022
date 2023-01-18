<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class HomeController extends Controller
{
    public function index()
    {
      /*   $data = \App\Models\Post::all(); */
        $data = Post::all();
        return view('administrador.home',['data' => $data]);
    }
    public function create()
    {
        return view('administrador.create');
    }
    public function store(Request $request)
    {
       /*  $data           = new \App\Models\Post; */
        $data = new Post(); 
        $data->title    = $request->title;
        $data->slug     = \Str::slug(request('title'));
        $data->desc     = $request->desc;
        $data->save();

        return redirect('administrador.home');
    }
}
