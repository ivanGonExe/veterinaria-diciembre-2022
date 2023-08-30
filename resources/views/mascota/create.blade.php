@extends((auth()->user()->tipo == 'admin')? ((auth()->user()->estadoIngreso =='veterinario')? 'layouts.plantillaBase':'layouts.plantillaBase3') : ( (auth()->user()->tipo == 'veterinario')? 'layouts.plantillaBase' :'layouts.plantillaBase3'))
<link rel="stylesheet" type="text/css" href="{{asset('estiloControl.css')}}">  
<style>
* 
{
  padding     : 0;
  margin      : 0;
  box-sizing  : border-box;
  font-family : "Poppins", sans-serif;
};

.form-group
{
  background-color: rgba(100, 83, 153, 1) !important;
  margin          : 0px;
  width           : auto !important;
  height          : auto!important;
  align-content   : center;
  color           : #ffffff;
};

input[type="text"]
{
  width           : 100%;
  border          : none;
  outline         : none;
  background-color: #ffffff;
  font-size       : 16px;
};

ul 
{
  list-style: none;
};

.list 
{
  background-color: #060606;
};

.list-items 
{
  width  : 100%;
  padding: 10px 10px;
}; 

.list-items:hover{
  width           : 100%;
  background-color: rgb(241, 10, 245) !important;
};

</style> 
@section('contenido')
@php
  $fechaActual = date('Y-m-d');
@endphp

<div class="form-group  text-center">
  <div class="container-fluid d-flex justify-content-end" >
    <a href="{{url()->previous()}}" class="btn btn-secondary rounded-pill m-3" title="volver"><i class="fa-solid fa-arrow-rotate-left"></i></a>
  </div>
  <div class="form-group  text-center">
    <h2 class="text-center text-light p-2 m-2 fs-1 fw-bold" >Crear Mascota</h2>
  </div>
  <div class="row container-fluid d-flex justify-content-center">
    <div class="col-md-6">
      
      <form action="/mascotas" method="POST" id="formulario">
        @csrf
        <p>*Este campo es obligatorio</p>
        <!--Grupo Nombre -->
        <div class="formulario__grupo " id="grupo__nombre">
          <label for="nombre" class="formulario__label">Nombre *</label>
          <div class="formulario__grupo-input">
            <input type="text" class="form-control formulario__input" id="nombre" name="nombre" maxlength="25" placeholder="Nombre de la mascota"   maxlength="30" required>
            <i class="formulario__validacion-estado fas fa-times-circle"></i>
          </div>
          <br>
          <p class="formulario__input-error">El Nombre tiene que ser de 2 a 25 caracteres y solo puede contener letras.</p>
        </div>
        <!-- Grupo Color -->
        <div class="formulario__grupo " id="grupo__color">
          <label for="color" class="formulario__label">Color *</label>
          <div class="formulario__grupo-input">
            <input type="text" class="form-control formulario__input"  id="color" name="color" maxlength="30"  tabindex="1" required>
            <i class="formulario__validacion-estado fas fa-times-circle"></i>
          </div>
          <p class="formulario__input-error">El color tiene que ser de 2 a 30 caracteres y solo puede contener letras.</p>
        </div>
        <br>
        <!--Grupo Esterilizado -->
        <div class="formulario__grupo " id="grupo__esterilizado">
          <label for="esterilizado" class="formulario__label">Esterilizado *</label>
          <select class="form-select" aria-label="Default select example" name="esterilizado" id="esterilizado" required>
            <option value="no">No </option>
            <option value="Si">Si </option>
          </select> 
        </div>   
        <br>
        <!--Grupo Especie -->
        <div class="formulario__grupo " id="grupo__especie">
          <label for="especie" class="formulario__label">Especie *</label>
          <select class="form-select" aria-label="Default select example" name="especie" id="especie" required>
            <option value="s/n">Selecionar Especie</option>
            <option value="Perro">🐶 Perro</option>
            <option value="Gato">🐱 Gato </option>
            <option value="Pajaro">🐤Pajaro </option>
            <option value="Conejo"> 🐰 Conejo </option>
            <option value="Tortuga">🐢 Tortuga </option>
            <option value="Otros">Otro </option>
          </select> 
        </div> 
        <br>
        <!-- Grupo Raza -->
        <div class="formulario__grupo " id="grupo__raza">
          <label for="raza" class="formulario__label">Raza *</label>
          <div class="formulario__grupo-input">
            <input type="text" id="raza" name="raza" class="form-control formulario__input" maxlength="30" placeholder="Busque la raza del animal..." required />
            <i class="formulario__validacion-estado fas fa-times-circle"></i>  
            <ul class="list"></ul>  
          </div>
          <br>
          <p class="formulario__input-error">La raza tiene que ser de 2 a 30 caracteres y solo puede contener letras.</p>
        </div>
        <!-- Grupo Sexo-->   
        <div class="container-fluid d-flex justify-content-center ">           
          <div class="form-checkm  m-3 ">
            <input class="form-check-input" type="radio" name="sexo" id="sexo1" value="macho" required>
            <label class="form-check-label" for="sexo1">
              Macho*
            </label>
          </div>
          <div class="form-check m-3">
            <input class="form-check-input" type="radio" name="sexo" id="sexo2" value="hembra" required>
            <label class="form-check-label" for="sexo2">
              Hembra*
            </label>
          </div>
        </div>
        <!-- Grupo Nacimiento-->
        <div class="formulario__grupo " id="grupo__anioNacimiento">
          <label for="anioNacimiento" class="formulario__label">Nacimiento *</label>
          <div class="formulario__grupo-input">
            <input id="anioNacimiento" name="anioNacimiento" type="date" class="form-control"  max="{{$fechaActual}}" value=""  tabindex="4" required>
            <i class="formulario__validacion-estado fas fa-times-circle"></i>
          </div>
          <br>
          <p class="formulario__input-error">La fecha de nacimiento solo debe contener números .</p>
	      </div>
        <div class="mb-3">
          <label for="" class="form-label"></label>
          <input id="id" name="id" type="hidden" class="form-control" tabindex="5" value="{{$persona_id}} ">
        </div>
        <input name="urlAnterior" type="hidden" value="{{url()->previous()}}">
        <a href="{{url()->previous()}}" class="btn btn-secondary" tabindex="3">Cancelar</a>
        <button type="submit" class="btn btn-primary" tabindex="7">Guardar</button>
        <br>
      </form>
    </div>
  </div>
</div>
<script src="{{asset('autocompletar.js')}}" defer></script>
<script src="{{asset('validarMascotaCreate.js')}}" defer></script>
@endsection