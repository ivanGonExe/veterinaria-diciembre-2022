@extends('layouts.plantillaBase2')




@section('contenido')


<div class="caja_tabla-2">
    <div class="container-fluid d-flex justify-content-center  text-light">
        <h2 class="text-center p-2 m-2 fs-1 fw-bold text-dark" >Historial de Ventas</h2>
    {{-- <a href="ventas/create" class="btn btn-light boton_crear">Realizar venta</a> --}}
    </div>
    <!-- Button trigger modal -->
    <div id="contenedorBotones">
        <button type="button" id="botonAbrirCaja1" class="btn btn-primary rounded-pill m-2 p-2" title="Nueva caja" data-bs-toggle="modal" data-bs-target="#modalAperturaCaja" @if($estado != 0) style="display: none;" @endif >
            Abrir Caja
        </button>

        <button type="button" id="botonCerrarCaja2" class="btn btn-primary rounded-pill m-2 p-2" title="Nueva caja" data-bs-toggle="modal" data-bs-target="#modalCerrarCaja" @if($estado != 1) style="display: none;" @endif>
            Cerrar Caja
        </button>

        <a href="ventas/create" type="button" id="botonVenta1" class="btn btn-primary rounded-pill m-2 p-2" title="Nueva venta" @if($estado != 1) style="display: none;" @endif>+ Venta <i class="fa-solid fa-cash-register"></i></a>
        
        <button type="button" id="botonAbrirCaja2" class="btn btn-primary rounded-pill m-2 p-2" title="Nueva caja" data-bs-toggle="modal" data-bs-target="#modalAperturaCajaAnterior" @if($estado != "2") style="display: none;" @endif>
            Abrir Caja
        </button>
    </div>

</div>
    
  
    <table id="example" class="table table-striped" style="width:100%">
           
        <thead>
           
            <tr>
                
                <th scope="col">Fecha</th>
                <th scope="col">Total ($) </th>
                <th scope="col">Monto pagado ($)</th>
                <th scope="col">Tipo de pago</th>
                <th scope="col">Detalle de Venta</th>
            </tr>
        </thead>

        <tbody>
            @foreach($ventas as $unaVenta)
                <tr>
                    
                    <td>{{$unaVenta->fecha}}</td>
                    <td>${{$unaVenta->total}}</td>
                    <td>${{$unaVenta->montoPagado}}</td>
                    <td>{{$unaVenta->tipoPago}}</td>
                    <td>
                        
                            <a href="{{ route('ventas.show', $unaVenta->id)}}" name="ver" class="btn btn" title="Ver detalle de una venta"><i class="fa-solid fa-eye"></i></a>             
                  
                          
                      
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
    </div>

<!-- --------------------------------- MODALES DE APERTURA DE CAJA ----------------------------------------------------------- -->
    <!-- Modal de apertura de caja -->
    <div class="modal fade" id="modalAperturaCaja" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Abrir Caja</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="usuarioId" id ="usuarioId" value="{{auth()->user()->id}}">

                <div class="mb-3">
                    <label for="fondoInicial" class="form-label text-black">Fondo inicial</label>
                    <input type="number" class="form-control" id="fondoInicial" value="0" min="0">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="botonAbrirCaja">Continuar</button>
            </div>
            </div>
        </div>
    </div>



    <!-- Modal de caja abierta exitosa-->
    <div class="modal fade" id="modalCajaAbiertaExitosamente" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <h3 class="text-success">Caja abierta exitosamente!</h3>

                <div class="text-success"><i class="fa-regular fa-circle-check fa-8x"></i></div>
            </div>
            <div class="modal-footer text-center">
                <button type="button" class="btn btn-primary m-auto" id="cerrarModalCajaAbierta">OK</button>
            </div>
            </div>
        </div>
    </div>


    <!-- Modal de caja abierta error-->
    <div class="modal fade" id="modalCajaAbiertaError" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <h3 class="text-danger">Ya se encuentra abierta una caja para este usuario en este día!</h3>

                    <div class="text-danger"><i class="fa-regular fa-circle-xmark fa-8x"></i></div>
                </div>
                <div class="modal-footer text-center">
                    <button type="button" class="btn btn-primary m-auto" id="cerrarModalCajaAbiertaError">Ok</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal de apertura caja anterior-->
    <div class="modal fade" id="modalAperturaCajaAnterior" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <h3 class="text-success">Tiene una caja asiganada anteriormente para este dia, se volverá a abrir!.</h3>

                <div class="text-success"><i class="fa-regular fa-circle-check fa-8x"></i></div>
            </div>
            <div class="modal-footer text-center">
                <button type="button" class="btn btn-primary m-auto" id="cerrarModalCajaAbiertaAnterior">OK</button>
            </div>
            </div>
        </div>
    </div>

<!-- --------------------------------- MODALES DE CIERRE DE JORNADA ----------------------------------------------------------- -->

