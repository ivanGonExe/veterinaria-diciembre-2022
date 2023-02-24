@extends('layouts.plantillaBase2')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script> 

 @section('contenido')
<style>

.dt-button {
  padding: 0px !important;
  border: none !important;
  top:-10px;
}
</style>

   <div class="d-flex justify-content-end m-2 p-2">
    <a href="/ventas" class="btn btn-secondary rounded-pill">
        <i class="fa-solid fa-arrow-rotate-left"></i></a>
   </div>
    
     <div class="container-fluid d-flex justify-content-center">
     <h3 class="text-center p-2 m-2 fw-bold text-dark" >Fecha de la venta: {{$venta->fecha}}
     </h3>
    </div>
   
  
    <div class="container-fluid d-flex justify-content-center  text-light p-2">
    <button type="button" class="btn btn-primary bg-danger tex-end m-2 p-2" id="pdf">
    <i class="fa-solid fa-file-pdf"></i> pdf</button>
    </div>


<table id="example" class="table table-striped m-1 p-1" style="width:100%">
  
        <thead>
           
           <tr>
               <th scope="col"class="text-center">Cod. Artículo</th>
               <th scope="col"class="text-center">Nombre</th>
               <th scope="col"class="text-center">Marca</th>
               <th scope="col"class="text-center">Precio x ud.</th>
               <th scope="col"class="text-center">Cantidad</th>
               <th scope="col"class="text-center">Descuento x ud.</th>
               <th scope="col"class="text-center">Descuento total</th>
               <th scope="col"class="text-center">Subtotal</th>
               
              
             {{--   <th scope="col"class="text-center">Monto Pagado</th>
              
               <th scope="col"class="text-center">Total</th> --}}
           </tr>
        </thead>
        <tbody>
        
            @foreach($detalles as $unDetalle)
            <tr class="text-center">
                <td id="codigo">{{$unDetalle->codigo}}</td>
                <td id="descripcion">{{$unDetalle->descripcion}}</td>
                <td id="marca">{{$unDetalle->marca}}</td>
                <td id="precio">${{$unDetalle->subtotal/$unDetalle->cantidad}}</td>
                <td id="cantidad">{{$unDetalle->cantidad}}</td>
                <td id="descuento">-${{$unDetalle->descuento}}</td>
                <td >-${{$unDetalle->descuento * $unDetalle->cantidad}}</td>
                <td id="subtotal">${{$unDetalle->subtotal}}</td>
                
               
            {{--   
            <td id="montoPagado">${{$venta->montoPagado}}</td>
           
            <td id="venta">${{$venta->total}}</td> --}}
   
            </tr>
            @endforeach
       </tbody>

    </table>
   
    
   
   @php
     $montoAdeudado = -($venta->total-$venta->montoPagado);
    @endphp
    <div class="container m-2 ">
        <div class="text-end">
            <h3 id="total">Total:<strong>${{$venta->total}}</strong></h3>
            <h3 id="pago">Pagó:<strong>${{$venta->montoPagado}}</strong></h3>
            <h3 id="vuelto">Vuelto:<strong>${{$montoAdeudado}}</strong></h3>
        </div>
    </div> 

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="  https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>


 <script>



let productos =  @json($detalles);
console.log(productos);
//la fecha es única por eso queda afuera del recorrido 
let total =   document.getElementById("total"). textContent;
let pago =  document.getElementById("pago"). textContent;
let subtotal = document.getElementById("subtotal"). textContent;
let vuelto = document.getElementById("vuelto"). textContent;
//click en el botón pdf
let boton = document.getElementById('pdf');
boton.addEventListener("click", function() {


 
// crear el objecto de la libreria jsPDF
const doc = new jsPDF();
 doc.setFontSize(16); //tamaño de letras 
 //inserta texto en el futuro pdf  
 doc.text("Veterinaria SAN AGUSTIN",70,10);/* x,y*/
 //va de forma secuencial como los archivos de texto ... (cadena,orientacion x, orientacion y)
 doc.text("No valido como factura X",70,20);
 doc.text("Emitido:"+ fecha +"        "+" " , 10, 30); 
 
 doc.text("-------------------------------------------------------------------------------------------------------", 10, 40);
 doc.text("cantidad"+"  ", 10, 50);/* x,y*/
  doc.text("         "+"codigo", 30, 50);
 doc.text("             descripcion", 50, 50);
 doc.text("                        importe", 100, 50);
 doc.text("                         subtotal",140, 50);
 
 
 doc.text("-------------------------------------------------------------------------------------------------------", 10, 60);


/* recorremos el arreglo para que imprima las cosas */ 
let tamanio = productos.length; 
let punteroX =10; //necesitamos dos puntero que se vayan corriendo para no pisar los datos 
let punteroY = 70; 
 for (var i = 0; i < tamanio; i++) {
   
 doc.text(productos[i].cantidad.toString(), punteroX ,punteroY);
 punteroX = punteroX+30;
doc.text(productos[i].codigo.toString(),punteroX,punteroY);
punteroX = punteroX+30;
  doc.text(productos[i].descripcion, punteroX ,punteroY);
  punteroX= punteroX+70;
  doc.text("$"+productos[i].precioVenta.toString(), punteroX , punteroY);
  punteroX= punteroX+40;
  doc.text("$"+(productos[i].subtotal).toString(), punteroX , punteroY);
  punteroY= punteroY+10;
  punteroX=10;
  doc.text("Descuento:-$"+-(productos[i].descuento).toString(), punteroX , punteroY);
  punteroY= punteroY+10;
  punteroX=10;
/*  doc.text(productos[i].codigo, punteroX ,punteroY);
 doc.text(productos[i].descripcion, punteroX , punteroY);
 doc.text(productos[i].precio, punteroX , punteroY); */


 

}  
doc.text("-------------------------------------------------------------------------------------------------------", punteroX,punteroY);
punteroY= punteroY+10;
punteroX=punteroX+140;
doc.text(total,punteroX , punteroY); 
punteroY= punteroY+10;

  doc.text(pago,punteroX , punteroY); 
punteroY= punteroY+10;
 
doc.text(vuelto, punteroX , punteroY);
punteroY= punteroY+10;

doc.save(fecha+" SanAgustin "+".pdf");
});


$(document).ready(function () {

$('#example').DataTable();


});
$('#example').DataTable({
language: {
url: "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
}
}); 





    </script>


@endsection