@extends('layouts.plantillaBase2')
<style>
.idArticulos p{
    color:red !important;
}
.modalTurno{
    padding: 6px !important;
    border-radius: 100px!important;
}
.eliminar{
 color:brown!important;
}
.eliminar:hover{
 color:red !important;
}
.modal_cuerpo{
    background-color:#E53935!important;
    color:white !important;
    padding: 10px;
    margin: 10px;
    font-family: Arial, Helvetica, sans-serif;
    font-size: 20px !important;

}
input:focus{
    background-color:#D7DBDD!important;
}
.inputPrecio{
    color:black;
    background-color:#CFD8DC !important;
    cursor: not-allowed !important;
    text-align: center;
}
.buscar{
    padding-top:12px !important;
    
}
</style>
<!--Jquery-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<!-- select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<!--BOOTSTRAP -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


 
@section('contenido')
<body>
    <div class="marco m-3 p-2 ">
    <div class="container-fluid d-flex justify-content-center  text-light">
        <h2 class="text-center p-2 m-2 fs-1 fw-bold text-dark" >Seleccione Artículos</h2>
    
    </div>
  <div class="row">
       
            <div class="col-8">
                        <div class="container-fluid d-flex justify-content-end text-light p-3">
                                <select  id='idArticulos' class="js-example-basic-single p-3" name="idArticulos" style="width:60%" >
                                        <option value="0"></option>
                                        @foreach($lotes as $unLote)
                                            <option value="{{$unLote->id}}" class="seleccion"><table class="text-center"><tr><td colspan=" ">{{$unLote->articulo->descripcion}}</td><td colspan="2">&nbsp;&nbsp;</td><td colspan="2">&nbsp;  </td><td class="fs-bold text-danger"><p class="text-danger">{{$unLote->vencimiento}}</p></td></tr></table></option>
                                            
                                        @endforeach
                                </select>
                        </div>
            </div>
            <div class="col-4"> 
                    <div class="buscar">
                        <form class="form-inline " >
                            <div class="btn btn-primary m-1" style="height: 28px ;line-height: 15px;"> Código <i class="fa-solid fa-magnifying-glass"></i></div>
                            <select  id='codigoArticulo' class="js-example-basic-single p-3" name="codigoarticulo"  placeholder="Código" aria-label="Search" style="width:120px;height: 28px" >
                                        <option value="0"></option>
                                        @foreach($lotes as $unLote)

                                            <option value="{{$unLote->id}}" class="seleccionCodigo"><table class="text-center"><tr><td colspan=" ">{{$unLote->articulo->codigo}}</td><td colspan="2">&nbsp;&nbsp;</td><td colspan="2">&nbsp;  </td><td class="fs-bold text-danger"><p class="text-danger">{{$unLote->vencimiento}}</p></td></tr></table></option>

                                        @endforeach
                                </select>
                        </form>
                    </div>
                
            </div>
       
  </div>
 
    <br>
    <br>

@if(session("articulos") != null)
<div class="container-fluid d-flex justify-content-center  text-light">
        <div>
            <div class="row">
                <div class="col-6">
                    <a class="btn btn-primary" href="/terminarVenta" title="realizar venta">Vender</a>
                </div>

                <div class="col-6">
                    <a class="btn btn-danger" href="/cancelarVenta" title="cancelar venta">Cancelar</a>
                </div>

            </div>
        </div>
    </div>
    </div>

    <div class="container-fluid d-flex justify-content-center  text-light">
   
@php
    $indice = 0;
    $total  = 0;
    $estado = session("estado"); 
@endphp

<div class= "container">
 
