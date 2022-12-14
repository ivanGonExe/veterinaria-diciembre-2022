@extends('layouts.plantillaBase2')
 
<link rel="stylesheet" type="text/css" href="{{asset('estiloArticulo.css')}}">
@section('contenido')
<div class="form-group   text-center">
    <h2 class="text-center text-light p-2 m-2 fs-1 fw-bold" >Nuevo Lote</h2>
  
   <div class="row container-fluid d-flex justify-content-center">


    <form action="/Lotes/{{$ArticuloId}}/store" method="POST" id="formulario" name="formulario" >
        @csrf
        @method('Post')
     {{--    <div class="mb-3">
            <label for="" class="form-label">Cantidad de Unidades</label>
            <input id="unidades" name="unidades" type="number" class="form-control" tabindex="3">
        </div> --}}


 <!--Precio de compra -->
   <div class="mb-3">
    <div class="formulario__grupo" id="grupo__precioCompra" title="Valor númerico único que se va identificar el producto">
  <label for="precioCompra" class="formulario__label">Precio de Compra*</label>
  <div class="formulario__grupo-input px-2">
   
    <input id="precioCompra" name="precioCompra" type="number" class="form-control formulario__input" maxlength="8" required>

    <i class="formulario__validacion-estado fas fa-times-circle"></i>
        </div>
<p class="text-white">*Esta pregunta es obligatoria</p>
        <p class="formulario__input-error">Unidades, solo puede contener valores númericos</p>
    </div>

    <!--Unidades-->
   <div class="mb-3">
    <div class="formulario__grupo" id="grupo__unidades" title="Valor númerico único que se va identificar el producto">
  <label for="unidades" class="formulario__label">Cantidad de Unidades*</label>
  <div class="formulario__grupo-input px-2">
   
    <input id="unidades" name="unidades" type="number" class="form-control formulario__input" maxlength="8" required>

    <i class="formulario__validacion-estado fas fa-times-circle"></i>
        </div>
<p class="text-white">*Esta pregunta es obligatoria</p>
        <p class="formulario__input-error">Unidades, solo puede contener valores númericos</p>
    </div>
      </div>

{{-- 
        <div class="mb-3">
            <label for="" class="form-label">Precio Compra (unidad)</label>
            <input id="precioCompra" name="precioCompra" type="number" class="form-control" tabindex="2">
        </div>
        --}}

    <!--Unidades-->
    <div class="mb-3">
        <div class="formulario__grupo" id="grupo__vencimiento" title="Valor númerico único que se va identificar el producto">
      <label for="vencimiento" class="formulario__label">Cantidad de vencimiento*</label>
      <div class="formulario__grupo-input px-2">
       
        <input id="vencimiento" name="vencimiento" type="date" class="form-control formulario__input" maxlength="8" required>
    
        <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>
    <p class="text-white">*Esta pregunta es obligatoria</p>
            <p class="formulario__input-error">Unidades, solo puede contener valores númericos</p>
        </div>
          </div>
          

     {{--    <div class="mb-3">
            <label for="" class="form-label">Vencimiento</label>
            <input id="vencimiento" name="vencimiento" type="date" class="form-control" tabindex="5">
        </div> --}}

        
        <a href="/Lotes/{{$ArticuloId}}/lote" class="btn btn-secondary" tabindex="6">Cancelar</a>
        
        <button type="submit" class="btn btn-primary" tabindex="7">Guardar</button>
    </form>
</div>


</body>
<script src="{{asset('validarLote.js')}}" defer></script>

@endsection