<!-- Modal de cerrar jornada -->
<div class="modal fade" id="modalCerrarCaja" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Cerrar jornada</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <h3>¿Desea cerrar la jornada?</h3>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-primary" id="botonCerrarCaja">Aceptar</button>
        </div>
        </div>
    </div>
</div>

<!-- Modal de caja cerrada exitosa-->
<div class="modal fade" id="modalCajaCerradaExitosamente" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-center">
            <h3 class="text-success">Caja cerrada exitosamente!</h3>

            <div class="text-success"><i class="fa-regular fa-circle-check fa-8x"></i></div>
        </div>
        <div class="modal-footer text-center">
            <button type="button" class="btn btn-primary m-auto" id="cerrarModalCajaCerrada">OK</button>
        </div>
        </div>
    </div>
</div>
   <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="  https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

    <script>

 $(document).ready(function () {

           $('#example').DataTable();
      

});
 $('#example').DataTable({
language: {
url: "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
}
}); 



/*------------------------------------------------ */
$(document).ready(function (){

    var id = 0;
    var botones = document.getElementsByClassName("eliminar");
    var boton = [];

    let cantidad = botones.length;
    for(let i = 0; i < cantidad; i++){
        //botones[i].addEventListener('click', () => {
        id =botones[i].id;
        //console.log(id);
        boton[i]= document.getElementById(`${id}`);
    
        boton[i].addEventListener('click', function(){

            var cod = boton[i].value;
                            

            Swal.fire({
                title: 'Esta Seguro que desea Borrar?',
                text: "confirme la decisión!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, eliminar'
    
            }).then((result) => {
                if (result.isConfirmed) {
                            
                    location.href = 'ventas/'+cod+'/delete'; 

                    /*  Swal.fire(
                    'Eliminado',
                    'Your file has been deleted.',
                    'success'
                    ) */
                }
            })

        });

    }
});


/*---------------- Funciones para abrir la caja -------------------*/

let botonAbrirCaja = document.getElementById("botonAbrirCaja");
botonAbrirCaja.addEventListener("click", function(){

    $.ajax({
            type:"POST",
            url:"/abrirCaja", 
                data:{
                        usuarioId: document.getElementById("usuarioId").value,
                        fondoInicial: document.getElementById("fondoInicial").value,
                        _token:$('input[name="_token"]').val()
                    }
            }).done(function(res){
                $('#modalAperturaCaja').modal('hide');

                if(res == 1){
                    $('#modalCajaAbiertaExitosamente').modal('show');
                }
                else{
                    $('#modalCajaAbiertaError').modal('show'); 
                }
                


            })
});


//Función para cerrar modal de caja abierta exitosamente
let botonOkCajaAbierta = document.getElementById("cerrarModalCajaAbierta");

botonOkCajaAbierta.addEventListener("click", function(){
    $('#modalCajaAbiertaExitosamente').modal('hide');

    $('#botonAbrirCaja1').hide();
    $('#botonCerrarCaja2').show();
    $('#botonVenta1').show();
    $('#botonAbrirCaja2').hide();
    
})

//Función para cerrar modal de caja abierta error
let botonOkCajaAbiertaError = document.getElementById("cerrarModalCajaAbiertaError");

botonOkCajaAbiertaError.addEventListener("click", function(){
    $('#modalCajaAbiertaError').modal('hide');
})



/*---------------- Funciones para cerrar la jornada -------------------*/

let botonCerrarJornada = document.getElementById("botonCerrarCaja");
botonCerrarJornada.addEventListener("click", function(){

    $.ajax({
            type:"POST",
            url:"/cerrarJornada", 
                data:{
                        usuarioId: document.getElementById("usuarioId").value,
                        // fondoInicial: document.getElementById("fondoInicial").value,
                        _token:$('input[name="_token"]').val()
                    }
            }).done(function(res){
                $('#modalCerrarCaja').modal('hide');

                if(res == 1){
                    $('#modalCajaCerradaExitosamente').modal('show');
                }
            })
});

//Función para cerrar modal de caja abierta error
let botonOkCajaCerrada = document.getElementById("cerrarModalCajaCerrada");

botonOkCajaCerrada.addEventListener("click", function(){
    $('#modalCajaCerradaExitosamente').modal('hide');

    $('#botonCerrarCaja2').hide();
    $('#botonVenta1').hide();
    $('#botonAbrirCaja2').show();
})

/*---------------- Funciones para abrir caja anterior -------------------*/

let botonAbrirCajaAnterior = document.getElementById("cerrarModalCajaAbiertaAnterior");

botonAbrirCajaAnterior.addEventListener("click", function(){
    
    $.ajax({
            type:"POST",
            url:"/abrirCajaAnterior", 
                data:{
                        usuarioId: document.getElementById("usuarioId").value,
                        
                        _token:$('input[name="_token"]').val()
                    }
            }).done(function(res){
                $('#modalAperturaCajaAnterior').modal('hide');

                if(res == 1){
                    $('#modalCajaAbiertaExitosamente').modal('show');
                }
                else{
                    $('#modalCajaAbiertaError').modal('show'); 
                }
                


            })
});



        </script>
@endsection