<table id="example"  class="table table-striped" style="width:100%" >
    <thead>
            <tr>
                <th scope="col" class="text-break col-2">Artículo  </th>
                <th scope="col">Cantidad       </th>
                <th scope="col">Precio x ud.   </th>
                <th scope="col">Descuento x ud.</th>
                <th scope="col">Descuento total</th>
                <th scope="col">Subtotal       </th>
                <th scope="col">Acciones       </th>
            </tr>
        </thead>      
    <tbody>
    @foreach(session("articulos") as $producto) 
        @php
            $date = date('d-m-Y',strtotime($producto->vencimiento));
        @endphp
    <tr>
         <td class="text-break col-2"><i class="fa-solid fa-cart-shopping"></i> {{$producto->articulo->descripcion}}</td>
         <td>x {{$producto->unidad}}</td>
        @if($estado[$indice] == 0)
            <td>${{$producto->precioVenta + $producto->descuento}}</td>
            <td>-$ {{$producto->descuento}} </td>
            <td>-$ {{$producto->descuento * $producto->unidad }}</td>
            <td>${{($producto->unidad)*($producto->precioVenta)}}</td>
            @php
                $indice++;
                $total += ($producto->unidad)*($producto->precioVenta);
            @endphp
        @else
            <td>{{$producto->articulo->precioEspecial}}</td>
            <td> {{($producto->unidad)*($producto->precioEspecial) - ($producto->unidad)*($producto->precioVenta)}} </td>
            <td>{{($producto->unidad)*($producto->precioEspecial)}}</td>
           
            @php
                $indice++;
                $total += ($producto->unidad)*($producto->precioEspecial);
            @endphp
        @endif
        
        
        <td><form action="{{route('quitarArticulo')}}" method="POST">
            @csrf
            @method('DELETE')
            <input type="hidden" value="{{$indice}}" name="articulo">
            <a class="btn text-success  p-1 fs-3"  href="/agregarArticuloVenta/{{$producto->id}}" name="masUno" title="más Uno"><i class="fa-solid fa-circle-plus"></i></a>
            <a class="btn text-danger  p-1 fs-3"  href="/eleminarUnArticuloVenta/{{$producto->id}}" name="menosUno" title="menos Uno"><i class="fa-solid fa-circle-minus"></i></a>
            <!-- <a class="btn btn-secondary rounded-pill p-1"  href="/precioEspecial/{{$producto->id}}" name="PrecioEspecial" title="PrecioEspecial"><i class="fa-solid fa-circle-exclamation"></i></i></a>     -->

        <!--boton modal  -->
            <button type="button" class="btn btn-primary rounded-pill  modalTurno"  data-toggle ="modal" data-target="#exampleModal" title="Agendar persona al turno" id ="{{$producto->id}}" value="{{$producto->articulo->precioVenta}}">
                <i class="fa-solid fa-percent"></i>
            </button>    
            <button class="btn  p-1  fs-3 eliminar" title="Eliminar"><i class="fa-solid fa-trash-can "></i></button>                    
        </form></td>

    </tr>
        
    @endforeach
</table>
<tr><h5 class="text-end bg-danger btn-success p-2">Total:<strong> ${{$total}}<strong></tr>
</div>
    
    </div>
@else
    <div class="container-fluid d-flex justify-content-center  text-light">
        <div>
            <div class="row">
                <div class="col-6">
                    <button class="btn btn-primary" href="/terminarVenta" title="realizar venta" disabled>Vender</button>
                </div>

                <div class="col-6">
                    <a class="btn btn-danger" href="/cancelarVenta" title="cancelar venta">Cancelar</a>
                </div>

            </div>
        </div>
    </div>
@endif

<!-- ************************************************************ -->
    @if(Session::has('message'))

        <div class="alert
        {{ Session::get('alert-class', 'alert-info') }}">{{Session::get('message') }}</div>

    @endif


