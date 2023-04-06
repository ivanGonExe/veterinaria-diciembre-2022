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
</style>
<link rel="stylesheet" type="text/css" href="{{asset('estiloArticulo.css')}}">
@section('contenido')
<body>

<div class="form-group  text-center w-50 " style="margin: 20 auto; width: 200px;">
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
    @if($articulos->alerta > 0)
        <div class="mb-3" >
            <div class="formulario__grupo w-90" id="grupo__vencimiento" title="Fecha de vencimiento del lote del producto">
                <label for="vencimiento" class="formulario__label">Vencimiento*</label>
            <input id="vencimiento" name="vencimiento" type="date" class="form-control formulario__input" value ='{{$lote->vencimiento}}' tabindex="5">
        </div>
<br>
    @endif
        <a href="/Lotes/{{$lote->articulo_id}}/lote" class="btn btn-secondary" tabindex="6">Cancelar</a>
        
        <button type="submit" class="btn btn-primary" tabindex="7">Guardar</button>
    </form>
</div>
<!-- Modal de cambio de precioVenta de articulo -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">

        <div class="modal-header bg-dark text-center">
          <h5 class="modal-title text-center " id="exampleModalLabel">Producto:{{$articulos->descripcion}}</h5>
          
        </div>
      <div class="modal-body modal_cuerpo">
            <div class="  text-center  ">
                    <div id= "contendorAviso">
                      <h4 id = tituloAviso>Margen menor de ganancia, por lo que se aplicara el % configurado</h4>
                    </div>
                    <h5 id = 'tituloModal'></h5>
                    <br>
                    <h4> El precio actual de venta del producto es de ${{$articulos->precioVenta}}</h4>
                    <Br>
                    <label>Precio unitario del costo del lote</label><br>
                    <label>$<input type="number" id = "precioUnitLote" name = "precioUnitLote" class="inputPrecio fw-blod" readonly></label>
                    <br>
                    <label>Porcentaje configurado </label><br>
                    <label>%<input type = "number" id = "aumento" name = "aumento" step="0.01" ></label>
                    <br>
                    <label>Precio de venta actualizado</label><br>
                    <label>$<input type="number" id ="montoAumentado" name = "montoAumentado"step="0.01"  ></label>
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