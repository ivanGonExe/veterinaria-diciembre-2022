@extends((auth()->user()->tipo == 'admin')? ((auth()->user()->estadoIngreso =='veterinario')? 'layouts.plantillaBase':'layouts.plantillaBase3') : ( (auth()->user()->tipo == 'veterinario')? 'layouts.plantillaBase' :'layouts.plantillaBase3'))
<!-- estilos css -->
  <link rel="stylesheet" type="text/css" href="{{asset('estiloControl.css')}}">

<!--Jquery-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

<!--Floating WhatsApp css-->
  <link rel="stylesheet" href="https://rawcdn.githack.com/rafaelbotazini/floating-whatsapp/3d18b26d5c7d430a1ab0b664f8ca6b69014aed68/floating-wpp.min.css">

<!--Floating WhatsApp javascript-->
  <script type="text/javascript" src="https://rawcdn.githack.com/rafaelbotazini/floating-whatsapp/3d18b26d5c7d430a1ab0b664f8ca6b69014aed68/floating-wpp.min.js"></script>

<!--BOOTSTRAP -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<!--css------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ -->
<style>
  .modal-body{
    background-color: rgba(100, 83, 153, 1) !important;
  }

  table.dataTable td {
    text-align: center;
  }

  table.dataTable tr {
    text-align: center;
  }

  table.dataTable th {
    text-align: center;
  }

  .whatsapp{
    color:#00b460 !important;
    font-size: 18px;
  }

  .btn.btn.eliminar{
    color: red;
  }

  .eliminar:hover{
    color:#000000 !important; 
  }

  .whatsapp:hover{
    color:#020a06 !important;
  }
</style>

<!--html---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
@section('contenido')

@if($styleTurno == 1)
    <h2 class="text-center p-2 m-2 fs-1 fw-bold text-dark" >Listado de turnos restantes en el dia</h2>
@endif
@if($styleTurno == 2)
    <h2 class="text-center p-2 m-2 fs-1 fw-bold text-dark" >Listado de turnos restantes en la semana</h2>
@endif
@if($styleTurno == 3)
    <h2 class="text-center p-2 m-2 fs-1 fw-bold text-dark" >Listado de turnos libres</h2>
@endif
@if($styleTurno == 4)
    <h2 class="text-center p-2 m-2 fs-1 fw-bold text-dark" >Histórico de turnos</h2>
@endif
@if($styleTurno == 5)
    <h2 class="text-center p-2 m-2 fs-1 fw-bold text-dark" >Listado de turnos pasados</h2>
@endif
@if($styleTurno == 6)
    <h2 class="text-center p-2 m-2 fs-1 fw-bold text-dark" >Turnos asignados</h2>