<!-- Modal  de descuento----------------------------------------------------------------------------------------------------------------------->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">

        <div class="modal-header bg-dar text-center">
          <h5 class="modal-title text-center " id="exampleModalLabel">Aplicar Descuento al articulo</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body modal_cuerpo">
            <div class="  text-center p-3 ">
                <form action =" " method="POST" id="formulario" class="text-center ">
                    @csrf
                    <h5 id = 'tituloModal'></h5>
                    <br>

                    <label>Precio del producto</label><br>
                    <label>$<input type="number" id = "precioProducto" name = "precioProducto" class="inputPrecio fw-blod" readonly></label>
                    <br>

                    <label>Descuento </label><br>
                    
                    <label>%<input type = "number" id = "descuento" name = "descuento" step="0.01" ></label>
                    <br>
                    <label>Monto descontado</label><br>
                    <label>$<input type="number" id ="montoDesc" name = "montoDesc"step="0.01"  ></label>
                    <div class="container-fluid d-flex justify-content-center m-2">
                        <a href=" " class="btn btn-secondary m-2" name="cancelar" id="cancelar" tabindex="6">Cancelar</a>
                        <button type="submit" id='botonGuardar' class="btn btn-primary m-2" tabindex="7">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</html>
{{-- <!-- librerias------------------------------------------------------------------------------------------------------------------------------- --> --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="  https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>


/*<!--Trae los datos para realizar el descuento------------------------------------------------------------------------------------------------ --*/


    $(document).ready(function (){
    
        let id            = 0;
        let botonesModal  = document.getElementsByClassName("modalTurno");
        let botonModal    = [];
        let cantidad      = botonesModal.length;
        
        for(let i = 0; i < cantidad; i++){
            
            id            = botonesModal[i].id;
            botonModal[i] = document.getElementById(`${id}`);
            
            botonModal[i].addEventListener('click', function(){

                $.ajax({
                    type: "GET",
                    url: "/buscarProducto/"+ botonModal[i].id,
                    data: {
                        id: botonModal[i].id,
                        _token: $('input[name="_token"]').val(),
                    },
                }).done(function (res) {

                    let producto            = JSON.parse(res);
                    let tituloModal         = document.getElementById('tituloModal');
                    let precioProducto      = document.getElementById('precioProducto');

                    tituloModal.innerHTML   = "Producto: "+producto[0].descripcion;
                    precioProducto.value    = producto[0].precioVenta;
                    
                });

                let formulario       = document.getElementById('formulario');
                
                formulario.action    = '/aplicarDescuento/'+botonModal[i].id;
                
            });
        }
    });
</script>
<!-- Calculo de porcentaje y controles---------------------------------------------------------------------------------------------------------->
<script>
    let montoDesc = document.getElementById('montoDesc');
    
    montoDesc.addEventListener('keyup', function(){
        
        let descuento       = document.getElementById('descuento');
        let precioProducto  = document.getElementById('precioProducto'); 
        let numDescuento    = parseFloat(montoDesc.value);
        let numPrecio       = parseFloat(precioProducto.value);
        //control de que no halla mas de dos numeros en los inputs
       
        let conversion = Number(montoDesc.value).toFixed(2);
        let cadena     =  montoDesc.value.split('.');
        
        if(cadena.length == 2){
            if(cadena[1].length > 2){
                montoDesc.value = conversion;
            }
        }

        if(numDescuento > numPrecio ){
          
            montoDesc.value = precioProducto.value;
        }

        if(montoDesc.value < 0){
            montoDesc.value = 0; 
        }
        let montoAux     = (montoDesc.value*100)/precioProducto.value; 
        descuento.value  = montoAux.toFixed(2);
    })

    let precioProducto  = document.getElementById('precioProducto');

    montoDesc.addEventListener('input',function(){

        let descuento       = document.getElementById('descuento');
        let precioProducto  = document.getElementById('precioProducto'); 
        let numDescuento    = parseFloat(montoDesc.value);
        let numPrecio       = parseFloat(precioProducto.value);
        //control de que no halla mas de dos numeros en los inputs
       
        let conversion = Number(montoDesc.value).toFixed(2);
        let cadena =  montoDesc.value.split('.');
        if(cadena.length == 2){
            if(cadena[1].length > 2){
                montoDesc.value = conversion;
            }
        }
        
        if(numDescuento > numPrecio ){
          
            montoDesc.value = precioProducto.value;
        }


        if(montoDesc.value < 0){
            montoDesc.value = 0; 
        }
            
    })

    let descuento = document.getElementById('descuento');

    descuento.addEventListener('keyup', function(){

        let montoDesc       = document.getElementById('montoDesc');
        let precioProducto  = document.getElementById('precioProducto');
        // control de que el porcentaje tenga dos lugares depues de la coma
        let cadenaAux = descuento.value.split('.');
        let conversionAux = Number(descuento.value).toFixed(1);
        if(cadenaAux.length > 1){
            if(cadenaAux[1].length > 1){
                descuento.value = conversionAux;
            }
        }
        if(this.value > 101 ) 
            this.value = this.value.slice(0,2);
        if(this.value < 0)
            this.value = 0;
        let precioAux = (precioProducto.value * descuento.value)/100;  
        montoDesc.value = precioAux.toFixed(2);  
    })

    descuento.addEventListener('input',function(){
        if (this.value > 100 ) 
            this.value = this.value.slice(0,2);
        if (this.value < 0)
            this.value = 0; 
    })

</script>
<!-- Agregado de articulo a la tabla-------------------------------------------------------------------------------------------------------- -->
<script>
    $(document).ready(function () {
        $('.js-example-basic-single').select2();
      
    });
    $("#idArticulos").on("change",function(event){

        var id = document.getElementById("idArticulos").value;

        if(id != 0){

            var link = "/agregarArticuloVenta/"+id;
            location.href = link;
        }
    });
    $("#codigoArticulo").on("change",function(event){

        var idArticulo = document.getElementById("codigoArticulo").value;

        if(idArticulo != 0){

            var link = "/agregarArticuloVenta/"+idArticulo;
            location.href = link;
        }
    });
</script>
</body>
@endsection