@extends('layouts.plantillaBase2')
<style>

.idArticulos p{
    color:red !important;
}



</style>
<!-- select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    
    <link rel="stylesheet" type="text/css" href="{{asset('estiloVentas.css')}}">
@section('contenido')
<body>
   <h2 class="d-flex justify-content-center p-2">Sector de Ventas</h2>
    <div class="container">
        
        
    <div id="buscar-container">
        <div class="row">
        <div class="col-md-1 col-sm-2 col-xs-4 border">    <img src="https://i.pinimg.com/originals/e7/31/3c/e7313cf4e2648d7170a034bdfe99894e.gif" height="50" width="50"></div>
        <div class="col-md-9 col-sm-6 col-xs-4 border"> <input type="search" id="buscar-input" placeholder="buscar productor por nombre.."/></div>
        <div class="col-md-2 col-sm-4 col-xs-4 border"><button id="buscar">Buscar</button> </div>
         </div>
</div>


       
        
                <div id="botones">
                    <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-12 border text-end">
                                <button class="boton-value"id="todo">Todo</button>
                                <button class="boton-value" id="alimentos">
                                Alimentos
                                </button>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12 border">
                                <button class="boton-value" id="asesorios">
                                Asesorios 
                                </button>
                                <button class="boton-value" id="medicamentos">
                                Medicamentos 
                            </button>
                            </div>
              

                </div>
        </div>
        <br>
         <div class="row d-flex">
                     
                     <div class="col-8 border"> <div id="productos"></div></div> 
                     
                     <div class="col-4 border">
                                    <div class="d-flex justify-content-end">
                                            <div class="card d-flex" style="width: 18rem;" >
                                                <div class="card-body ">
                                                <h5 class="card-title">Medio de Pago</h5>
                                                <input type="radio" id="debito" name="debito" value="debito">
                                                  <label for="debito"><img src ="https://www.visa.com.co/dam/VCOM/regional/lac/SPA/Default/Pay%20With%20Visa/propuesta-pagina-de-tarjetas/visa-debit-classic-800x450.jpg" alt="debito" height="60" width="100"> Debito</label><br>
                                                <br>
                                                <input type="radio" id="efectivo" name="efectivo" value="efectivo">
                                                  <label for="html"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTUp8FsrX1BxY0pAKzW6CWBfQf4s7DMaNLMtQ&usqp=CAU" height="60" width="100" > Efectivo</label><br>
                                                <br>
                                                <input type="radio" id="credito" name="credito"  value="credito">
                                                  <label for="html"><img src="https://www.macro.com.ar/imagen/imagen-tc-mastercard-gold.png" height="60" width="100" > Credito</label><br>
                                              
                                                </div>
                                            </div>
                                    </div>
                                </div>
                       </div>
                  
         </div>
         <div class="row">
            <div class="col-md-3 col-sm-2 col-xs-4 border"> nuestro bloque </div>
            <div class="col-md-6 col-sm-6 col-xs-4 border"> nuestro bloque </div>
            <div class="col-md-3 col-sm-4 col-xs-4 border"> nuestro bloque </div>
          
            </div>

   
        <!-- Script -->
        <script src="script.js"></script>
      </body>


    {{-- <div class="marco m-3 p-2 ">
    <div class="container-fluid d-flex justify-content-center  text-light">
        <h2 class="text-center p-2 m-2 fs-1 fw-bold text-dark" >Seleccione Artículos</h2>
    
    </div>
  
    <div class="container-fluid d-flex justify-content-center  text-light m-2">
        <select  id='idArticulos' class="js-example-basic-single p-3" name="idArticulos" style="width:60%" >
                <option value="0"></option>
                @foreach($lotes as $unLote)
                    <option value="{{$unLote->id}}" class="seleccion"><table class="text-center"><tr><td colspan=" ">{{$unLote->articulo->descripcion}}</td><td colspan="2">&nbsp;&nbsp;</td><td colspan="1">({{$unLote->articulo->marca}})</td><td colspan="2">&nbsp;  </td><td class="fs-bold text-danger"><p class="text-danger">{{$unLote->vencimiento}}</p></td></tr></table></option>
                    
                @endforeach
        </select>
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
    $total = 0;
    $estado = session("estado"); 
@endphp

<div class= "container">
<table id="example"  class="table table-striped" style="width:100%" >
    <thead>
           
            <tr>
                
                <th scope="col">Artículo</th>
            {{--     <th scope="col">Marca</th> --}}
                {{-- <th scope="col">Cantidad</th>
                <th scope="col">Precio</th>
                <th scope="col">Descuento</th>
                <th scope="col">Subtotal</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>      
    <tbody>
    @foreach(session("articulos") as $producto)
        @php
            $date = date('d-m-Y',strtotime($producto->vencimiento));
        @endphp
    <tr>
        
        <td><i class="fa-solid fa-cart-shopping"></i> {{$producto->articulo->descripcion}}/{{$producto->articulo->marca}}</td>
         <td>x {{$producto->unidad}}</td>
        @if($estado[$indice] == 0)
            <td>{{$producto->articulo->precioVenta}}</td>
            <td>  </td>
            <td>{{($producto->unidad)*($producto->articulo->precioVenta)}}</td>
            @php
                $indice++;
                $total += ($producto->unidad)*($producto->articulo->precioVenta);
            @endphp
        @else
            <td>{{$producto->articulo->precioEspecial}}</td>
            <td> {{($producto->unidad)*($producto->articulo->precioEspecial) - ($producto->unidad)*($producto->articulo->precioVenta)}} </td>
            <td>{{($producto->unidad)*($producto->articulo->precioEspecial)}}</td>
            @php
                $indice++;
                $total += ($producto->unidad)*($producto->articulo->precioEspecial);
            @endphp
        @endif
        
        
        <td><form action="{{route('quitarArticulo')}}" method="POST">
            @csrf
            @method('DELETE')
            <input type="hidden" value="{{$indice}}" name="articulo">
            <a class="btn btn-success rounded-pill p-1"  href="/agregarArticuloVenta/{{$producto->id}}" name="masUno" title="más Uno"><i class="fa-solid fa-circle-plus"></i></a>
            <a class="btn btn-danger rounded-pill p-1"  href="/eleminarUnArticuloVenta/{{$producto->id}}" name="menosUno" title="menos Uno"><i class="fa-solid fa-circle-minus"></i></a>
            <a class="btn btn-secondary rounded-pill p-1"  href="/precioEspecial/{{$producto->id}}" name="PrecioEspecial" title="PrecioEspecial"><i class="fa-solid fa-circle-exclamation"></i></i></a>    
            <button class="btn btn-danger rounded-pill p-1" title="Eliminar"><i class="fa-solid fa-trash-can "></i></button>

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
</html>
    

   <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="  https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
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
        
        

        



        

    
        </script> --}} 
        
</body>
@endsection