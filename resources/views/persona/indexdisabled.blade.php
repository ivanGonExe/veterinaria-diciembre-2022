@extends((auth()->user()->tipo == 'admin')? ((auth()->user()->estadoIngreso =='veterinario')? 'layouts.plantillaBase':'layouts.plantillaBase3') : ( (auth()->user()->tipo == 'veterinario')? 'layouts.plantillaBase' :'layouts.plantillaBase3'))


@section('contenido')


<div class="caja_tabla-2">
    <div class="container-fluid d-flex justify-content-center  text-light">
        <h2 class="text-center p-2 m-2 fs-1 fw-bold text-dark" >Listado de Clientes inactivos</h2>
        </div>
        </div>
    <table id="example" class="table table-striped" style="width:100%">
           
        <thead>
           
            <tr>
                {{-- <th scope="col">Id</th> --}}
                <th scope="col">Nombre</th>
                <th scope="col">Apellido</th>
                <th scope="col">Dni</th>
                <th scope="col">Dirección</th>
                <th scope="col">Teléfono</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>

        <tbody>
            @foreach($personas as $unaPersona)
                <tr>
                    {{-- <td>{{$unaPersona->id}}</td> --}}
                    <td>{{$unaPersona->nombre}}</td>
                    <td>{{$unaPersona->apellido}}</td>
                    <td>{{$unaPersona->dni}}</td>
                    <td>{{$unaPersona->direccion}}</td>
                    <td>{{$unaPersona->telefonos->codigoArea}}{{$unaPersona->telefonos->numero}}</td>
                    <td>   
                    <button class="btn btn recuperar" title="Recuperar"  id="{{$unaPersona->id}}" value= '{{$unaPersona->id}}'><div class="text-success"><i class="fa-solid fa-user-plus"></i></div></button>
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

/*------------------------------------------------ */

 var id = 0;
        var botones = document.getElementsByClassName("recuperar");
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
                            title: '¿ Está Seguro que desea recuperar el cliente?',
                            text: "confirme la decisión!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'aceptar',
                            cancelButtonText: 'cancelar'
  
                         }).then((result) => {
                     if (result.isConfirmed) {

                         location.href = '/personas/'+cod+'/habilitar'; 

                         /*  Swal.fire(
                        'Eliminado',
                        'Your file has been deleted.',
                        'success'
                        ) */
                          }
                        })

                     });

                    }





        </script>
@endsection