

@extends((auth()->user()->tipo == 'admin')? ((auth()->user()->estadoIngreso =='veterinario')? 'layouts.plantillaBase':'layouts.plantillaBase3') : ( (auth()->user()->tipo == 'veterinario')? 'layouts.plantillaBase' :'layouts.plantillaBase3'))

<!-- <style>

body{
	min-height: 150vh;
	background-image: linear-gradient(120deg, #ffffff, #8e44ad);
}

/* table th{
    background-color: rgba(100, 83, 153, 1) !important;
    color:#ffffff;
}
table td{
    background-color: rgba(66, 6, 244, 0.1) !important;
    color:#000000;
} */
.caja_tabla-2{

    margin: 15px;
}
.boton_crear{
    background-color: rgba(100, 83, 153, 1) !important;
    color:#ffffff;
 
}
</style> -->

@section('contenido')


<div class="caja_tabla-2">
    <div class="container-fluid d-flex justify-content-center  text-light">
        <h2 class="text-center p-2 m-2 fs-1 fw-bold text-dark" >Listado de Clientes</h2>
    {{-- <a href="personas/create" class="btn btn-light boton_crear">Crear</a> --}}
    </div>
    <a href="/personas/create" type="button" class="btn btn-primary rounded-pill m-2 p-2" title="Nuevo cliente">+ Cliente <i class="fa-solid fa-person"></i></a>
    </div>
  
    <table id="example" class="table table-striped" style="width:100%">
           
        <thead>
           
            <tr>
                
                <th scope="col">Nombre</th>
                <th scope="col">Apellido</th>
                <th scope="col">Dni</th>
                <th scope="col">Dirección</th>
                <th scope="col">Teléfono</th>
                <th scope="col">Mascota</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>

        <tbody>
            @foreach($personas as $unaPersona)
                <tr>
                    
                    <td>{{$unaPersona->nombre}}</td>
                    <td>{{$unaPersona->apellido}}</td>
                    <td>{{$unaPersona->dni}}</td>
                    <td>{{$unaPersona->direccion}} {{$unaPersona->numeroCalle}}</td>
                    <td>{{$unaPersona->telefonos->codigoArea}}{{$unaPersona->telefonos->numero}}</td>
                    <td class="text-start"><a href="{{ route('verMascotas', $unaPersona->id)}}" name="mascota" class="btn btn" title="Ver Mascotas"><i class="fa-solid fa-dog"></i></a> </td>
                    <td>
                        
                            
                            <a href="/personas/{{$unaPersona->id}}/edit" name="Editar" class="btn btn " title="Editar"><i class="fa-solid fa-pen-to-square"></i></a>
                        
             
                  
                            <button class="btn btn eliminar" title="Dar de Baja"  id="{{$unaPersona->id}}" value= '{{$unaPersona->id}}'><div class="text-danger"><i class="fa-solid fa-trash-can"></i></div></button>
                      
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
                  id =botones[i].id;
                  //console.log(id);
                  boton[i]= document.getElementById(`${id}`);
                
                  boton[i].addEventListener('click', function(){

                         var cod = boton[i].value;
                         

                        Swal.fire({
                            title: '¿Esta seguro que desea dar de baja al cliente?',
                            text: "confirme la decisión",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'aceptar',
                            cancelButtonText: 'cancelar'
  
                         }).then((result) => {
                            if (result.isConfirmed) {
                                
                                let objeto = {
                                    idPersona: cod, 
                                }; 

                                enviarConsulta(objeto, token);
                            }
                        })

                     });

                    }

    async function enviarConsulta(objeto, token){
        const respuesta = await fetch('/personas/deshabilitar', {
                method: 'POST',
                mode: 'cors',
            headers:{
                'X-CSRF-TOKEN': token,
                'Content-Type': 'application/json'
            },
            
            body: JSON.stringify(objeto),
        });


        const data = await respuesta.json();

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