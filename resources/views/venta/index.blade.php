@extends('layouts.plantillaBase2')

<style>
    table.dataTable td {
        text-align: center;
    }

    table.dataTable tr {
        text-align: center;
    }

    table.dataTable th {
        text-align: center;
    }
</style>
<!-- html--------------------------------------------------------------------------------------------------------------------------------------------------------- -->
@section('contenido')

<div class="caja_tabla-2">
    <div class="container-fluid d-flex justify-content-center  text-light">
        <h2 class="text-center p-2 m-2 fs-1 fw-bold text-dark" >Historial de Ventas</h2>
    </div>
    <a href="ventas/create" type="button" class="btn btn-primary rounded-pill m-2 p-2" title="Nueva venta">+ Venta <i class="fa-solid fa-cash-register"></i></a>
</div>
  
    <table id="example" class="table table-striped" style="width:100%">           
        <thead>           
            <tr> 
                <th scope="col"  class="text-center">Fecha           </th>
                <th scope="col"  class="text-center">Total           </th>
                <th scope="col"  class="text-center">Monto pagado    </th>
                <th scope="col"  class="text-center">Tipo de pago    </th>
                <th scope="col"  class="text-center">Detalle de Venta</th>
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
                        <a href="{{ route('ventas.show', $unaVenta->id)}}" name="ver" class="btn  detalle" title="Ver detalle de una venta"><i class="fa-solid fa-file-lines"></i></a>  
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

<!-- librerias script--------------------------------------------------------------------------------------------------------------------------------------------------------- -->
   <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   <script src="  https://code.jquery.com/jquery-3.5.1.js"></script>
   <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
   <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function () {

           $('#example').DataTable();
    });
    $('#example').DataTable({
        "bSort": true, // Con esto le estás diciendo que se pueda ordenar, ponlo a 'true'
        "order": [], // Aquí le dices que el criterio de ordenación primero esté vació , o lo que es lo mismo, ninguno
        language: {
            url: "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
        }
    }); 
</script>

{{-- /*------------------------------------------------ */ --}}
<script>
    

        var id       = 0;
        var botones  = document.getElementsByClassName("eliminar");
        var boton    = [];
        let cantidad = botones.length;

        for(let i = 0; i < cantidad; i++){
            
            id       = botones[i].id;
            boton[i] = document.getElementById(`${id}`);
                
            boton[i].addEventListener('click', function(){
                
                var cod = boton[i].value;
                Swal.fire({
                    title:              'Esta Seguro que desea Borrar?',
                    text:               "confirme la decisión!",
                    icon:               'warning',
                    showCancelButton:    true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor:  '#d33',
                    confirmButtonText:  'Si, eliminar'
  
                }).then((result) => {

                    if (result.isConfirmed) {
                        
                        location.href = 'ventas/'+cod+'/delete';
                    }
                })
            });
        }
    
</script>
@endsection