@endif

    <a href="/turnos/create"  class="btn btn-primary rounded-pill" title="Agregar Jornada">+ Jornada <i class="fa-solid fa-calendar-days"></i></a>
    <a href="/turnos/createUnTurno"  class="btn btn-primary rounded-pill" title="Agregar Turno">+ Turno <i class="fa-solid fa-calendar-days"></i></a>
    <br>
    <br>
    <table id="example" class="table table-striped display nowrap " cellspacing="0" style="width:100%">
    
        <thead >
            <tr class="text-center" >
                <th scope="col" class="text-center">Fecha   </th>
                <th scope="col" class="text-center">Hora    </th>
                <th scope="col" class="text-center">Persona </th>
                <th scope="col" class="text-center">DNI     </th>
                <th scope="col" class="text-center">Asunto  </th>
                <th scope="col" class="text-center">Acciones</th>      
            </tr>
        </thead>

        <tbody>
            @foreach($turnos as $unTurno)
                <tr>
                    @foreach(explode(' ', $unTurno->start) as $info) 
                      <td>{{$info}} </td>
                    @endforeach
          
                @if($unTurno->persona_id)
            <!-- si el turno esta asignado -->
                      <td>{{$unTurno->persona->nombre}} {{$unTurno->persona->apellido}}</td>
                      <td>{{$unTurno->persona->dni}}</td> 
                      <td>  <div class="container-fluid d-flex justify-content-start">{{$unTurno->asunto}} </div></td>
               <!-- botones de acciones -->
                      <td>
                          <div class="container w-100 acciones" >
                              <a href="/turnos/{{$unTurno->id}}/edit" class="btn editar " title="editar" ><i class="fa-solid fa-pen-to-square"></i></a>
                              <a href="{{ route('verMascotas', $unTurno->persona_id)}}" name="mascota" class="btn btn mascota" title="Ver Mascotas"><i class="fa-solid fa-dog"></i></a>
                              <button class="btn btn cancelar" title="cancelar" id="{{$unTurno->id}}" value='{{$unTurno->id}}'><i class="fa-solid fa-ban"></i></button>
                              <button class="btn btn eliminar" title="eliminar" id="{{$unTurno->id}}*-1" value='{{$unTurno->id}}*-1'><div><i class="fa-solid fa-trash-can"></i></div></i></button>
                              <a class="bnt WhatsApp " title="Enviar WhatsApp" href="/turnos/mensaje/{{$unTurno->id}}" name="Boton_Enviar"  ><i class="fa fa-whatsapp whatsapp" aria-hidden="true"></i></a>
                          </div>
                      </td>
                @else 
            <!-- si el turno no esta asignado -->
                      <td class="text-center"  style="width:30%"> 
                    <!--boton modal  -->
                          <button type="button" class="btn btn-outline-primary rounded-pill p-2 modalTurno " id ="{{$unTurno->id}}modal" value='{{$unTurno->id}}' data-toggle="modal" data-target="#exampleModal" title="Agendar persona al turno">
                            <i class="fa-solid fa-user-plus"></i>
                          </button>
                      </td>
                      <td></td>
                      <td></td>
               <!-- botones de acciones -->
                      <td><button class="btn btn eliminar" title="eliminar" id="{{$unTurno->id}}*-1" value='{{$unTurno->id}}*-1'><div><i class="fa-solid fa-trash-can"></i></div></i></button></td>     
                @endif
                </tr>
            @endforeach    
        </tbody>
    </table>
<!-- librerias -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="  https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

   
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header text-center">
          <h5 class="modal-title text-center text-dark" id="exampleModalLabel">Agendar un turno a la persona</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="form-group  text-center p-3 text-white">
              <form action=" " method="POST" id="formulario">
                @csrf
                <p class="text-info">*Este campo es obligatorio</p>
                <div class="mb-3">
                    <i class="fa-regular fa-calendar-clock"></i>
                    <label for="fechaModal" class="formulario__label">Fecha y Hora <i class="fa-solid fa-calendar-days"></i></label>
                    <input id="fechaModal" name="fechaModal" type="text" class="form-control" maxlength="20"  tabindex="1" autocomplete="name" disabled>
                </div> 
          <!-- Grupo: DNI-->
                <div class="mb-3">
                    <div class="formulario__grupo" id="grupo__dni">
                      <label for="dni" class="formulario__label">DNI *</label>
                      <div class="formulario__grupo-input">
                        <input type="text" class="form-control formulario__input" name="dni" id="dni"  maxlength="8" placeholder="XX.XXX.XXX" aria-describedby="addon-wrapping" required>
                        <i class="formulario__validacion-estado fas fa-times-circle"></i>
                      </div>
                      <p class="formulario__input-error">El DNI solo puede contener numeros y el maximo son 8 dígitos</p>
                    </div>

          <!-- modal select -->
                <div class="mb-3">
                  <div id='divSelect'>
                    <label for="dni" class="formulario__label">Estado del cliente</label>
                      <select name='selectEstado' class='form-control'id='selectEstado'>
                          <option value="0" id='Inactivo' class="inactivo" >Inactivo</option>
                          <option value="1" id='Activo' class="activo" >Activo</option>     
                      </select>
                  </div>
                </div>

          <!--Modal Grupo Nombre -->
                <div class="formulario__grupo " id="grupo__nombre">
                  <label for="nombre" class="formulario__label">Nombre *</label>
                  <div class="formulario__grupo-input">
                    <input type="text" class="form-control formulario__input" id="nombre" name="nombre" value ='' placeholder="Nombre del cliente" maxlength="20" required>
                    <i class="formulario__validacion-estado fas fa-times-circle"></i>
                  </div>
                  <p class="formulario__input-error">El Nombre tiene que ser de 4 a 16 dígitos y solo puede contener letras</p>
                </div>
        
          <!--Modal Apellido -->
                <div class="mb-3">
                  <div class="formulario__grupo" id="grupo__apellido">
                    <label for="apellido" class="formulario__label">Apellido *</label>
                    <div class="formulario__grupo-input">
                      <input type="text" class="form-control formulario__input" id="apellido" name="apellido" placeholder="Apellido del cliente" maxlength="20" required>
                      <i class="formulario__validacion-estado fas fa-times-circle"></i>
                    </div>
                    <p class="formulario__input-error">El Apellido tiene que ser de 4 a 20 dígitos y solo puede contener letras</p>
                  </div>
                </div>

          <!-- Modal: Dirección -->
                <label for="direccion" class="formulario__label">Dirección *</label>
                <div class="row ">
                  <div class = "col-md-8 col-6">
                    <div class="formulario__grupo" id="grupo__direccion">
                      <div class="formulario__grupo-input">
                        <div class="input-group flex-nowrap">
                          <input type="text" id="direccion" name="direccion"  class="form-control formulario__input" maxlength="25" placeholder="Calle " tabindex="4"required/> </ul> 
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
                          <input type="text" class="form-control formulario__input" name="numeroCalle" id="numeroCalle"  maxlength="5" placeholder="1234" aria-describedby="addon-wrapping" required>
                          <i class="formulario__validacion-estado fas fa-times-circle"></i> 
                        </div>
                        <p class="formulario__input-error">El Nº de Calle solo puede contener numeros y el maximo son 5 dígitos.</p> 
                      </div>  
                    </div> 
                  </div>
                </div>

          <!-- Modal: Telefono -->
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
                  </div> 
                <div>
          <!--Grupo Asunto-->
                <div class="mb-3">
                  <div class="formulario__grupo" id="grupo__asunto">
                    <label for="apellido" class="formulario__label" title="Motivo por el cual pide el turno">Asunto * </label>
                    <div class="formulario__grupo-input">   
                      <input type="text" class="form-control formulario__input" id="asunto" name="asunto" placeholder="Asunto del turno" maxlength="50" required>
                      <i class="formulario__validacion-estado fas fa-times-circle"></i>
                    </div>
                    <p class="formulario__input-error">El asunto solo puede contener letra y número con un máximo de 80 caracteres</p>
                  </div>
                </div>
                <div class="container-fluid d-flex justify-content-center m-2">
                  <a href=" " class="btn btn-secondary m-2" name="cancelar" id="cancelar" tabindex="6">Cancelar</a>
                  <button type="submit" id='botonGuardar' class="btn btn-primary m-2" tabindex="7">Guardar</button>
                </div>
              </form>
            </div>
        </div>
      </div>
    </div>
  </div>
  
