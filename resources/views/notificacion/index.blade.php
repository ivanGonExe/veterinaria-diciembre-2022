@extends('layouts.plantillaBase2')


<style>

    .modal-body{
        background-color: rgba(100, 83, 153, 1) !important;
    }
    
    table.dataTable td {
      text-align: center;
    }
    table.dataTable tr {
      text-align: center;
    }
    table.dataTable th {
      text-align: center;
    }
    .whatsapp{
    
    color:#00b460 !important;
    font-size: 18px;
    
    
    }
    .btn.btn.eliminar{
      color: red;
    }
</style>

@section('contenido')

<div class="caja_tabla-2">
    <div class="container-fluid d-flex justify-content-center">

        <h2 class="text-center p-2 m-2 fs-1 fw-bold text-dark" >Notificación de stock</h4>
    
    </div>

    </div>
    
        <table id="example" class="table table-striped" style="width:100%">
        <thead>
           
            <tr>
                <th scope="col" class="text-center">Fecha </th>
                <th scope="col"class="text-center">descripción</th>
                <th scope='col'class="text-center">unidades restantes</th>
                <th scope="col"class="text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
        
            @foreach($notificaciones as $unaNotificacion)
                    <td>{{$unaNotificacion->created_at}}</td>
                    <td>{{$unaNotificacion->descripcion}}</td>
                    <td><strong>{{$unaNotificacion->unidades}}</strong></td>
                    <td>
                    <button class="btn btn eliminar" title="Eliminar" id="{{$unaNotificacion->id}}" value= '{{$unaNotificacion->id}}'><i class="fa-solid fa-trash-can"></i></button>
                            
                    </td>
                </tr>
            @endforeach

        </tbody>
    
    
    </table>
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


        $(document).ready(function (){
 var id = 0;
        var botones = document.getElementsByClassName("eliminar");

        var boton = [];
        
         let cantidad = botones.length;
              for(let i = 0; i < cantidad; i++){
                  //botones[i].addEventListener('click', () => {
                  id = botones[i].id;
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
                        
                         location.href = '/notificacion/'+cod+'/delete'; 

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



        </script>
@endsection        

