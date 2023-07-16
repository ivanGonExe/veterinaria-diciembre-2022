
@extends((auth()->user()->tipo == 'admin')? ((auth()->user()->estadoIngreso =='veterinario')? 'layouts.plantillaBase':'layouts.plantillaBase3') : ( (auth()->user()->tipo == 'veterinario')? 'layouts.plantillaBase' :'layouts.plantillaBase3'))



@section('contenido')
@php 
    $añoActual=Carbon\Carbon::now()->format('Y');
@endphp

 <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.0.0/chartjs-plugin-datalabels.min.js" integrity="sha512-R/QOHLpV1Ggq22vfDAWYOaMd5RopHrJNMxi8/lJu8Oihwi4Ho4BRFeiMiCefn9rasajKjnx9/fTQ/xkWnkDACg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<title>Estadisticas</title>
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
   <body>
   <div class="container ">
    <div class="row">
        <div class="col-12 p-2 m-2"><h4 class="text-center">  Clientes Nuevos</h4></div>
        <div class="col-12 p-2"></div>
        <div class="col-2"></div>
        <div class="col-8 text-center">
            <a class="btn" id="menosAnio" href="/estadistica/clientesNuevosPorMes/{{$año-1}}"><i class="fa-regular fa-circle-left"></i></a>
            <div class="btn" id="anio">{{$año}}</div>
              <a class="btn" id="masAnio" href="/estadistica/clientesNuevosPorMes/{{$año+1}}"><i class="fa-regular fa-circle-right"></i></a>
        </div>
        <div class="container-fluid d-flex justify-content-end ">
            <div class="col-2 "> 
                         <div class="input-group">
                <input type="number" id="inputAño" placeholder=" " min="1990" max ="{{$añoActual}}"class="form-control"> 
                <button class="btn btn-dark" id="buscar" tite="buscar"  ><i class="fa-sharp fa-solid fa-magnifying-glass"></i></button> 
                </div>
                </div>
            </div> 
   {{--      
        <div class="col-1">
            <input type="number" id="inputAño" min="1990" max ="{{$añoActual}}"class="form-control">
           
        </div>
        <div class="col-1">
            <button class="btn" id="buscar">Buscar</button> 
        </div>
        <div>
    </div> --}}
</div>

<br>  
<p class="barra"><br></p>
<div class="row">
<div class="col-3"></div>
<div class="col-6"><div class="container">
<canvas id="myChart" width="50%" height="50%"></canvas>
</div></div>
<div class="col-3"></div>

</body>


<script>

var botonBuscar = document.getElementById('buscar');
botonBuscar.addEventListener('click',function(){
    var inputAño = document.getElementById('inputAño');
    location.href ='/estadistica/clientesNuevosPorMes/'+inputAño.value;
    
})



let arregloAux = @json($arreglo);
let arreglo    = Object.values(arregloAux);
let salida     = @json($labels);
const ctx      = document.getElementById('myChart').getContext('2d');
Chart.defaults.font.size = 18;
const myChart  = new Chart(ctx, {
   type: 'pie',
    data: {
        labels:@json($labels),
       
        datasets: [{
            label: /* 'Estadisticas del año '+@json($año), */'Nº de Personas Nueva',
            data: arreglo,
          
            backgroundColor: [
                'rgba(255, 255, 0, 1)',
                    'rgba(0, 128, 0, 1)',
                    'rgba(102, 205, 170, 1)',
                    'rgba(255, 165, 0, 1)',
                    'rgba(221, 160, 221, 1)',
                    'rgba(255, 0, 0, 1)',
                    'rgba(0, 0, 255, 1)',
                    'rgba(128, 0, 128, 1)',
                    'rgba(0, 255, 255, 1)',
                    'rgba(128, 128, 128, 1)',
                    'rgba(255, 192, 203, 1)',
                    'rgba(0, 0, 0, 1)',

            ],
            // borderColor: [
            //     'rgba(255, 99, 132, 1)',
            //     'rgba(0, 0, 255, 1)',
            //     'rgba(128, 0, 128, 1)',
            //     'rgba(0, 255, 255, 1)',
            //     'rgba(128, 128, 128, 1)',
            
            // ],
            // borderWidth:1,
            // borderColor:'#fff',
        
        }]
   
    },

   
    options: {
    plugins:{
       tooltip:{

        enabled: true
       },
            datalabels:{
                    formatter:(value,context)=>{
                        // console.log(context.chart.data.datasets[0].data)
                    const datapoints = context.chart.data.datasets[0].data;
                    function totalSum(total,datapoints){
                            return total + datapoints; 
                            }
                    const totalvalue = datapoints.reduce(totalSum,0);
                     
                    const porcentajevalue= (value / totalvalue*100).toFixed(0);
                    return  `${porcentajevalue}%`  ; 
                    }
               
                 },
            title: {
                display: true,
                text: 'Estadisticas de Clientes',
                weight: 'bold'
            },        
            legend: {
                display: true,
                labels: {
                    color: 'rgb(255, 99, 1)',
                    fillStyle:'rgba(255, 0, 0, 1)',
            }
        },
     },
    

    
    },
    plugins:[ChartDataLabels]
  
});
</script>



@endsection