<!--js-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
<!-- validacion de inputs js -->
  <script src="{{asset('validarModal.js')}}" defer></script>

<!-- Deshabilitacion de botones -->
<script>
    let botonCancelar = document.getElementsByClassName("cancelar");
    let botonEliminar = document.getElementsByClassName("eliminar");
    let botonWhatsApp = document.getElementsByClassName("WhatsApp");
    let botonEditar   = document.getElementsByClassName("editar");
    let botonMascota  = document.getElementsByClassName("mascota");
//id de tipo de turno
    let  id = @json($styleTurno);
//ocultamiento de botones
   if((id == 1) || (id == 2) || (id == 6) || (id == 5)){
      $('.eliminar').hide();
   }
   if(id == 5){
      $('.editar').hide();
      $('.cancelar').hide();
   }
</script>

<!-- Ordenamiento boton class modalTurno -->
  <script>
      

        var id = 0;
        var botonesModal  = document.getElementsByClassName("modalTurno");
        var botonModal    = [];
        let cantidad      = botonesModal.length;

        for(let i = 0; i < cantidad; i++){

          id            = botonesModal[i].id;
          botonModal[i] = document.getElementById(`${id}`);

          botonModal[i].addEventListener('click', function(){

            let nombre              = document.getElementById('nombre');
            let apellido            = document.getElementById('apellido');
            let direccion           = document.getElementById('direccion');
            let numeroCalle         = document.getElementById('numeroCalle');
            let codigoArea          = document.getElementById('codigoArea');
            let telefono            = document.getElementById('telefono');
            let divSelect           = document.getElementById('divSelect');
            var inputDni            = document.getElementById('dni');
            let botonGuardar        = document.getElementById('botonGuardar')
            inputDni.value          = '';
            validarCampo(expresiones.dni, inputDni, "dni");
            nombre.value            = '';
            validarCampo(expresiones.nombre, nombre , "nombre");
            apellido.value          = '';
            validarCampo(expresiones.apellido, apellido , "apellido");
            direccion.value         = '';
            validarCampo(expresiones.direccion, direccion , "direccion");
            numeroCalle.value       = '';
            validarCampo(expresiones.numeroCalle, numeroCalle, "numeroCalle");
            codigoArea.value        = '';
            validarCampo(expresiones.codigoArea, codigoArea, "codigoArea");                    
            telefono.value          = '';
            validarCampo(expresiones.telefono, telefono, "telefono");
          // limpieza 
            document.getElementById(`grupo__dni`).classList.remove("formulario__grupo-incorrecto");
            document.querySelector(`#grupo__dni i`).classList.remove("fa-times-circle");
            document.querySelector(`#grupo__dni .formulario__input-error`).classList.remove("formulario__input-error-activo");
            document.getElementById(`grupo__nombre`).classList.remove("formulario__grupo-incorrecto");
            document.querySelector(`#grupo__nombre i`).classList.remove("fa-times-circle");
            document.querySelector(`#grupo__nombre .formulario__input-error`).classList.remove("formulario__input-error-activo");
            document.getElementById(`grupo__apellido`).classList.remove("formulario__grupo-incorrecto");
            document.querySelector(`#grupo__apellido i`).classList.remove("fa-times-circle");
            document.querySelector(`#grupo__apellido .formulario__input-error`).classList.remove("formulario__input-error-activo");
            document.getElementById(`grupo__direccion`).classList.remove("formulario__grupo-incorrecto");
            document.querySelector(`#grupo__direccion i`).classList.remove("fa-times-circle");
            document.querySelector(`#grupo__direccion .formulario__input-error`).classList.remove("formulario__input-error-activo");
            document.getElementById(`grupo__numeroCalle`).classList.remove("formulario__grupo-incorrecto");
            document.querySelector(`#grupo__numeroCalle i`).classList.remove("fa-times-circle");
            document.querySelector(`#grupo__numeroCalle .formulario__input-error`).classList.remove("formulario__input-error-activo");
            document.getElementById(`grupo__codigoArea`).classList.remove("formulario__grupo-incorrecto");
            document.querySelector(`#grupo__codigoArea i`).classList.remove("fa-times-circle");
            document.querySelector(`#grupo__codigoArea .formulario__input-error`).classList.remove("formulario__input-error-activo");
            document.getElementById(`grupo__telefono`).classList.remove("formulario__grupo-incorrecto");
            document.querySelector(`#grupo__telefono i`).classList.remove("fa-times-circle");
            document.querySelector(`#grupo__telefono .formulario__input-error`).classList.remove("formulario__input-error-activo");

            botonGuardar.disabled   = false;
            divSelect.style.display = 'none';
            var turnos              = @json($turnos);
            var longitud            = turnos.length;

            // busqueda e ingredo de fecha del modal y action del formulario
            for(let x = 0; x < longitud; x++){

              if(botonModal[i].value == turnos[x].id ){

                let fechaModal    = document.getElementById('fechaModal');
                let formulario    = document.getElementById('formulario');
                formulario.action = '/turnos/darTurno/'+ botonModal[i].value;
                fechaModal.value  = turnos[x].start;
              }
            }
          });
        }
      
  </script>

