 @section('footer')
 
 <!-- Footer, pie de página -->

 {{-- <footer class="container-fluid  d-flex justify-content-center  p-2 m-4 border-1 footer"> --}}
    <div class="row w-100 mb-3 p-4 footer" id="contacto">
      
    <div class="col-lg-4 col-md-12 p-1 ">
      <div class="container-fluid d-flex justify-content-center p-2">
        <img src="iconos/logo_footer.png" alt="logo_principal" height="160" width="160" >
      </div>
      </div>
      <div class="col-lg-4 col-md-12  p-1">
            <div class="container-fluid d-flex justify-content-center p-2">
              <p>
        Dirección<br> {{$empresa[0]->direccion}}<br> <a href="{{$empresa[0]->mapa}}" id="mapa" target="_blank"> <i class="fa-solid fa-location-dot"></i> Ubicación Maps</a><br>
        <i class="fa-solid fa-phone"></i> Teléfono<br> <a href="tel:{{$empresa[0]->telefonoFijo}}" class="text-white">{{$empresa[0]->telefonoFijo}}</a>
        
      
        </div>
     </div>
     <div class="col-lg-4 col-md-12  p-1">
      <div class="container-fluid d-flex justify-content-center p-2">
    <nav class="navegadorFooter">
      <a class="nav-link" href="#barra"><i class="fa-solid fa-house"></i> Inicio</a>
      <a class="nav-link" href="#servicio"><i class="fa-solid fa-bars"></i> Servicios</a>
      <a class="nav-link" href="/seleccionTurno"><i class="fa-solid fa-calendar-check"></i> Turnos</a>
      <br>
     <br>
      </nav>
     </div>
     </div>
     <br>
     <br>


  </footer>

@endsection