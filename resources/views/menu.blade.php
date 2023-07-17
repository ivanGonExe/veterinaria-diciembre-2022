<html lang="en">
  <head>
    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin ="anonymous"></script>
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
    <link rel="stylesheet" type="text/css" href="{{asset('estilo.css')}}">
    <link rel="icon" href={{asset('iconos/huella.png')}} >
    <link rel="stylesheet" type="text/css" href="{{asset('spinner.css')}}">
 <!-- estilos font google -->
 <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Gluten:wght@600&display=swap" rel="stylesheet">
  
<style>
h1,h2,h3,h4,h4,h6,p,a{
font-family: 'Gluten', cursive;
}
</style>

<title>Clínica Veterinaria San Agustín</title>
  </head>
   <!-- Cabezera barra -->
    <header class="container-fluid d-flex justify-content-center m-0 p-1" id="barra">
    
    <p class="text-light fs-6" > </p> 
    </header>

    <!-- Menú -->
     <nav class="navbar navbar-expand-lg navbar-light bg-light m-0 p-3" id="menu">
        <div class="container-fluid" >
            <div class="logo">
            <img src="{{asset('iconos/logo-sin-fondo.png')}}" alt="logo_principal"  >
             </div>
            <button class="navbar-toggler"  type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
               <li class="nav-item">
                <a class="nav-link" href="{{'/'}}"><i class="fa-solid fa-arrow-rotate-left"></i> Inicio</a>
              </li>
                <li class="nav-item">
                <a class="nav-link" href="{{'/seleccionTurno'}}"><i class="fa-solid fa-calendar-week"></i>  Turnos</a>
                </li>
                <li class="nav-item">
              <li class="nav-item">
                <a class="nav-link" href="{{'/noticias'}}"><i class="fa-solid fa-newspaper"></i> Noticias</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/#contacto" title="Comunicate con nosotros"><i class="fa-solid fa-message"></i> Contacto</a>
              </li>
              @if(auth()->user())
                   @if(auth()->user()->tipo == 'admin')
                      <li class="nav-item">
                        <a class="nav-link"  href="/usuario/Admin/ingresoAOtro/4">
                              <i class="fa-solid fa-house"></i> Admin 
                        </a>
                      </li>
                   @endif
              @endif
              
            </ul>
            
          </div>
        </div>
      </nav>
      @yield('formulario')
      <div class="loading show" id="figura">
        <span class="loader"></span>
       <div class="texto"><p class="text-white"> Veterinaria San Agustin</p></div>
           </div> 

      @yield('turnos')

      <script>

setTimeout(function() {
    document.getElementById("figura").style.display = "none";
  }, 1000); 
           </script>
   
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
 
</body>
</html>