<!-- habilitacion del boton aceptar segun select -->
  <script>
    
    let selectEstado = document.getElementById('selectEstado');
  
    selectEstado.addEventListener('change', function(){
      
        let botonGuardar = document.getElementById('botonGuardar')

        if(selectEstado.value == 0){
            botonGuardar.disabled              = true;
            selectEstado.style.backgroundColor = '#FF0000';
            selectEstado.style.Color           = '#000000';

        }else if (selectEstado.value == 1){
            botonGuardar.disabled              = false;
            selectEstado.style.backgroundColor = '#61FF33';
            selectEstado.style.Color           = '#000000';
        }
    })
  </script>

<!-- logistica de busqueda de dni e insercion de datos, control de estado del cliente -->
  <script>
    
    let inputDni          =  document.getElementById('dni')
    selectEstado.disabled = false;

    inputDni.addEventListener('keyup',function(){
        
        longDNi = inputDni.value.length;

        if(longDNi>6){
          var personas    = @json($personas);
          let longitud    = personas.length;

          for(let i =0 ; i< longitud; i++){

            if(personas[i].dni == inputDni.value ){

              let nombre              = document.getElementById('nombre');
              let apellido            = document.getElementById('apellido');
              let direccion           = document.getElementById('direccion');
              let numeroCalle         = document.getElementById('numeroCalle');
              let codigoArea          = document.getElementById('codigoArea');
              let telefono            = document.getElementById('telefono');
              let divSelect           = document.getElementById('divSelect');
              let Activo              = document.getElementById('Activo');
              let Inactivo            = document.getElementById('Inactivo');

              nombre.value            = personas[i].nombre;
              validarCampo(expresiones.nombre, nombre , "nombre");
              apellido.value          = personas[i].apellido;
              validarCampo(expresiones.apellido, apellido , "apellido");
              direccion.value         = personas[i].direccion;
              validarCampo(expresiones.direccion, direccion , "direccion");
              numeroCalle.value       = personas[i].numeroCalle;
              validarCampo(expresiones.numeroCalle, numeroCalle, "numeroCalle");
              codigoArea.value        = personas[i].codigoArea;
              validarCampo(expresiones.codigoArea, codigoArea, "codigoArea");
              telefono.value          = personas[i].numero;
              validarCampo(expresiones.telefono, telefono, "telefono");
              divSelect.style.display = 'block';
              let selectEstado        = document.getElementById('selectEstado');
            
              if(personas[i].estadoPer == 1){

                Activo.selected                     = true;
                selectEstado.disabled               = true;
                selectEstado.style.backgroundColor  = '#61FF33';
                selectEstado.style.Color            = '#000000';
              }
              else {

                let botonGuardar                   = document.getElementById('botonGuardar')
                selectEstado.disabled              = false;
                Inactivo.selected                  = true;
                botonGuardar.disabled              = true;
                selectEstado.style.backgroundColor = '#FF0000';
                selectEstado.style.Color           =  '#000000';
                Swal.fire('El usuario seleccionado se encuentra inactivo, para continuar debe habilitarlo');
              }

          //corte forzado
              i=longitud;
            }
          }
        }
    })
  </script>

