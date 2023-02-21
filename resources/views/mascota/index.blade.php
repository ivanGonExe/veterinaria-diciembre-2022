@extends((auth()->user()->tipo == 'admin')? ((auth()->user()->estadoIngreso =='veterinario')? 'layouts.plantillaBase':'layouts.plantillaBase3') : ( (auth()->user()->tipo == 'veterinario')? 'layouts.plantillaBase' :'layouts.plantillaBase3'))


@section('contenido')

<style>


.eliminar{
    padding: 5px!important;
 margin: 0 0px 6px 0!important;
 color: red;
}
.historial{
    padding: 5px!important;
 margin: 5px!important;
 color: #000000;
}
.editar{
    padding: 5px!important;
 margin: 5px!important;
 color: #000000;
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
  

</style>

<div class="container-fluid d-flex justify-content-center  text-light">
        
        <h3 class="text-center p-2 m-2 fw-bold text-dark" >Listado de Mascotas</h3><br>
     
      
    </div>

    @isset($persona)
        <a href="/mascotas/create/{{$persona->id}} " type="button" class="btn btn-primary rounded-pill  p-2" title="Nuevo mascota">+ Mascota <i class="fa-solid fa-dog"></i></a>
        <p class="text-center p-2 m-2 fs-3 fw-bold text-dark" >Cliente: {{$persona->nombre}} {{$persona->apellido}} </p>  
    @endisset
    <table id="example" class="table table-striped text-center" style="width:100%">
        
   
        <thead>
            
            
            <tr>
                <th scope="col" class="text-center">Nombre</th>
                <th scope="col" class="text-center" >Raza</th>
                <th scope="col" class="text-center">Especie</th>
                <th scope="col" class="text-center">Color</th>
                <th scope="col" class="text-center">Sexo</th>
                <th scope="col" class="text-center">Esterilizado</th>
                <th scope="col" class="text-center">Fecha nacimiento</th>
               {{--  <th scope="col">Dueño</th> --}}
                <th scope="col">Acciones</th>
            </tr>
        </thead>

        <tbody>
        @foreach($mascotas as $unaMascota) 
                <tr style="text-align:left">
                    <td >{{$unaMascota->nombre}}</td>
                    <td >{{$unaMascota->raza}}</td>
                    <td >{{$unaMascota->especie}}</td>
                    <td >{{$unaMascota->color}}</td>
                    <td >{{$unaMascota->sexo}}</td>
                    <td>{{$unaMascota->esterilizado}}</td>
                    <td >{{\Carbon\Carbon::parse($unaMascota->anioNacimiento)->format('d-m-Y')}}</td>
        
{{--                     <td>{{$unaMascota->persona->nombre." ".$unaMascota->persona->apellido}}</td> --}}
                    <td>
                         <div class="acciones">
                            <input type="hidden" name="urlAnterior" value="{{Request::path()}}">
                            @if ((auth()->user()->tipo == 'veterinario') or (auth()->user()->estadoIngreso =='veterinario') )
                            <a href="/historialesClinicos/{{$unaMascota->historialClinico->id}}"  title="Ver historial clinico" class="historial"><i class="fa-solid fa-notes-medical"></i></a>
                            @endif
                            <a href="/mascotas/{{$unaMascota->id}}/edit"  title="Editar" class="editar"><i class="fa-solid fa-pen-to-square"></i></a>
                            
                            <button class="btn btn eliminar" title="Eliminar" id="{{$unaMascota->id}} " value= '{{$unaMascota->id}}'><i class="fa-solid fa-trash-can"></i></button>
                         </div>
                        </form>
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
                            title: '¿ Esta Seguro que desea Borrar?',
                            text: "confirme la decisión!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'aceptar',
                            cancelButtonText: 'cancelar'
  
                         }).then((result) => {
                     if (result.isConfirmed) {
                         location.href = '/mascotas/'+cod+'/delete'; 

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