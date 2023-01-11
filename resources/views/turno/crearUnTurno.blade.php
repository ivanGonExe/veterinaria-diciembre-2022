@extends((auth()->user()->tipo == 'admin')? ((auth()->user()->estadoIngreso =='veterinario')? 'layouts.plantillaBase':'layouts.plantillaBase3') : ( (auth()->user()->tipo == 'veterinario')? 'layouts.plantillaBase' :'layouts.plantillaBase3'))
<link rel="stylesheet" type="text/css" href="{{asset('estiloControl.css')}}">
@section('contenido')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<div class="form-group  text-center p-3">
        <div class="container-fluid d-flex justify-content-end">
            <a href="{{url()->previous()}}" class="btn btn-secondary rounded-pill m-1" title="volver"><i class="fa-solid fa-arrow-rotate-left"></i></a>
        </div>
        <h2 class="text-center text-light p-3 m-2 fs-1 fw-bold" >Crear turno</h2>
       <div class="row container-fluid d-flex justify-content-center">
            <div class="col-md-4 ">
    <form id='formCreate' action="/unTurno" method="POST">
        @csrf
        <div class="mb-3">
            <label for="" class="form-label"><i class="fa-regular fa-calendar-days"></i>  Selecionar Fecha</label><br>
            <input type="date" id='fecha' name="fecha" placeholder="20:30" title="fecha" required>
         
         </div>
        <div class="mb-3">
            
            <label for="" class="form-label">Inicio de Turno</label><br>
            <input id="desde" name="desde" type="time" placeholder="20:30" class="form-control" tabindex="2" required>
        </div>
        
        <div class="mb-3">
            <label for="" class="form-label">Finalización del turno</label>
            <br>
            <input id="horaHasta" name="hasta" type="time" class="form-control" tabindex="2" required>
          
        </div>
          
    <br>

        <a href="{{url()->previous()}}" class="btn btn-secondary" tabindex="4">Cancelar</a>
        
        <button type="submit" class="btn btn-primary" tabindex="5" title="Guardar Turno">Guardar</button>
   
    </form>

    <script>
        let formCreate = document.getElementById('formCreate');

        formCreate.addEventListener('submit',function(event){
            
            event.preventDefault();
            
            let fecha      = document.getElementById('fecha').value;
            let horaInicio = document.getElementById('desde').value;
            let horaFin    = document.getElementById('horaHasta').value;
            
            $.ajax({
                    type:"POST",
                    url:"/turnos/unTurnoSuperpuesto", 
                    data:{
                        fecha:fecha,
                        desde:horaInicio,
                        hasta:horaFin,
                        _token:$('input[name="_token"]').val()
                        }
            }).done(function(res){
                 if(res!='[]'){
                    let arregloDatos = JSON.parse(res);
                     
                     Swal.fire({
                             title: 'Turno superpuesto, existen turnos ya creados en la fecha '+ arregloDatos[0].start,
                             text: "confirme la decisión, esto implica que se guardaran ambos turnos",
                             icon: 'warning',
                             showCancelButton: true,
                             confirmButtonColor: '#3085d6',
                             cancelButtonColor: '#d33',
                             confirmButtonText: 'continuar',
                             CancelButtonText: 'volver'
  
                          }).then((result) => {
                      if (result.isConfirmed) { 

                        formCreate.submit();   
                           }
                         })
                 }else{
                    let formCreate = document.getElementById('formCreate');
                    formCreate.submit();  
                 }

            })
               
        })
    </script>
@endsection