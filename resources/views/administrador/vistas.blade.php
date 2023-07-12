      @extends('administrador.plantillaAdmin')
      <link rel="stylesheet" type="text/css" href="{{asset('estiloAdmin.css')}}">
        @section('contenido')
        <div class="main_content">
          <div class="content">
         
            <div class="header"><h2 class="text-dark fw-bold text-center">Vistas del Sistema</h2></div>    
            <div class="content text-center p-2">
          
                       
               
            <div class="container vistas">
              <div class="row">
                <div class="col-1"></div>
                <div class="col-2">
                  <div class="col-6 p-1 content-fluid d-flex justify-content-center rounded"><a href="/usuario/Admin/ingresoAOtro/1"><button type="button" class="boton_veterinario rounded-pill circulo"  ><i class="fa-solid fa-dog"></i> Veterinario</button></a></div>
                  <div class="col-6 m-2 content-fluid d-flex justify-content-center rounded"><a href="/usuario/Admin/ingresoAOtro/3" ><button type="button" class="boton_cajero rounded-pill circulo" ><i class="fa-solid fa-cart-shopping"></i> Cajero</button></a> </div>
                </div>
                <div class="col-6">
                  <img src="/iconos/fondo_administrador.png" alt="administrador" height="400" width="400" > 
                </div>
                <div class="col-1"></div>
                <div class="col-2">
                  <div class="col-6 p-1 content-fluid d-flex justify-content-center rounded"><a href="/usuario/Admin/ingresoAOtro/2" ><button type="button" class="boton_peluquero rounded-pill circulo" ><i class="fa-solid fa-scissors"></i> Peluquero</button></a></div>
                  <div class="col-6 p-1 content-fluid d-flex justify-content-center rounded"><a href="/" ><button type="button" class="boton_cliente rounded-pill circulo" ><i class="fa-solid fa-person rounded-pill"></i> Cliente</button></a></div>
                </div>
              </div>
            </div>
  
        </div>
      </div>


  @endsection