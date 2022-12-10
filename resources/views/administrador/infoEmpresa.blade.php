@extends('administrador.plantillaAdmin')
 
@section('contenido')

<style>
    .cuerpo{
        margin-top: 10% ;
        margin-left: 10% ;
        margin-Right: 10% ;
    };
</style>

<body>         
    <div class="cuerpo main_content ">
    <div class= "container m-5">  
    <h2> Informacion pagina principal</h2>
    <ul>
    @foreach ($errors->get('email') as $error)
        <li>{{ $error }}</li>
    @endforeach
</ul>

    <form  id ="formEdit"action="/storeEmpresa" method="POST">
        @csrf
        @method('Post')
        <div class=" mb-3 ml-2 mr-2">
            <label for="" class="form-label">Descripcion de la empresa</label>
            <input id="descripcion" name="descripcion" type="text" class="form-control" value="{{$empresa[0]->descripcion}}"  tabindex="3" disabled>
        </div>
        <div class=" mb-3 ml-2 mr-2">
            <label for="" class="form-label">Direccion de la empresa</label>
            <input id="direccion" name="direccion" type="text" class="form-control" value="{{$empresa[0]->direccion}}"  tabindex="3" disabled>
        </div>
        <div class=" mb-3 ml-2 mr-2">
            <label for="" class="form-label">Celular de la empresa</label>
            <input id="celular" name="celular" type="text" class="form-control" value="{{$empresa[0]->celular}}"  tabindex="3" disabled>
        </div>
        <div class=" mb-3 ml-2 mr-2">
            <label for="" class="form-label">Teléfono fijo de la empresa</label>
            <input id="telefonoFijo" name="telefonoFijo" type="text" class="form-control" value="{{$empresa[0]->telefonoFijo}}"  tabindex="3" disabled>
        </div>
        
        <div class=" mb-3 ml-2 mr-2">
            <label for="" class="form-label">Instagram</label>
            <input id="instagram" name="instagram" type="text" class="form-control" value="{{$empresa[0]->instagram}}"  tabindex="3" disabled>
        </div>
        <div class=" mb-3 ml-2 mr-2">
            <label for="" class="form-label">Mapa</label>
            <input id="mapa" name="mapa" type="text" class="form-control" value="{{$empresa[0]->mapa}}"  tabindex="3" disabled>
        </div>
        
        <button id="cancelar"class="btn btn-secondary" tabindex="6" style="display:none" >Cancelar</button>
        <button type="submit" id="guardar"class="btn btn-primary" tabindex="7" style="display:none" >Guardar</button>
        
    </form>
    <button  id="botonEditar" class="btn btn-primary" tabindex="7">Editar</button>
</div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

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