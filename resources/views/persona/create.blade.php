@extends((auth()->user()->tipo == 'admin')? ((auth()->user()->estadoIngreso =='veterinario')? 'layouts.plantillaBase':'layouts.plantillaBase3') : ( (auth()->user()->tipo == 'veterinario')? 'layouts.plantillaBase' :'layouts.plantillaBase3'))

<link rel="stylesheet" type="text/css" href="{{asset('estiloControl.css')}}">
<style>
  .swal2-confirm{
    background-color: #dc3545 !important;
  }
</style>

@section('contenido')
 
      <div class="form-group   text-center">
        <div class="container-fluid d-flex justify-content-end">
            <a href="{{url()->previous()}}" class="btn btn-secondary rounded-pill m-3"><i class="fa-solid fa-arrow-rotate-left"></i></a>
        </div>
   <span class="text-center text-light p-2 m-2 fs-1 fw-bold " >Crear Cliente </span> 
    
    <div class="row container-fluid d-flex justify-content-center">
   <div class="col-md-6">
    <form action="/personas" method="POST" id="formulario">
        @csrf
        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
        <div class="mb-3">
          <!--Grupo Nombre -->
          <div class="formulario__grupo " id="grupo__nombre">
            <label for="nombre" class="formulario__label">Nombre *</label>
            <div class="formulario__grupo-input">
              <input type="text" class="form-control formulario__input" id="nombre" name="nombre" placeholder="Nombre del cliente" maxlength="30" required>
        	    <i class="formulario__validacion-estado fas fa-times-circle"></i>
				    </div>
            <br>
				    <p class="formulario__input-error">El Nombre tiene que ser de 2 a 25 caracteres y solo puede contener letras.</p>
			    </div>


         <!--Grupo Apellido -->
         <div class="mb-3">
         <div class="formulario__grupo" id="grupo__apellido">
          <label for="apellido" class="formulario__label">Apellido *</label>
          <div class="formulario__grupo-input">
          <input type="text" class="form-control formulario__input" id="apellido" name="apellido" placeholder="Apellido del cliente" maxlength="16" required>
          <i class="formulario__validacion-estado fas fa-times-circle"></i>
        </div>
        <br>
        <p class="formulario__input-error">El Apellido tiene que ser de 2 a 25 caracteres y solo puede contener letras.</p>
      </div>

     
         <!-- Grupo: DNI-->
         <div class="mb-3">
			<div class="formulario__grupo" id="grupo__dni">
				<label for="dni" class="formulario__label">DNI *</label>
				<div class="formulario__grupo-input">
              <input type="text" class="form-control formulario__input" name="dni" id="dni"  maxlength="8" placeholder="XX.XXX.XXX" aria-describedby="addon-wrapping" required>
            <i class="formulario__validacion-estado fas fa-times-circle"></i>
         </div>
         <br>
				<p class="formulario__input-error">El DNI solo puede contener numeros y el maximo son 8 dígitos.</p>
			</div>

<!-- Grupo: Dirección -->

          <label for="direccion" class="formulario__label">Dirección *</label>
          <div class="row ">
          <div class = "col-md-8 col-6">
        <div class="formulario__grupo" id="grupo__direccion">
          <div class="formulario__grupo-input">
              <div class="input-group flex-nowrap">
                <input type="text" id="input" name="direccion"  class="form-control formulario__input" maxlength="25" placeholder="Calle " tabindex="4"required/> </ul> 
              
               <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div> 
            <p class="formulario__input-error">La dirección solo puede contener letras y números con un maximo 25 caracteres.</p>
          </div>
        </div>
          </div>
       
      
         
 <div class = "col-md-4 col-6">
  
          <div class="formulario__grupo" id="grupo__numeroCalle">
            <div class="formulario__grupo-input">
              <div class="input-group flex-nowrap">
              &nbsp;<span class="input-group-text bg-dark text-white" id="addon-wrapping">N°</span>
              <input type="text" class="form-control formulario__input" name="numeroCalle" id="numeroCalle"  maxlength="4" placeholder="1234" aria-describedby="addon-wrapping" required>
              <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>
            <p class="formulario__input-error">El Nº de Calle solo puede contener numeros y el maximo son 5 dígitos.</p>
            </div>  
          </div>
 </div>
 <br>
 



