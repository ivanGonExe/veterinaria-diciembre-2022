


<!doctype html>

  <head>
    <!--  iconos -->
    <script src="https://kit.fontawesome.com/b610c83f26.js" crossorigin="anonymous"></script>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
      <!-- estilos CSS -->
  {{--   <link rel="stylesheet" type="text/css" href="{{asset('estiloLogin.css')}}"> --}}
    <link rel="icon" href={{asset('iconos/huella.png')}} >
          <!-- data table CSS-->
    <link rel="stylesheet" type="text/css"  href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css"  href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<title>Usuario Veterinario</title>

<style>
  .boton_crear {
  
  color:#000000;
  
  margin: 10 0 10 -10 !important;
  width: 160 !important;
  border-radius: 20px !important;
  
   
  }

.form-label{
   color:#ffffff;
}

  table th{
    background-color: rgba(100, 83, 153, 1) !important;
    color:#ffffff;
}
table tr{
    background-color: rgb(255, 255, 255,1) !important;
    color:#000000;
}

 

.navbar-expand-lg .navbar-nav .nav-link{
   padding-left:40px !important;
  
}
body{
  background-color: yellowgreen !important;
	/* background-image: linear-gradient(120deg, #ffffffae, #b405ff); */
}

 a{
  text-decoration: none;
  color:#000000;
}

