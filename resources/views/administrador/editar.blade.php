@extends('administrador.plantillaAdmin')

@section('contenido')
<link rel="stylesheet" type="text/css" href="{{asset('estiloControl.css')}}">
<style>
    p{
        font-size: 13px !important;
        margin-bottom: 10px !important;
    }
</style>
<body>
    <div class="main_content">
        <div class="content">
       
          <div class="header"><h2 class="text-dark fw-bold text-center">Editar Usuario</h2></div>    
         
          <div class="content text-center p-2">
            <div class="row">
                <div class="col-12 content-fluid d-flex justify-content-center p-2 "></div>
       
 
        <div class="form-group">
        
            <div class=" container-fluid d-flex justify-content-center">
    <div class= "container w-50 m-5">  
   
    <form method="POST" id="formulario">
        @csrf
        @method('Post')
        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
        <input type="hidden" name="idUsuario" id="idUsuario" value="{{ $usuario->id }}">
        <h5 class="text-white">*Campo obligatorio</h5>
        <!--Grupo Nombre -->
        <div class="formulario__grupo mt-3" id="grupo__nombre">
            <label for="nombre" class="formulario__label">Nombre *</label>
            <div class="formulario__grupo-input">
                <input id="nombre" name="nombre" type="text" class="form-control formulario__input" value="{{$usuario->name}}"  tabindex="3" required>
                <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>
            <p class="formulario__input-error">El Nombre tiene que ser de 2 a 25 caracteres y solo puede contener letras.</p>      
        </div>

        <div class="formulario__grupo mt-3" id="grupo__mail">
            <label for="mail" class="formulario__label">Email *</label>
            <div class="formulario__grupo-input">
                <input id="mail" name="mail" type="text" class="form-control formulario__input" value="{{$usuario->email}}"  tabindex="3" required>
                <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>
            <p class="formulario__input-error">El email no es válido.</p>      
        </div>
        
        <label for="tipo" class=" formulario__label text-md-right">Rol*</label>
            
                            <div >
                                <select class='form-control selecTipo'  id ='tipo' name= 'tipo'>
                                @if($usuario->tipo == 'admin' )
                                    <option class='form-option' value ='admin' selected>Administrador</option>
                                @else
                                    <option class='form-option' value ='admin'>Administrador</option>
                                @endif
                                @if($usuario->tipo == 'veterinario' )
                                    <option class='form-option' value ='veterinario'selected>Veterinario</option>
                                @else
                                    <option class='form-option' value ='veterinario'>Veterinario</option>
                                @endif
                                @if($usuario->tipo == 'peluquero' )
                                    <option class='form-option' value ='peluquero' selected>Peluquero</option>
                                @else
                                    <option class='form-option' value ='peluquero'>Peluquero</option>
                                @endif
                                @if($usuario->tipo == 'cajero' )
                                    <option class='form-option' value ='cajero' selected>Cajero</option>
                                @else
                                    <option class='form-option' value ='cajero'>Cajero</option>
                                @endif
                                </select>
                                
                            <div>
                                <br>

        <a href="/usuario" class="btn btn-secondary" tabindex="6">Cancelar</a>
        
        <button type="submit" class="btn btn-primary" tabindex="7">Guardar</button>
    </form>
</div>
</div>
</div>

<script src="{{asset('validarUsuario.js')}}" defer></script>

</body>

@endsection