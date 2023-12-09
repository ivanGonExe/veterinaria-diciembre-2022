
@extends('layouts.plantillaBase2')


@section('contenido')
@php 
    $añoActual=Carbon\Carbon::now()->format('Y');
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
    <div class="row">
        <div class="col-12 p-2 "></div>
        <div class="col-12 p-2"><h4 class="text-center">  Ganancias anuales </h4></div>
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
<canvas id="myChart" width="50%" height="50%"></canvas>
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
            borderWidth: 1,
        
        }]
    },
    options: {
     
     indexAxis: 'x',
     x: {
             grid: {
               offset: true
             }
         }
   
     } 
  
});
</script>



@endsection


