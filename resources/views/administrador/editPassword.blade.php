@extends('administrador.plantillaAdmin')
 

@section('contenido')
<body>  
  
    {{-- @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach --}}


    <div class="main_content">
        <div class="content">
       
          <div class="header"><h2 class="text-dark fw-bold text-center">Editar Password</h2></div>    
         
          <div class="content text-center p-2">
            <div class="row">
                <div class="col-12 content-fluid d-flex justify-content-center p-2 "></div>
       
 
        <div class="form-group">
        
            <div class=" container-fluid d-flex justify-content-center">
    <div class= "container m-5 w-50">  

    <form action="/usuario/guardarPassword/{{$usuario->id}}" method="POST">
        @csrf
        @method('Post')
        <div class=" mb-3 ">
            <label for="" class="form-label">Mail</label>
            <input id="mail" name="mail" type="text" class="form-control" value="{{$usuario->email}}"  tabindex="3" disabled>
        </div>
        <div class=" mb-3">
            <label for="" class="form-label">Contraseña nueva</label>
            <input id="password" name="password" type="password" class="form-control"  tabindex="3">
            <p id="errorContraseña" class="bg-danger text-white mt-2 fs-4">¡La contraseña debe contener al menos una mayúscula, una minúscula, un número y 6 caracteres como mínimo!</p>
        </div>

        <a href="/usuario" class="btn btn-secondary" tabindex="6">Cancelar</a>
        
        <button type="submit" class="btn btn-primary" id="submit" tabindex="7">Guardar</button>
    </form>
</div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

<script>
    let boton = document.getElementById("submit");
    boton.disabled = true;
    let password = document.getElementById("password");

    let mensaje = document.getElementById("errorContraseña");
    mensaje.style.display = "none";



    password.addEventListener("blur", function(){
       let regex = /^(?=.*\d)(?=.*[a-záéíóúüñ]).*[A-ZÁÉÍÓÚÜÑ]/;

        if (regex.test(password.value)&& password.value.length > 5) {
            boton.disabled = false;
            mensaje.style.display = "none";
        } else {
            boton.disabled = true;
            mensaje.style.display = "block";
        }
    });
        
</script>
@endsection