<!-- inicializacion de dataTable -->
  <script>
    $(document).ready(function () {

           $('#example').DataTable();          
    });

    $('#example').DataTable({

      "bSort": true, // Con esto le estás diciendo que se pueda ordenar, ponlo a 'true'
      "order": [], // Aquí le dices que el criterio de ordenación primero esté vació , o lo que es lo mismo, ninguno
      responsive:true, 
      language: {
        url: "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
      }
    }); 

  </script>

  /*------------------------------------------------ */
  <script>
    

      let id              = 0;
      let botonesCancelar = document.getElementsByClassName("cancelar");
      let botonCancelar   = [];
      let cantidad        = botonesCancelar.length;

      for(let i = 0; i < cantidad; i++){
       
        id               = botonesCancelar[i].id;
        botonCancelar[i] = document.getElementById(`${id}`);
                
        botonCancelar[i].addEventListener('click', function(){
                    
          var codCancelar = botonCancelar[i].value;

          Swal.fire({
            title:              '¿Esta Seguro que desea cancelar el turno?',
            text:               "confirme la decisión",
            icon:               'warning',
            showCancelButton:    true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor:  '#d33',
            confirmButtonText:  'aceptar',
            CancelButtonText:   'cancelar'
  
          }).then((result) => {
              if (result.isConfirmed) { 

                  location.href = '/turnos/cancelar/'+codCancelar; 
              }
          })
        });
      }
    

    

        var id              = 0;
        var botonesEliminar = document.getElementsByClassName("eliminar");
        var botonEliminar   = [];
        let cantidad        = botonesEliminar.length;

        for(let i = 0; i < cantidad; i++){

          id               = botonesEliminar[i].id;
          botonEliminar[i] = document.getElementById(`${id}`);

          botonEliminar[i].addEventListener('click', function(){
                  
            var codEliminar = botonEliminar[i].value;

            Swal.fire({
              title:              '¿ Esta Seguro que desea eliminar el turno?',
              text:               "confirme la decisión!",
              icon:               'warning',
              showCancelButton:    true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor:  '#d33',
              confirmButtonText:  'Si, eliminar'
  
            }).then((result) => {
                if (result.isConfirmed) {    
                  location.href = '/turnos/'+codEliminar+'/delete';          
                }
            })

          });
        }
    
  </script> 
  
@endsection