</div>


        <br>
        <label for="telefono" class="formulario__label">N° de area *</label>
        <div class="row ">
          <div class="mb-3">
                <div class="formulario__grupo" id="grupo__codigoArea">
                  <div class="formulario__grupo-input">
                      <div class="input-group flex-nowrap">
                      <span class="input-group-text bg-dark text-white" id="addon-wrapping" title="Código de Area">Cód.</span>
                      <input type="text" class="form-control w-100 formulario__input" name="codigoArea" id="codigoArea"  maxlength="4" placeholder="0343" aria-describedby="addon-wrapping" required>
                      <i class="formulario__validacion-estado fas fa-times-circle"></i>
                    </div> 
                    <p class="formulario__input-error">El Código de Area solo puede contener numeros y el maximo son 4 dígitos.</p>
                  </div>
                </div>
                <br>
        </div>
        <div class="mb-3">
          <label for="telefono" class="formulario__label">N° de celular *</label>
                  <div class="formulario__grupo" id="grupo__telefono">
                    <div class="formulario__grupo-input">
                      <div class="input-group flex-nowrap">
                      &nbsp;<span class="input-group-text bg-dark text-white" id="addon-wrapping"> 15</span>
                      <input type="text" class="form-control formulario__input" name="telefono" id="telefono"  maxlength="7" placeholder="4652xxx" aria-describedby="addon-wrapping" required>
                      <i class="formulario__validacion-estado fas fa-times-circle"></i>
                    </div>
                    <p class="formulario__input-error">El Nº de Celular solo puede contener numeros y el maximo son 7 dígitos.</p>
                    </div>  
                  </div>
                  <br>
        </div>
             <!-- Menesaje de Error -->
   <div class="row formulario__mensaje" id="formulario__mensaje">
             
    <p class="error_cartel"><i class="fa-solid fa-triangle-exclamation"></i><b> Error:</b> Formulario Incorrecto</p>
    
  </div>

    
        <div class="container-fluid d-flex justify-content-center m-2">
{{--        <a href="/personas" class="btn btn-secondary m-2" tabindex="6" id="cancelar">Cancelar</a>  --}}
{{--         <button  class="btn btn-secondary m-2" tabindex="6" id="cancelar" name="cancelar">Cancelar</button>  --}}
        <a href="{{url()->previous()}}" class="btn btn-secondary m-2" name="cancelar" id="cancelar" tabindex="6">Cancelar</a>
        <button class="btn btn-primary m-2" tabindex="7" id="enviar">Guardar</button>
        </div>
    </form>
        </div>
    </div>
</div>

<script src="{{asset('validarCliente.js')}}" defer></script>
<script>
  // let boton = document.getElementById("enviar");
  // let nombre = document.getElementById("nombre");
  // let apellido = document.getElementById("apellido");
  // let dni = document.getElementById("dni");
  // let direccion = document.getElementById("input");
  // let numeroCalle = document.getElementById("numeroCalle");
  // let codigoArea = document.getElementById("codigoArea");
  // let telefono = document.getElementById("telefono");
  // let token = document.getElementById("token");

  // boton.addEventListener("click", enviar);



  // async function enviar(e){
  //   let objeto = {
  //     nombre: nombre.value, 
  //     apellido: apellido.value, 
  //     dni: dni.value, 
  //     direccion: direccion.value, 
  //     numeroCalle: numeroCalle.value, 
  //     codigoArea: codigoArea.value, 
  //     telefono: telefono.value
  //   };

  //   const respuesta = await fetch('/personas/crear', {
  //     method: 'POST',
  //     mode: 'cors',
  //     headers:{
  //       'X-CSRF-TOKEN': token.value,
  //       'Content-Type': 'application/json'
  //     },

  //     body: JSON.stringify(objeto),
  //   });


  //   const data = await respuesta.json();
  //   //Si hay errores
  //   if(data["errores"]){
    
  //     let errores = data["errores"];
  //     let mensaje = `<div class="text-center text-danger">`;
  //     for(let i = 0; i < errores.length; i++){
  //       mensaje += "<h6>" + errores[i] + "</h6>";
  //     }
  //     mensaje+= "</div>";
      
      
  //     Swal.fire({
  //       icon: 'error',
  //       title: 'Error',
  //       html: mensaje,
  //     });
  //   }

  //   if(data["valido"]){ 
  //     Swal.fire({
  //           position: "top-center",
  //           icon: "success",
  //           title: "Cliente Guardado",
  //           showConfirmButton: false,
  //           timer: 4000,
  //       });
      
  //     setTimeout(() => {
  //       location.href = "/personas";
  //     }, 4000);
      
  //   }
  //   //clearInput();
  // }

</script>
<!-- @isset($mensajeError)
  <script>
    Swal.fire({
      icon: 'error',
      title: 'Error',
      text: 'Ya existe un cliente registrado con el dni ingresado!',
    })
  </script>
@endisset -->


@endsection