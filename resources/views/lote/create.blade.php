@extends('layouts.plantillaBase2')
<style>
.modal_cuerpo{
    background-color:#E53935!important;
    color:white !important;
    padding: 10px;
    margin: 10px;
    font-family: Arial, Helvetica, sans-serif;
    font-size: 20px !important;

}
.modalTurno{
    padding: 6px !important;
    border-radius: 100px!important;
}

.precioModal{
  background:#e79292!important; 
  cursor: no-drop !important;
 
  
}
#exampleModal{
  background:rgb(245, 39, 30 ,0.6) !important;
}
.simbolo{
  display: inline !important;
  padding: 13px;
 
  

}
input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button { 
  -webkit-appearance: none; 
  margin: 0; 
}

input[type=number] { -moz-appearance:textfield; }
</style>

 
<link rel="stylesheet" type="text/css" href="{{asset('estiloArticulo.css')}}">
@section('contenido')
<div class="form-group  text-center w-50 " style="margin: 20 auto; width: 200px;">
    <h2 class="text-center text-light p-2 m-2 fs-1 fw-bold" >Nuevo Lote</h2>
    <h4 class="text-center text-light p-2 m-2 fw-bold" >Articulo <p class="text-dark">{{$articulos->descripcion}}</p></h4> 
   <div class="row container-fluid d-flex justify-content-center">

    <p class="text-info">*Esta pregunta es obligatoria</p>
    <form action="/Lotes/{{$ArticuloId}}/store" method="POST" id="formulario" name="formulario" class="w-75">
        @csrf
        @method('Post')
     
        
      
 <!--Precio de compra -->
   <div class="mb-3">
    <div class="formulario__grupo" id="grupo__precioCompra" title="Valor númerico único que se va identificar el producto">
  <label for="precioCompra" class="formulario__label">Precio de Compra Unitario*</label>
  <div class="formulario__grupo-input px-2">
   
    <input id="precioCompra" name="precioCompra" type="number" class="form-control formulario__input" maxlength="8" required>

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
   
    <input id="unidades" name="unidades" type="number" class="form-control formulario__input" maxlength="8" required>

    <i class="formulario__validacion-estado fas fa-times-circle"></i>
        </div>

        <p class="formulario__input-error">Unidades, solo puede contener valores númericos</p>
    </div>
      </div>
      
    @if($articulos->alerta > 0)
    <div class="mb-3">
        <div class="formulario__grupo  w-90 " id="grupo__vencimiento" title="Fecha de vencimiento del lote del producto">
          <label for="vencimiento" class="formulario__label">Fecha de vencimiento*</label>
          <div class="formulario__grupo-input px-2">
              <input id="vencimiento" name="vencimiento" type="date" class="form-control formulario__input" maxlength="8"  requiered>
              <i class="formulario__validacion-estado fas fa-times-circle"></i>
          </div>
          <p class="formulario__input-error">Unidades, solo puede contener valores númericos</p>
        </div>
    </div>
    @endif
          <br>
        <a href="/Lotes/{{$ArticuloId}}/lote" class="btn btn-secondary" tabindex="6">Cancelar</a>
        
        <button type="submit" class="btn btn-primary" tabindex="7">Guardar</button>
    </form>
</div>
<!-- Modal de cambio de precioVenta de articulo -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title text-center text-dark " id="exampleModalLabel">Producto:{{$articulos->descripcion}}</h5>
          
        </div>
      <div class="modal-body modal_cuerpo">
            <div class="  text-center  ">
                    <div id= "contendorAviso">
                      <h4 id = tituloAviso>El precio de venta del producto debe actualizarse</h4>
                    </div>
                    <h5 id = 'tituloModal'></h5>
               
                    <h4> El precio actual de venta del producto es de ${{$articulos->precioVenta}}</h4>
                  
                    <label>Costo por artículo (Unidad)</label><br>
                    <label><div class="bg-dark simbolo">$</div><input type="number" id = "precioUnitLote" class="p-2 precioModal" name = "precioUnitLote" class="inputPrecio fw-blod  " readonly></label>
                    <br>
                    <label>Porcentaje de ganancia </label><br>
                    <label><div class="bg-dark simbolo">%</div><input type = "number" id = "aumento"  class="p-2" name = "aumento" step="0.01" ></label>
                    <br>
                    <label>Precio de venta actualizado</label><br>
                    <label><div class="bg-dark simbolo">$</div><input type="number" id ="montoAumentado"  class="p-2"  name = "montoAumentado"step="0.01"  ></label>
                    <div class="container-fluid d-flex justify-content-center m-2">
                        <button class="btn btn-primary m-2" name="ModalAplicar" id="modalAplicar" tabindex="6">Aplicar</button>
                        <button id='cancelarModal' class="btn btn-secondary m-2" name="noAplicar" tabindex="7">Cancelar</button>
                    </div>
            </div>
        </div>
    </div>
</div>


</body>
<script>
  let articulos  = @json($articulos);
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

<script src="{{asset('validarLote.js')}}" defer></script>
<!-- accion de boton cancelar de modal -->
  <script>
    let botonCancelar = document.getElementById('cancelarModal');
    botonCancelar.addEventListener('click', function () {
      $("#exampleModal").modal("hide");
    });
  </script>


@endsection