.boton_cliente{
      width: 200px;
      height:200px;
      color:#ffffff;
     background-color: rgb(121, 110, 110) !important;
     border:1px solid rgb(255, 255, 255);
     -moz-box-shadow:0 5px 5px rgba(182, 182, 182, 0.75);
   -webkit-box-shadow: 0 5px 5px rgba(182, 182, 182, 0.75);
   box-shadow: 0 5px 5px rgba(182, 182, 182, 0.75);
   border-radius: 5px 5px 0 0;  
  }
  .boton_cliente:hover{

background: #5718EC;
background: -webkit-radial-gradient(top left, #655980, #43989E);
background: -moz-radial-gradient(top left, #655980, #43989E);
background: radial-gradient(to bottom right, #655980, #43989E);
  }

  .boton_veterinario{
      width: 200px;
      height:200px;
      color:#ffffff;
     background-color: rgba(100, 83, 153, 1) !important;
     border:1px solid rgb(255, 255, 255);
     -moz-box-shadow:0 5px 5px rgba(182, 182, 182, 0.75);
   -webkit-box-shadow: 0 5px 5px rgba(182, 182, 182, 0.75);
   box-shadow: 0 5px 5px rgba(182, 182, 182, 0.75);
   border-radius: 5px 5px 0 0;  
  }
  .boton_veterinario:hover{

background: #5718EC;
background: -webkit-radial-gradient(top left, #5718EC, #43989E);
background: -moz-radial-gradient(top left, #5718EC, #43989E);
background: radial-gradient(to bottom right, #5718EC, #43989E);
  }
  .boton_cajero{
      width: 200px;
      height:200px;
      color:#ffffff;
      background-color: rgb(233, 46, 49) !important;
      border:1px solid rgb(255, 255, 255);
      -moz-box-shadow:0 5px 5px rgba(182, 182, 182, 0.75);
   -webkit-box-shadow: 0 5px 5px rgba(182, 182, 182, 0.75);
   box-shadow: 0 5px 5px rgba(182, 182, 182, 0.75); 
   border-radius: 5px 5px 0 0;  
  }
  .boton_cajero:hover{
      background: #FF0119;
      background: -webkit-radial-gradient(top left, #FF0119, #3AA6AD);
      background: -moz-radial-gradient(top left, #FF0119, #3AA6AD);
      background: radial-gradient(to bottom right, #FF0119, #3AA6AD);
  }
  .boton_peluquero{
      width: 200px;
      height:200px;
      color:#ffffff;
      background-color: rgb(62, 46, 233,1) !important;
      border:1px solid rgb(255, 255, 255);
      -moz-box-shadow:0 5px 5px rgba(182, 182, 182, 0.75);
   -webkit-box-shadow: 0 5px 5px rgba(182, 182, 182, 0.75);
   box-shadow: 0 5px 5px rgba(182, 182, 182, 0.75); 
   border-radius: 5px 5px 0 0;  
  }
  .boton_peluquero:hover{
      
      background: #1A01FF;
      background: -webkit-radial-gradient(top left, #1A01FF, #3AA6AD);
      background: -moz-radial-gradient(top left, #1A01FF, #3AA6AD);
      background: radial-gradient(to bottom right, #1A01FF, #3AA6AD);
  }




a{
  text-decoration: none;
}
.dropdown-content a:hover {
  color: #FFFFFF;
  background-color: rgba(100, 83, 153, 0.4) !important;
  text-decoration: none;
}

 .form-group{
  /*   background-color: rgba(100, 83, 153, 1) !important; */
    margin: 0px;
    padding: 15px;
    font-size: 20px;
    color:#000000 !important;
    
}.form-label{
  color:#000000 !important;
}
.dropdown-menu{
  margin: 20px  !important;;
  padding: 10px  !important;;
}.li .a{
  padding: 10px  !important;;
}
h2{
padding: 20px;  
}
  </style>
@php
  $añoActual= Carbon\Carbon::now()->format('y');
  $mesActual= Carbon\Carbon::now()->format('m');
@endphp

<!-- Inicio de Menu -->
<body class="fondo_veterinario">
<nav class="navbar navbar-expand-lg navbar-light  bg-white m-0 p-3" >
  <div class="container-fluid" >
    <div class="logo">
      <img src="/iconos/logo_login.png"  class="logo_principal" height=140 width=100 >
       </div>
   
 
      <button class="navbar-toggler"  type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            
            

        
            <li class="nav-item ">
              <li><a href="/login/administrador" class="nav-link " ><i class="fas fa-home"></i> Inicio</a></li>
            </li>
            <li class="nav-item ">
              <li><a href="{{'/usuario'}}" class="nav-link " title="crear usuarios"><i class="fa-solid fa-users" ></i> Usuarios</a>
            </li>
            <li class="nav-item ">
              <a href="{{'/login/administrador/vistas'}}" class="nav-link" title="interfaces"><i class="fas fa-project-diagram"></i> Vistas</a>
            </li>
          
           

            <li class="nav-item ">
              <a href="{{'/infoEmpresa'}}" class="nav-link" title="interfaces"><i class="fa-solid fa-sliders"></i></i> Info empresa</a>
            </li>
            <li class="nav-item ">
              <a href="{{'/entradaNoticia'}}" class="nav-link" title="EntradaNoticias"><i class="fa-solid fa-pen-to-square"></i> Noticias</a>
            </li>
          
          
            <li class="nav-item">
              <a href="/copiadeseguridad" class="nav-link" title="Backup"><i class="fa-solid fa-floppy-disk"></i> Copia de seguridad</a>
            </li>
          
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" title="Estadisticas"> <i class="fa-sharp fa-solid fa-chart-simple"></i> Estadisticas </a>
               <ul class="dropdown-menu">
                <li><a href="/Estadistica/ventas/{{$añoActual}}"><i class="fa-sharp fa-solid fa-cart-shopping"></i> Ventas</a></li>
                <li><a href="/estadistica/ganancia/por_mes/{{$añoActual}}"><i class="fa-solid fa-sack-dollar fa-beat"></i> Ganancia</i></a></li>
                <li><a href="/estadistica/articulos/MasVendidos/{{$mesActual}}"><i class="fa-solid fa-bag-shopping"></i> Articulos</i></a></li>
                <li><a href="/estadistica/clientesNuevosPorMes/{{$añoActual}}"><i class="fa-solid fa-user-plus"></i> Nuevos Clientes</a></li>
                </ul>
            </li>


              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" title="Usuario"> <i class="fa-solid fa-user"></i> {{auth()->user()->tipo}}</a>
              <ul class="dropdown-menu cerrar">

              <li><a href='#' class="dropdown-item"  onclick ="event.preventDefault();
              document.getElementById('logout-form').submit();"><i class="fa-solid fa-right-to-bracket"></i> Cerrar</a></li>
              </ul>
              </li>
              

              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
              </form>

 
   

  </div>
   
  

   

</nav>

</div>

<div class="container">
  @yield('contenido')
</div>


      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
 


</body>
