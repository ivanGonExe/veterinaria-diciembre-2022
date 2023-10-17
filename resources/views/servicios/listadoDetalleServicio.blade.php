@extends('layouts.plantillaBase3')
@section('contenido')
<style>

table th{
    background-color: rgb(255, 255, 255,1) !important;
    color:#000000;
}
table tr{
    background-color: rgb(37, 95, 255,0.3) !important;
    color:#000000;
}

table td{
    background-color: rgb(255, 255, 255,1) !important;
    color:#000000;
}
.form-label{
    color:black !important;
}

</style>
<link rel="stylesheet" type="text/css" href="{{asset('estiloControl.css')}}">


   
    @php
        $urlAnterior= url()->previous();
    @endphp
  
    <div class="row m-2 p-2">
    <div class="col-4 text-center pt-2"><img src="../iconos/banio.png" alt="emergencias" height="160" width="160" class="iconos" id="boton"> </div>
    <div class="col-4 text-center pt-5"><h1>Historial de servicios</h1></div>

    <div class="mb-3">
            <label for="" class="form-label aligne"><i class="fa-regular fa-calendar-days"></i>  Selecionar Fecha</label><br>
            <input type="date" id='fecha' name="fecha" title="fecha" value='{{$fecha}}'required >
        </div>
   <div class="table-responsive table-striped tabla_historia" style="width:100%">
  
    <table class="table table-bordered  table-hover">
        <thead class="bg-secondary text-white">
        
        <tbody>     
            <thead>
                <tr class="text-center titulo">
                    <td colspan="3" class="bg-info"></td>
                </tr>  
            </thead>  

            <br>
            </table>
            @php
                $items = count($historialServicios);
            @endphp
            @if(count($historialServicios) <= 0)
                <h4 class="text-center">No tiene detalles de servicios en la fecha</h4>
            @else 
        @foreach($historialServicios as $unDetalle ) 
            <table class="table table-bordered  table-hover" >
                <thead class="bg-secondary text-white">
                 
            <tr>
               
                <th><i class="fa-regular fa-circle"></i> N° de item servicio: {{$items}}<span class="text-danger fw-bold fs-5">{{$unDetalle->id}}</span> </th> <th>Fecha: {{$unDetalle->created_at->format('d-m-Y')}} </th></td><th>Hora: {{$unDetalle->created_at->format('H:i')}} </th></td>
              
            </tr> 
            <tr>
                <th> Cliente:  <span class="text-danger fw-bold fs-8  ">{{$unDetalle->nombre_cliente}} {{$unDetalle->apellido_cliente}}</span> </th> <th>Mascota: {{$unDetalle->nombre_mascota}} </th></td><th>Raza: {{$unDetalle->raza}} </th></td>
            </tr>   
         
            <tr>
                <th>Tipo de servicio: </th><td colspan="2" >{{$unDetalle->tipo}}</td>
            </tr>   
            <tr>
               
                <th>Descripción:</th><td colspan="2" >{{$unDetalle->descripcion}}</td>
            </tr>  
            
            </table>                 
        </tbody>    
    </table>
    @php
        $items = $items-1;
    @endphp
    @endforeach
@endif
<script>
    let inputFecha = document.getElementById('fecha');
        inputFecha.addEventListener('change', function(){
            location.href = "/listaServiciosAplicados/"+inputFecha.value; 
        });
</script>

@endsection