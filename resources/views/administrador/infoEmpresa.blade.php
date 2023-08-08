@extends('administrador.plantillaAdmin')
 
@section('contenido')
<link rel="stylesheet" type="text/css" href="{{asset('estiloControl.css')}}">

<div class="main_content">
  <div class="content">
  <div class="header"><h2 class="text-dark fw-bold text-center">Información de la Empresa en la página principal</h2></div>    
    <div class="content text-center p-2">
      <div class="row">
          <div class="col-12 content-fluid d-flex justify-content-center p-2 "></div>
  
          <div class="form-group">
            <div class=" container-fluid d-flex justify-content-center">
    <div class="col-md-6 ">
   <div class="row">
    <form  id="formulario" name='formulario'action="/storeEmpresa" method="POST" >
        @csrf
        
        <!-- Grupo Descripcion -->
        <div class="formulario__grupo " id="grupo__descripcion">
            <label for="descripcion" class="formulario__label" title="descripcion general de la empresa"><i class="fa-solid fa-list-check"></i> Descripción *</label>
            <div class="formulario__grupo-input">
                <input type="text" class="form-control formulario__input" id="descripcion" name="descripcion" value="{{$empresa[0]->descripcion}}"  tabindex="3" disabled>
                <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>
            <br>
            <p class="formulario__input-error">La descripcion debe tener entre 10 a 300 caracteres y solo puede contener letras y números.</p>
        </div>
        <!--Grupo Direccion -->
        <div class="formulario__grupo " id="grupo__direccion">
            <label for="direccion" class="formulario__label" title="dirección de la empresa"><i class="fa-solid fa-signs-post"></i> Dirección *</label>
            <div class="formulario__grupo-input">
                <input type="text" class="form-control formulario__input" id="direccion" name="direccion"  value="{{$empresa[0]->direccion}}"  tabindex="3" disabled>
                <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>
            <br>
            <p class="formulario__input-error">La direcion debe tener entre 4 a 50 caracteres y solo puede contener letras y números.</p>
        </div>
        <!-- Grupo Celular -->
        <div class="formulario__grupo" id="grupo__celular">
            <label for="celular" class="formulario__label" title="n° de celular de la empresa"><i class="fa-brands fa-whatsapp"></i> WhatsApp *</label>
            <div class="formulario__grupo-input">
                <input type="text" class="form-control formulario__input" id="celular" name="celular" value="{{$empresa[0]->celular}}"  tabindex="3" disabled>
                <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>
            <br>
            <p class="formulario__input-error">El Nº de Celular solo puede contener numeros y el maximo son 7 dígitos.</p>
        </div>

    <!--Grupo Telefono Fijo -->
        <div class="formulario__grupo" id="grupo__telefonoFijo">
            <label for="telefonoFijo" class="formulario__label" title="n° fijo de la empresa"><i class="fa-solid fa-phone"></i> Teléfono fijo * </label>
            <div class="formulario__grupo-input">
                <input type="text" class="form-control formulario__input" id="telefonoFijo" name="telefonoFijo" value="{{$empresa[0]->telefonoFijo}}"  tabindex="3" disabled>
                <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>
            <br>
            <p class="formulario__input-error">El Nº de Telefono fijo solo puede contener numeros y el maximo son 7 dígitos.</p>
        </div>

    <!--Grupo Instagram -->
        <div class="formulario__grupo" id="grupo__instagram">
            <label for="instagram" class="formulario__label" title="Instagram de la empresa"><i class="fa-brands fa-instagram"></i> Instagram *</label>
            <div class="formulario__grupo-input">
                <input type="text" class="form-control formulario__input" id="instagram" name="instagram" value="{{$empresa[0]->instagram}}"  tabindex="3" disabled>
                <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>
            <br>
            <p class="formulario__input-error">Ingrese un link de intagram valido.</p>
        </div>
    
    <!--Grupo Mapa -->
        <div class="formulario__grupo" id="grupo__mapa">
            <label for="mapa" class="formulario__label" title="Link google map de la direccion de la empresa"><i class="fa-solid fa-location-dot"></i> Google Maps*</label>
            <div class="formulario__grupo-input">
                <input type="text"  class="form-control formulario__input" id="mapa" name="mapa" value="{{$empresa[0]->mapa}}"  tabindex="3" disabled>
                <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>
            <br>
            <p class="formulario__input-error">Ingrese un link de google map valido.</p>
        </div>
        
        <a id="cancelar"class="btn btn-secondary" tabindex="6" style="display:none" >Cancelar</a>
        <button type="submit" id="guardar"class="btn btn-primary" tabindex="7" style="display:none" >Guardar</button>

    </form>
   </div>
    </div>
   </div>
   <br>
    <button  id="botonEditar" class="btn btn-primary" tabindex="7">Editar</button>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="{{asset('validarInfoEmpresa.js')}}" defer></script>

<script>
    var formEdit     = document.getElementById('formulario');
    let botonGuardar = document.getElementById('guardar');

    botonGuardar.addEventListener('click',function(event){
            event.preventDefault();

            Swal.fire({
                            title: '¿Esta Seguro que desea guardar los cambios?',
                            text: "confirme la decisión",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'aceptar',
                            CancelButtonText: 'cancelar'
  
                    }).then((result) => {
                    if (result.isConfirmed) {    
                        
                        formEdit.submit(); 
                        
                        }
                        })     
        })
</script>


<script>
let botonCancelar = document.getElementById('cancelar');

botonCancelar.addEventListener('click',function(){
    location.href ="/login/administrador"; 
})
</script>


<script>
    let botonEditar = document.getElementById('botonEditar');
    botonEditar.addEventListener('click',function(){
        let inputDescripcion  = document.getElementById('descripcion');
        let inputDireccion    = document.getElementById('direccion');
        let inputCelular      = document.getElementById('celular');
        let inputTelefonoFijo = document.getElementById('telefonoFijo');
        let inputInstagram    = document.getElementById('instagram');
        let inputMapa         = document.getElementById('mapa');
        let botonCancelar     = document.getElementById('cancelar');
        let botonGuardar      = document.getElementById('guardar');

        inputDescripcion.disabled  = false;
        inputDireccion.disabled    = false;
        inputCelular.disabled      = false;
        inputTelefonoFijo.disabled = false;
        inputInstagram.disabled    = false;
        inputMapa.disabled         = false;

        botonEditar.style.display    = 'none';
        botonCancelar.style.display  = 'inline';
        botonGuardar.style.display   = 'inline';
        

    validarCampo(expresiones.descripcion, inputDescripcion, "descripcion");
    validarCampo(expresiones.direccion, inputDireccion, "direccion");
    validarCampo(expresiones.celular, inputCelular, "celular");
    validarCampo(expresiones.telefonoFijo, inputTelefonoFijo, "telefonoFijo");
    validarCampo(expresiones.instagram, inputInstagram, "instagram");
    validarCampo(expresiones.mapa, inputMapa, "mapa");
        
    })

</script>
@endsection