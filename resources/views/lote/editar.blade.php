@extends('layouts.plantillaBase2')
 
<link rel="stylesheet" type="text/css" href="{{asset('estiloArticulo.css')}}">
@section('contenido')
<body>

    <div class="form-group   text-center">
        <h2 class="text-center text-light p-2 m-2 fs-1 fw-bold" >Editar Lote</h2>
      
       <div class="row container-fluid d-flex justify-content-center">
  
   


    <form action="{{route('lotes.update',$lote->id )}}" method="POST" id="formulario" name="formulario">
        @csrf
        @method('Put')
        <p class="text-info">*Esta pregunta es obligatoria</p>
        <!--Precio de compra -->
   <div class="mb-3">
    <div class="formulario__grupo" id="grupo__precioCompra" title="Valor númerico único que se va identificar el producto">
  <label for="precioCompra" class="formulario__label">Precio de Compra*</label>
  <div class="formulario__grupo-input px-2">
   
    <input id="precioCompra" name="precioCompra" type="number" class="form-control formulario__input" value ='{{$lote->precioCompra}}' maxlength="8" required>

    <i class="formulario__validacion-estado fas fa-times-circle"></i>
        </div>

        <p class="formulario__input-error">Unidades, solo puede contener valores númericos</p>
    </div>
   <br>
    <!--Unidades-->
   <div class="mb-3">
    <div class="formulario__grupo" id="grupo__unidades" title="Valor númerico único que se va identificar el producto">
  <label for="unidades" class="formulario__label">Cantidad de Unidades*</label>
  <div class="formulario__grupo-input px-2">
   
    <input id="unidades" name="unidades" type="number" class="form-control formulario__input" value ='{{$lote->unidad}}' maxlength="8"  required>

    <i class="formulario__validacion-estado fas fa-times-circle"></i>
        </div>

        <p class="formulario__input-error">Unidades, solo puede contener valores númericos</p>
    </div>
      </div>
      
{{-- 

        <div class="mb-3">
            <label for="" class="form-label">Unidades</label>
            <input id="unidades" name="unidades" type="text" class="form-control" value ='{{$lote->unidad}}' tabindex="3">
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Precio Compra($)</label>
            <input id="precioCompra" name="precioCompra" type="text" class="form-control" value ='{{$lote->precioCompra}}'tabindex="2">
        </div> --}}
        
        <div class="mb-3">
            <div class="formulario__grupo" id="grupo__unidades">
                <label for="unidades" class="formulario__label">Vencimiento*</label>
            <input id="vencimiento" name="vencimiento" type="date" class="form-control formulario__label" value ='{{$lote->vencimiento}}' tabindex="5">
        </div>
<br>
        <a href="/Lotes/{{$lote->articulo_id}}/lote" class="btn btn-secondary" tabindex="6">Cancelar</a>
        
        <button type="submit" class="btn btn-primary" tabindex="7">Guardar</button>
    </form>
</div>



</body>
<script src="{{asset('validarLote.js')}}" defer></script>
@endsection