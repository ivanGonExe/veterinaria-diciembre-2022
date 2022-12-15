
@extends('layouts.plantillaBase2')


@section('contenido')
@php 
    $añoActual=Carbon\Carbon::now()->format('Y');
@endphp

 <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
<style>
 .fa-regular{
    padding: 10px;
    background:rgb(0, 0, 0,0.8); 
    border-radius: 60px;
    color:#ffffff;
 }
 .barra{

    background-color: rgb(235, 34, 58) !important;
 }

</style>
<title>Estadisticas</title>
<div class="container bg-white m-1 p-1">
    <div class="row">
        <div class="col-12 p-2 "><h2 class="text-center">  Ventas del Año </h2></div>
        <div class="col-12 p-2"></div>
        <div class="col-2"></div>
        <div class="col-8 text-center">
            <a class="btn " id="menosAnio" href="/estadistica/ganancia/por_mes/{{$año-1}}"><i class="fa-regular fa-circle-left"></i></a>
            <div class="btn fs-2" id="anio">{{$año}}</div>
            <a class="btn" id="masAnio" href="/estadistica/ganancia/por_mes/{{$año+1}}"><i class="fa-regular fa-circle-right"></i></a>
        </div>
        <div class="container-fluid d-flex justify-content-end ">
        <div class="col-2 "> 
                     <div class="input-group">
            <input type="number" id="inputAño" placeholder="ingresar año" min="1990" max ="{{$añoActual}}"class="form-control"> 
            <button class="btn btn-dark" id="buscar" tite="buscar"  ><i class="fa-sharp fa-solid fa-magnifying-glass" title="utilizar valores positivos"></i></button> 
            </div>
            </div>
        </div> 
        <br>  
        
   
        <div>
    </div>
</div>
<br>  
<p class="barra"><br></p>
<div class="row">
<div class="col-2"></div>
<div class="col-8"><div class="container">
<canvas id="myChart" width="100%" height="100%"></canvas>
</div></div>
<div class="col-2"></div>



<script>

var botonBuscar = document.getElementById('buscar');
botonBuscar.addEventListener('click',function(){
    var inputAño = document.getElementById('inputAño');
    if(inputAño.value>1990){
        location.href ='/estadistica/ganancia/por_mes/'+inputAño.value;
    }
   
   
   
})



let arregloAux = @json($arreglo);
let arreglo    = Object.values(arregloAux);
let salida     = @json($labels);
const ctx      = document.getElementById('myChart').getContext('2d');
Chart.defaults.font.size = 21;
const myChart  = new Chart(ctx, {
   type: 'bar',
    data: {
        labels:@json($labels),
        datasets: [{
            label: 'Ganancia en pesos($) '+@json($año),
            data: arreglo,
            backgroundColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(75, 142, 192, 1)',
                'rgba(153, 152, 255, 1)',
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 3,
        
        }]
    },
    options: {
        
    indexAxis: 'x',
    }
  
});
</script>



@endsection


