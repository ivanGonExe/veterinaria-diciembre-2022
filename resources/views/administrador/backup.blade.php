@extends('administrador.plantillaAdmin')
    
     

@section('contenido')
<style>
  
.dataTables_length {
      text-align: start !important;
}
.boton_crear{
  padding: 7px !important;
   margin: 5px !important;
}.a{
  color:white  !important;
}

td{
  text-align: center !important;
}
.boton_copia {
  color:rgb(0, 0, 0) !important;
  
}
.boton_copia:hover{
  color:rgb(40, 40, 233) !important;
}
</style>
<div class="main_content">
  <div class="content">
 
    <div class="header"><h2 class="text-dark text-center"><i class="fa-solid fa-inbox"></i> Copia de Seguridad</h2></div>    
    <div class="content text-center p-2">
      <div class="row">
          <div class="col-12 content-fluid d-flex justify-content-center p-2 "></div>
               
      </div>
      <div class="content">
      <a href="/create/backup" type="button" class="btn btn-primary rounded-pill boton_crear text-white" id="boton_crear" title="Crear Copia de Seguridad"><i class="fa-solid fa-download"></i> Crear Copia</a>
      </div>
     <div class="row" >
      <div class="col-1"></div>
      <div class="col-10">
      <div class="contenido p-4">
      <table id="example" class="table table-striped" style="width:100%">
        <thead>
           
             
              <tr >
              <th scope="col"class="text-center">N°</th>
              <th scope="col"class="text-center">Archivos</th>
              <th scope="col"class="text-center">Acción</th>
              </tr>
          </thead>
            
          <tbody>
            @php
              $i = 1;
            @endphp
            
          @foreach($archivos as $unArchivo)
                  <tr>
                      <td>{{$i++}}</td>
                      <td>{{str_replace ('.json','',$unArchivo,)}}</td>
                      <td class="acciones w-25">  
                      <a id="{{$unArchivo}}" class="btn boton_copia" value="{{$unArchivo}}" title="subir copia de seguridad" ><i class="fa-solid fa-upload"></i></a>
                      </td> 
                  </tr>
                  
                @endforeach
          </tbody>
                 </table>
            
              
      <div class="col-1"></div>
         
           <div class="row barra" ></div>
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
     "bSort": true, // Con esto le estás diciendo que se pueda ordenar, ponlo a 'true'
     "order": [[1, "desc"]], // Aquí le dices que el criterio de ordenación primero esté vació , o lo que es lo mismo, ninguno
     responsive:true, 
     "pageLength": 5,
     language: {
     url: "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
 }

 }); 




var id = 0;
        var botones = document.getElementsByClassName("boton_copia");
        var boton = [];
        let cantidad = botones.length;
              for(let i = 0; i < cantidad; i++){
                  
                  id =botones[i].id;
                  boton[i]= document.getElementById(`${id}`);
                  boton[i].addEventListener('click', function(){
                    var cod = boton[i].id;
                    Swal.fire({
                              position: "top-center",
                              icon: "success",
                              title: "Restauración de copia seguridad"+cod,
                              showConfirmButton: false,
                              timer: 5000,
                          });
                          setTimeout(() => {
                            
                              location.href="/up/Backup/"+cod;
                          }, 20);
                    })
                  }


  //------------------------------------------------------------
   document.getElementById("boton_crear").addEventListener('click', function(e) {
   e.preventDefault(); 
    Swal.fire({
            position: "top-center",
            icon: "success",
            title: "Copia de Seguridad Creada",
            showConfirmButton: false,
            timer: 4000,
        });
        setTimeout(() => {
            /* 	document.getElementById('formulario__mensaje-exito').classList.remove('formulario__mensaje-exito-activo'); */

            location.href="/create/backup";
        }, 2000);
        
});    



  </script>
  @endsection