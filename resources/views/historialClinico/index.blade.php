@extends('layouts.plantillaBase')
<style>

    table th{
        background-color: rgba(100, 83, 153, 1) !important;
        color:#ffffff;
        text-align: center;
    }
    table tr{
        background-color: rgb(255, 255, 255,1) !important;
        color:#000000;
        text-align: center;
    }

    </style>
@section('contenido')

<div class="container-fluid d-flex justify-content-center .boton_crear text-light">
    <h2 class="text-center p-2 m-2  fw-bold text-dark" >Listado de historiales clínicos</h2>
</div>
   

<table id="example" class="table table-striped" style="width:100%">
        <thead >
            <tr >
                <th scope="col" class="text-center">Id</th>
                <th scope="col" class="text-center">Mascota</th>
                <th scope="col" class="text-center">Raza</th>
                <th scope="col" class="text-center">Dueño</th>
                <th scope="col" class="text-center">Acciones</th>
            </tr>
        </thead>

        <tbody >
            @foreach($historiales as $unHistorial)
                <tr>
                    <td>{{$unHistorial->id}}</td>
                    <td>{{$unHistorial->mascota->nombre}}</td>
                    <td>{{$unHistorial->mascota->raza}}</td>
                    <td>{{$unHistorial->mascota->persona->nombre." ".$unHistorial->mascota->persona->apellido }} </td>
                    <td>
                            <input type="hidden" name="urlAnterior" value="{{Request::path()}}">
                            <a href="{{ route('historialesClinicos.show',$unHistorial->id)}}" class="btn" title="Ver Historia Clinica" ><i class="fa-solid fa-clipboard"></i></a>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>

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
     </script>

@endsection