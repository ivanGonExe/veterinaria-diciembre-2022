@extends('administrador.plantillaAdmin')





@section('contenido')

<div class="main_content">
        <div class="content">
       
          <div class="header"><h2 class="text-dark fw-bold text-center">Noticias</h2></div>    
         
          <div class="content text-center p-2">
            <div class="row">
                <div class="col-12 content-fluid d-flex justify-content-center p-2 "></div>
       
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="{{ route('create') }}" class="btn btn-primary btn-sm mb-2">+ Crear Posteo</a>
            <br>
            <br>
            <table id="example" class="table table-striped table-bordered nowrap" style="width:100%">
                <thead>
                  <tr>
                   
                    <th scope="col">Fecha</th>
                    <th scope="col">Titulo</th>
                    <th scope="col">Asunto</th>
                    <th scope="col">Acciones</th>
                  </tr>
                </thead>
                <tbody>
                 
                    @php
                        $no = 0;
                    @endphp
                  @if($data->isEmpty())
                  
                  <th colspan="3"><p class="text-center">no hay dato</p> </th>
                  @else 
                  @foreach ($data as $data)
                   <tr> 
                   
                    <td>{{ $data->fecha }}</td>
                    <td>{{ $data->titulo }}</td>
                    
                    <td>{!! Str::limit( strip_tags( $data->asunto ), 50 ) !!}</td>
                    <td><button class="btn btn eliminar" title="Eliminar" id="{{$data->id}}" value= '{{$data->id}}'><i class="fa-solid fa-trash-can"></i></button>
                    
                    <a href="/editarNoticia/{{$data->id}}" name="Editar" class="btn btn " title="Editar"><i class="fa-solid fa-pen-to-square"></i></a>

                  </td>
                  </tr>
                    @endforeach 
                  @endif

                </tbody>
              </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

<script>
  $(document).ready(function() {
    var table = $('#example').DataTable( {
        responsive: true
    } );
 
    new $.fn.dataTable.FixedHeader( table );
} );
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
                       title: 'Esta Seguro que desea Borrar?',
                       text: "confirme la decisión!",
                       icon: 'warning',
                       showCancelButton: true,
                       confirmButtonColor: '#3085d6',
                       cancelButtonColor: '#d33',
                       confirmButtonText: 'Si, eliminar'

                    }).then((result) => {
                if (result.isConfirmed) {
                   
                  
                  location.href = '/eliminarNoticia/'+cod; 

               
                     }
                   })

                });

               }
});




</script>





@endsection
 

