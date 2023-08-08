@extends('administrador.plantillaAdmin')
 

@section('contenido')
<body>  
  
    @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
    <link rel="stylesheet" type="text/css" href="{{asset('estiloControl.css')}}">

    <div class="main_content">
        <div class="content">
       
          <div class="header"><h2 class="text-dark fw-bold text-center">Editar Password</h2></div>    
         
          <div class="content text-center p-2">
            <div class="row">
                <div class="col-12 content-fluid d-flex justify-content-center p-2 "></div>
       
 
        <div class="form-group">
        
            <div class=" container-fluid d-flex justify-content-center">
    <div class= "container m-5 w-50">  

    <form action="/usuario/guardarPassword/{{$usuario->id}}" method="POST" id='formulario'>
        @csrf
        @method('Post')
        <div class=" mb-3 ">
            <label for="" class="formulario__label text-center">Email*</label>
            <input id="mail" name="mail" type="text" class="form-control" value="{{$usuario->email}}"  tabindex="3" disabled>
        </div>
        <div class="formulario__grupo mt-3" id="grupo__password">
            <label for="password" class="formulario__label text-center">Contraseña nueva</label>
            <div class="formulario__grupo-input">
                <input id="password" name="password" type="password" class="form-control"  tabindex="3">
                <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>
            <br>
            <p class="formulario__input-error">La contraseña debe contener como mínimo 8 caracteres, una letra, un dígito y una mayúscula.</p>      
        </div>
        
        <a href="/usuario" class="btn btn-secondary" tabindex="6">Cancelar</a>
        
        <button type="submit" class="btn btn-primary" tabindex="7">Guardar</button>
    </form>
</div>
</div>
</div>


<script src="{{asset('validarContraseña.js')}}" defer></script>
</body>

@endsection