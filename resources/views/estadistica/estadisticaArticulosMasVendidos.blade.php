
@extends('layouts.plantillaBase2')


@section('contenido')
@php 
    $añoActual=Carbon\Carbon::now()->format('Y');
    $mesActual=Carbon\Carbon::now()->format('m');
@endphp

 <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
<style>
    .fa-regular{
       padding: 10px;
       background:rgb(0, 0, 0,1); 
       border-radius: 60px;
       color:rgb(255, 252, 252); 
    }
   /*  .barra{
   
        background:rgb(0, 0, 0,0.8); 
    } */
    body{
	min-height: 150vh;
	background-image: linear-gradient(120deg, #ffffffae, #ffffff);
}
.barra{
    padding: 1px;
    width: 100%;
    height: 4px;
  
 background-color:#a2a0a0;
 

}
 </style>
<title>Estadisticas</title>
<div class="container bg-white m-1 p-1">
    <div class="row text-center">
       
        <div class="col-12 p-2"></div>
        <div class="col-12 p-2 m-2"><h4>Articulos más vendidos en el mes </h4></div>
        <div class="col-12 p-2"></div>

        <div class="col-2"> </div>
        <div class="col-8 p-2">
            <a class="btn" id="menosAnio" href="/estadistica/articulos/MasVendidos/{{$mes-1}}"><i class="fa-regular fa-circle-left"></i></a></a>
            <div class="btn" id="mes">{{$fecha}}</div>
            <a class="btn" id="masAnio" href="/estadistica/articulos/MasVendidos/{{$mes+1}}"><i class="fa-regular fa-circle-right"></i></a></a>
     
        <div class="col-2"> </div>
       
        <div>
    </div>
</div>

<p class="barra"><br></p>
<div class="row">
<div class="col-2"></div>
<div class="col-8"><div class="container">
<canvas id="myChart" width="60%" height="20%"></canvas>
</div></div>
<div class="col-2"></div>

<script>
    let botonMas  = document.getElementById('masAnio');
    let mes       = @json($mes);
    let mesActual = @json($mesActual)-1+1;
    
    mes++;
    if( mes >= mesActual){
        botonMas.style.display ='none';
    }

    let botonMenos  = document.getElementById('menosAnio');
    if( mes==2){
        botonMenos.style.display ='none';}
</script>



<script>

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
            label: 'Nº de Unidades Vendidas ',
            data: arreglo,
            backgroundColor: [
                'rgba(255, 99, 132, 0.8)',
                'rgba(154, 162, 235, 0.8)',
                'rgba(255, 206, 86, 0.8)',
                'rgba(175, 12, 192, 0.8)',
                'rgba(153, 102, 25, 0.8)',
                'rgba(255, 159, 64, 0.8)',
                'rgba(275, 42, 192, 0.8)',
                'rgba(153, 52, 255, 0.8)',
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1,
        
        }]
    },
    options: {
        fontSize: 10,
    indexAxis: 'y',
    }
  
});
</script>



@endsection


