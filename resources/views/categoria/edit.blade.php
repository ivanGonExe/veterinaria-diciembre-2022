@extends('layouts.plantillaBase2')
<link rel="stylesheet" type="text/css" href="{{asset('estiloArticulo.css')}}">
<style>
    .form-group{
        background-color: rgba(255, 52, 11) !important;
        margin: 0px;
        width:auto;
        height: auto;
        
    }
    .form-label{
       color:#ffffff;
    }
    </style>


@section('contenido')


<div class="form-group text-center">
    <h2 class="text-center text-light p-2 m-2 fs-1 fw-bold" >Editar categoría</h2>
   
    <div class="row container-fluid d-flex justify-content-center">


    <form action="/categorias/{{$categoria->id}}" method="POST" name="formulario" id="formulario">
        @csrf
		@method('Put')
   {{--      
        <div class="mb-3">
            <label for="" class="form-label">Descripcion</label>
            <input id="descripcion" name="descripcion" type="text" value ="{{$categoria->descripcion}}"class="form-control" tabindex="3">
        </div> --}}

<!--Grupo Descripcion -->
<div class="mb-3">
    <div class="formulario__grupo" id="grupo__descripcion">
    <label for="descripcion" class="formulario__label" title="Describa la categoría a crear" >Descripcion *</label>
    <div class="formulario__grupo-input">
    <input type="text" class="form-control formulario__input" id="descripcion" name="descripcion" value ="{{$categoria->descripcion}}" maxlength="25" required>
    <i class="formulario__validacion-estado fas fa-times-circle"></i>
</div>
<p class="text-white">*Campo obligatorio</p>
<p class="formulario__input-error">La descripcion puede contener letras y número hasta 25 caracteres</p>
</div>


        <a href="/categorias" class="btn btn-secondary" tabindex="6">Cancelar</a>
        
        <button type="submit" class="btn btn-primary" tabindex="7">Guardar</button>
    </form>
</div>


    



</body>
<script src="{{asset('validarCategoria.js')}}" defer></script>
@endsection  