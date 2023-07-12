


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
    <link rel="stylesheet" type="text/css" href="{{asset('estiloAdmin.css')}}">
          <!-- data table CSS-->
    <link rel="stylesheet" type="text/css"  href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css"  href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<title>Usuario Veterinario</title>


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
            
            

        
            {{-- <li class="nav-item ">
              <li><a href="/login/administrador" class="nav-link " ><i class="fas fa-home"></i> Inicio</a></li>
            </li> --}}
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
