@extends((auth()->user()->tipo == 'admin')? ((auth()->user()->estadoIngreso =='veterinario')? 'layouts.plantillaBase':'layouts.plantillaBase3') : ( (auth()->user()->tipo == 'veterinario')? 'layouts.plantillaBase' :'layouts.plantillaBase3'))

<link rel="stylesheet" type="text/css" href="{{asset('estiloControl.css')}}">  
<style>
    * {
  padding: 0;
  margin: 0;
  box-sizing: border-box;
  font-family: "Poppins", sans-serif;
}
    .form-group{
        background-color: rgba(100, 83, 153, 1) !important;
        margin: 0px;
        width: auto !important;
        height:auto!important;
        align-content: center;
        color:#ffffff;
        
    }
input[type="text"] {
  width: 100%;
/*   padding: 15px 10px; */
  border: none;
/*   border-bottom: 1px solid #645979; */
  outline: none;
/*   border-radius: 5px 5px 0 0; */
  background-color: #ffffff;
  font-size: 16px;
}
ul {
  list-style: none;
}
.list {

  background-color: #060606;
/*   border-radius: 0 0 5px 5px; */
}
.list-items {
    width: 100%;
  padding: 10px 10px;
} 
.list-items:hover {
    width: 100%;
  background-color: rgb(241, 10, 245) !important;
}

</style> 

@section('contenido')
<div class="form-group  text-center">
    <h2 class="text-center text-light p-2 m-2 fs-1 fw-bold" >Editar mascota</h2>
<div class="row container-fluid d-flex justify-content-center">
<div class="col-md-6">
    <form action="/mascotas/{{$mascota->id}}" method="POST" id="formulario">
        @csrf
        @method('PUT')
        <p class="text-info">*Este campo es obligatorio</p>
     
  <!--Grupo Nombre -->
  <div class="formulario__grupo " id="grupo__nombre">
    <label for="nombre" class="formulario__label">Nombre *</label>
    <div class="formulario__grupo-input">
     
      <input type="text" class="form-control formulario__input" id="nombre" name="nombre" maxlength="30" placeholder="Nombre de la mascota"  value='{{$mascota->nombre}}' maxlength="30" required>

      <i class="formulario__validacion-estado fas fa-times-circle"></i>
          </div>
 {{--  <p class="text-info ">*Campo obligatorio</p> --}}
          <p class="formulario__input-error">El Nombre tiene que ser de 2 a 25 caracteres y solo puede contener letras.</p>
      </div>
      <br>
      <div class="formulario__grupo " id="grupo__color">
      <label for="nombre" class="formulario__label">Color *</label>
      <div class="formulario__grupo-input">
     
            <input id="color" name="color" type="text" maxlength="40" class="form-control" value='{{$mascota->color}}' tabindex="1" required>
        </div>
        <br>
        <div class="formulario__grupo " id="grupo__esterilizado">
      <label for="nombre" class="formulario__label">Esterilizado *</label>
     
            <select class="form-select" aria-label="Default select example" name="esterilizado" id="esterilizado" required>
            @if ($mascota->esterilizado == 'Si')
                <option value="no">No </option>
                <option value="Si" selected>Si </option>
            @else
                <option value="no" selected>No </option>
                <option value="Si">Si </option>
            @endif
             </select> 
        </div>
        <br>
        <div class="formulario__grupo " id="grupo__especie">
      <label for="nombre" class="formulario__label">Especie *</label>
            <select class="form-select" aria-label="Default select example" name="especie" id="especie">
            @if ($mascota->especie == 'Perro')
                <option value="Perro" selected> 🐶Perro</option>
            @else
            <option value="Perro">🐶 Perro</option>
            @endif
            @if ($mascota->especie == 'Gato')
                <option value="Gato" selected>Gato</option>
            @else
                <option value="Gato">🐱 Gato</option>
            @endif
            @if ($mascota->especie == 'Pajaro')
                <option value="Pajaro" selected>Pajaro</option>
            @else
                <option value="Pajaro">🐤 Pajaro</option>
            @endif
            @if ($mascota->especie == 'Tortuga')
                <option value="Tortuga" selected>Tortuga</option>
            @else
                <option value="Tortuga"> 🐢 Tortuga</option>
            @endif
            @if ($mascota->especie == 'Conejo')
                <option value="Conejo" selected>Conejo</option>
            @else
                <option value="Conejo"> 🐰 Conejo</option>
            @endif
            @if ($mascota->especie == 'Otro')
                <option value="Otro" selected>Otro</option>
            @else
                <option value="Otro">Otro</option>
            @endif 
                

                
              </select> 
        </div> 
        <br>
        <div class="formulario__grupo " id="grupo__raza">
      <label for="nombre" class="formulario__label">Raza *</label>
        <input type="text" id="input" name="raza" class="form-control"  maxlength="30" value="{{$mascota->raza}}" />
 
 
        <ul class="list"></ul>
        <br>
      

        <div class="container-fluid d-flex justify-content-center ">
        @if($mascota->sexo == "macho")
                
                   
                    <div class="form-check m-4">
                        <input class="form-check-input" type="radio" name="sexo" id="sexo1" value="macho" checked>
                        <label class="form-check-label " for="sexo1">
                            Macho
                        </label>
                    </div>
                    <br>
                    <div class="form-check m-4">
                        <input class="form-check-input " type="radio" name="sexo" id="sexo2" value="hembra">
                        <label class="form-check-label " for="sexo2">Hembra
                        </label>
                    </div>
        
        @else
                    
                    <div class="form-check m-4">
                        <input class="form-check-input" type="radio" name="sexo" id="sexo1" value="macho">
                        <label class="form-check-label" for="sexo1">Macho</label>
                    </div>

                    <div class="form-check m-4">
                        <input class="form-check-input" type="radio" name="sexo" id="sexo2" value="hembra" checked>
                        <label class="form-check-label " for="sexo2">Hembra</label>
             
                    </div>
        <br>
        <br>
        @endif
    </div>

        <div class="formulario__grupo " id="grupo__nacimiento">
      <label for="nombre" class="formulario__label">Nacimiento *</label>
            <input id="anioNacimiento" name="anioNacimiento" type="date" class="form-control" value="{{$mascota->anioNacimiento}}" tabindex="4">
        </div>

        <div class="mb-3">
            <label for="" class="form-label"></label>
            <input id="id" name="id" type="hidden" class="form-control" tabindex="5" value="{{$mascota->persona->id}}">
        </div>

        <input name="urlAnterior" type="hidden" value="{{url()->previous()}}">

        <a href="{{url()->previous()}}" class="btn btn-secondary" tabindex="6">Cancelar</a>
        
        <button type="submit" class="btn btn-primary" tabindex="7">Guardar</button>
    </form>
    <script src="{{asset('autocompletar.js')}}" defer></script>
  {{--   <script src="{{asset('validarCliente.js')}}" defer></script> --}}
@endsection