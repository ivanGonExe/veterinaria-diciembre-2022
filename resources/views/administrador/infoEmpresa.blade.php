@extends('administrador.plantillaAdmin')
 
@section('contenido')

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
    <form  id ="formEdit"action="/storeEmpresa" method="POST" >
        @csrf
        @method('Post')
        <div class="mb-3">
            <label for="" class="form-label" title="descripcion general de la empresa"><i class="fa-solid fa-list-check"></i> Descripción*</label>
            <input id="descripcion" name="descripcion" type="text" class="form-control" value="{{$empresa[0]->descripcion}}"  tabindex="3" disabled>
        </div>
        <div class="mb-3">
            <label for="" class="form-label"title="dirección de la empresa"><i class="fa-solid fa-signs-post"></i> Dirección*</label>
            <input id="direccion" name="direccion" type="text" class="form-control" value="{{$empresa[0]->direccion}}"  tabindex="3" disabled>
        </div>
        <div class="mb-3">
            <label for="" class="form-label" title="n° de celular de la empresa"><i class="fa-brands fa-whatsapp"></i> WhatsApp*</label>
            <input id="celular" name="celular" type="text" class="form-control" value="{{$empresa[0]->celular}}"  tabindex="3" disabled>
        </div>
        <div class="mb-3">
            <label for="" class="form-label" title="n° fijo de la empresa"><i class="fa-solid fa-phone"></i> Teléfono fijo* </label>
            <input id="telefonoFijo" name="telefonoFijo" type="text" class="form-control" value="{{$empresa[0]->telefonoFijo}}"  tabindex="3" disabled>
        </div>
        
        <div class="mb-3">
            <label for="" class="form-label"><i class="fa-brands fa-instagram"></i> Instagram*</label>
            <input id="instagram" name="instagram" type="text" class="form-control" value="{{$empresa[0]->instagram}}"  tabindex="3" disabled>
        </div>
        <div class="mb-3">
            <label for="" class="form-label"><i class="fa-solid fa-location-dot"></i> Google Maps*</label>
            <input id="mapa" name="mapa" type="text" class="form-control" value="{{$empresa[0]->mapa}}"  tabindex="3" disabled>
        </div>
        
        <button id="cancelar"class="btn btn-secondary" tabindex="6" style="display:none" >Cancelar</button>
        <button type="submit" id="guardar"class="btn btn-primary" tabindex="7" style="display:none" >Guardar</button>

    </form>
   </div>
    </div>
   </div>
   <br>
    <button  id="botonEditar" class="btn btn-primary" tabindex="7">Editar</button>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


<script>
    var formEdit     = document.getElementById('formEdit');
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
        let inputDescripcion = document.getElementById('descripcion');
        let inputDireccion   = document.getElementById('direccion');
        let inputCelular     = document.getElementById('celular');
        let inputTelefonoFijo   = document.getElementById('telefonoFijo');
        let inputInstagram   = document.getElementById('instagram');
        let inputMapa        = document.getElementById('mapa');
        let botonCancelar    = document.getElementById('cancelar');
        let botonGuardar     = document.getElementById('guardar');

        inputDescripcion.disabled = false;
        inputDireccion.disabled   = false;
        inputCelular.disabled     = false;
        inputTelefonoFijo.disabled     = false;
        inputInstagram.disabled   = false;
        inputMapa.disabled        = false;

        botonEditar.style.display    = 'none';
        botonCancelar.style.display  = 'inline';
        
        botonGuardar.style.display   = 'inline';
        
    })

</script>
@endsection