
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
       color:rgb(255, 255, 255); 
    }
   /*  .barra{
   
        background:rgb(0, 0, 0,0.8); 
    } */
    body{
	
	background-color:rgb(255, 255, 255) !important; 

}
.titulo{
    margin-left: 50px !important;
    padding: 10px !important;
}
 </style>
<title>Estadisticas</title>
<div class="container">
    <div class="row ">
       
      
        <div class="text-center titulo" ><h4>Articulos más vendidos en el mes </h4></div>
                 <div class="col text-center">
            <a class="btn" id="menosAnio" href="/estadistica/articulos/MasVendidos/{{$mes-1}}"><i class="fa-regular fa-circle-left"></i></a></a>
            <div class="btn" id="mes">{{$fecha}}</div>
            <a class="btn" id="masAnio" href="/estadistica/articulos/MasVendidos/{{$mes+1}}"><i class="fa-regular fa-circle-right"></i></a></a>
          
    </div>
</div>

<div class="row">
    <div class="col-4"></div>
    <div class="col-5">
    <canvas id="myChart" ></canvas>
    </div>
    <div class="col-3"></div>
    <div class="row p-1"></div>
    

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
Chart.defaults.font.size = 15;

const myChart  = new Chart(ctx, {
   type: 'pie',
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
        fontSize: 5,
    indexAxis: 'y',
    }
  
});
</script>



@endsection


