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
    <div class='container'>
        <a type=""class="btn btn-secondary rounded-pill m-1 p-2"  id="botonVolver" href="{{$url}}"><i class="fa-solid fa-arrow-rotate-left"></i></a>
        <a href="/mascotas/create/{{$persona->id}} " type="button" class="btn btn-primary rounded-pill  p-2" title="Nuevo mascota">+ Mascota <i class="fa-solid fa-dog"></i></a>
        <p class="text-center p-2 m-2 fs-3 fw-bold text-dark" >Cliente: {{$persona->nombre}} {{$persona->apellido}} </p>  
    </div>  
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
        
                    <td>
                        <div class="acciones">
                            <input type="hidden" name="urlAnterior" value="{{Request::path()}}">
                            @if ((auth()->user()->tipo == 'veterinario') or (auth()->user()->estadoIngreso =='veterinario') )
                                <a href="/historialesClinicos/{{$unaMascota->historialClinico->id}}"  title="Ver historial clinico" class="historial"><i class="fa-solid fa-notes-medical"></i></a>
                            @else 
                            <a href="/historialServicios/{{$unaMascota->historialServicio->id}}"  title="Ver historial de servicios" class="historial"><i class="fa-solid fa-scissors"></i></a>
                            @endif
                            <a href="/mascotas/{{$unaMascota->id}}/edit"  title="Editar" class="editar"><i class="fa-solid fa-pen-to-square"></i></a>
                            
                            <button class="btn btn eliminar" title="Eliminar" id="{{$unaMascota->id}} " value= '{{$unaMascota->id}}'><i class="fa-solid fa-trash-can"></i></button>
                        </div>
                    </td>
                </tr>
            @endforeach
            <meta name="csrf-token" content="{{ csrf_token() }}">
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
        var botones = document.getElementsByClassName("eliminar");

        var boton = [];

        let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
         let cantidad = botones.length;
              for(let i = 0; i < cantidad; i++){
                  //botones[i].addEventListener('click', () => {
                  id = botones[i].id;
                  //console.log(id);
                  boton[i]= document.getElementById(`${id}`);
                
                  boton[i].addEventListener('click', function(){
                    
                         var cod = boton[i].value;

                        Swal.fire({
                            title: '¿ Esta Seguro que desea dar de baja la mascota?',
                            text: "confirme la decisión!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'aceptar',
                            cancelButtonText: 'cancelar'
  
                         }).then((result) => {
                            if(result.isConfirmed){
                                
                                let objeto = {
                                    idMascota: cod, 
                                }; 

                                enviarConsulta(objeto, token);
                            }
                        })

                  });

              }
            
async function enviarConsulta(objeto, token){
    const respuesta = await fetch('/mascotas/deshabilitar', {
            method: 'POST',
            mode: 'cors',
        headers:{
            'X-CSRF-TOKEN': token,
            'Content-Type': 'application/json'
        },
        
        body: JSON.stringify(objeto),
    });


    const data = await respuesta.json();
        console.log(data);

        if(data["valido"]){ 
            Swal.fire({
                position: "top-center",
                icon: "success",
                title: data["valido"],
                showConfirmButton: false,
                timer: 4000,
            });
                
            setTimeout(() => {
                location.reload()
            }, 4000);
                
        }

        if(data["errores"]){ 
            Swal.fire({
                position: "top-center",
                icon: "success",
                title: "¡Error inesperado!",
                showConfirmButton: false,
                timer: 4000,
            });
        }
        
    }









     </script>


@endsection