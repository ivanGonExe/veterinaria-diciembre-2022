<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
@section('contenido')
@extends('administrador.plantillaAdmin')
<link rel="stylesheet" type="text/css" href="{{asset('estiloControl.css')}}">

<style>

.form {
  width: 100%;
  max-width: 800px;
  margin: 0 auto;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
}

.form input {
  width: 100%;
  height: 30px;
  margin: 0.5rem;
}
.selecTipo{
  width: 100%;
  height: 35px;
  margin: 0.5rem;
}
.form button {
  padding: 0.5em 1em;
  border: none;
  background: rgb(100, 200, 255);
  cursor: pointer;
}
.form-option{
text-align: center;
}
i{
padding-left: 10px;
}
p{
    font-size: 13px !important;
    margin-bottom: 10px !important;
}
.formulario__validacion-estado {
    position: absolute;
    right: 10px;
    bottom: 7px;
    z-index: 100px;
    font-size: 14px;
    opacity: 0;
}
.formulario__input {
    width: 100%;
    background-color: #ffffff;
    border: 1px solid #ced4da;
    border-radius: 3px;
    height: 45px;
    line-height: 45px; /*cuando se escriba adentro*/
    /*padding: arriba derecha abajo izquierda*/

    padding: 0 40px 0 10px;
    transition: 0.3s ease all; /*transicion de tiempo para todas las propiedades*/
}
</style>

</div>
    <div class="row ">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="card m-1">
                <div class="card-header text-center">{{ __('Registrar Usuario') }}</div>
                
                <div class="card-body ">
                    <form method="POST" action="/registrado" class="form" id="formulario">
                        @csrf
                        @method('Post')

                        <div class="formulario__grupo mt-3 col-md-8" id="grupo__name">
                            <label for="name" class="formulario__label text-center">{{ __('Nombre*') }}</label>
                            <div class="formulario__grupo-input">
                                <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror formulario__input" value=""  tabindex="3" required autocomplete="name" autofocus>
                                <i class="formulario__validacion-estado fas fa-times-circle"></i>
                            </div>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <p class="formulario__input-error">El Nombre tiene que ser de 2 a 25 caracteres y solo puede contener letras.</p>      
                        </div>
                    

                        <div class="formulario__grupo mt-3 col-md-8" id="grupo__email">
                            <label for="email" class="formulario__label text-center">Email *</label>
                            <div class="formulario__grupo-input">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror formulario__input" name="email" required autocomplete="email">
                                <i class="formulario__validacion-estado fas fa-times-circle"></i>
                            </div>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <p class="formulario__input-error">El email no es válido.</p>      
                        </div>

                        <div class="formulario__grupo mt-3 col-md-8" id="grupo__password">
                            <label for="password" class="formulario__label text-center">{{ __('Password*') }}</label>
                            <div class="formulario__grupo-input">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror formulario__input" name="password" required autocomplete="new-password">
                                <i class="formulario__validacion-estado fas fa-times-circle"></i>
                            </div>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <p class="formulario__input-error">La contraseña debe contener como mínimo 8 caracteres, una letra, un dígito y una mayúscula.</p>      
                        </div>

                        <div class="formulario__grupo mt-3 col-md-8" id="grupo__password-confirm">
                            <label for="password-confirm" class="formulario__label text-center">{{ __('Confirmar Contraseña*') }}</label>
                            <div class="formulario__grupo-input">
                                <input id="password-confirm"   type="password" class="form-control formulario__input" name="password_confirmation" required autocomplete="new-password">
                                <i class="formulario__validacion-estado fas fa-times-circle"></i>
                                <a id="mostrarContrasenia" class="text-info"><i class="fa-solid fa-eye" style="color: #000000;"></i></a>
                            </div>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <p class="formulario__input-error">La contraseña debe contener como mínimo 8 caracteres, una letra, un dígito y una mayúscula.</p>      
                        </div>
                
                        <label for="tipo" class="formulario__label text-center">Rol de Usuario*</label>
                        <div class="col-md-8 ">
                            <select class='form-select selecTipo form-control text-center' name= 'tipo'>
                                <option class='form-option' value ='admin'>Administrador</option>
                                <option class='form-option' value ='veterinario'>Veterinario</option>
                                <option class='form-option' value ='peluquero'>Peluquero</option>
                                <option class='form-option' value ='cajero'>Cajero</option>
                            </select>
                        <div>
                    

                            </div>

                        <div class="container-fluid m-8 d-flex justify-content-center">
                            <a   href="/usuario" class="btn btn-secondary m-3"> Cancelar
                            </a>
                         {{--    <div class="col-md-6 offset-md-4"> --}}
                                <button type="submit" class="btn btn-primary m-3">
                                    {{ __('Guardar') }}
                                 {{--    {{ __('Register') }} --}}
                                </button>
                               
                           {{--  </div> --}}
                        </div>
                    </form>
                </div>
            </div>
           
       
        <div class="col-md-4"></div>
    </div>
 
<script>
let mostrar        = document.getElementById("mostrarContrasenia");
let password       = document.getElementById("password");
let passwordConfir = document.getElementById("password-confirm");
mostrar.style.color ="gray";
mostrar.addEventListener('click',function(){
    if(password.type =="password"){
            password.type      ="text";
            passwordConfir.type ="text";
            // mostrar.style.color ="#D0D3D4 ";
            mostrar.innerHTML  =`<i class="fa-solid fa-eye fa-beat" style="color: #000000;"></i>`;
    }
    else{
        password.type       ="password";
        passwordConfir.type ="password";
        mostrar.innerHTML   =`<i class="fa-solid fa-eye-slash" style="color: #000000;"></i>`;
        // mostrar.style.color ="gray";
    }
})

</script>
<script src="{{asset('validarCrearUsuario.js')}}" defer></script>
@endsection
