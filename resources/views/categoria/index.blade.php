@extends('layouts.plantillaBase2')


<style>
.boton_crear {

border-radius: 20px !important;

}
table th{
    background-color: rgba(100, 83, 153, 1) !important;
    color:#ffffff;
    text-align: center;
}
table td{
    background-color: rgba(100, 83, 153, 0.1) !important;
    color:#000000;
    text-align: center;
}
.caja_tabla-2{

    margin: 15px;
}
.btn.btn.eliminar{
  color: red;
}
.eliminar:hover{
  color:#000000 !important; 
}

</style>

@section('contenido')






<div class="caja_tabla-2">
    <div class="container-fluid d-flex justify-content-center">
        <h2 class="text-center p-2 m-2 fs-1 fw-bold text-dark" >Listado de Categorías</h2>
    </div>

    
    <a href="/categorias/create" type="button" class="btn btn-primary  boton_crear" title="crear nueva categoria">+ Crear categoria <i class="fa-solid fa-list"></i></a>
    </div>
    
        <table id="example" class="table table-striped" style="width:100% ">
        <thead>
           
            <tr>
                <th class=" text-center">Descripcion</th>
                <th class=" text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categorias as $unaCategoria)
                <tr>
                    <td>{{$unaCategoria->descripcion}}</td>
                    
                    <td>    
                        <a href="/categorias/{{$unaCategoria->id}}/edit " name="Editar" class="btn " title="Editar"><i class="fa-solid fa-pen-to-square"></i></a>
                        <a href="/quitarUnaCategoria/{{$unaCategoria->id}}" name="delete" class="btn eliminar" title="delete"><i class="fa-solid fa-trash-can"></i></a> 
                        
                    </td>
                </tr>
            @endforeach

        </tbody>
    
    
    </table>
    </div>


    

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

