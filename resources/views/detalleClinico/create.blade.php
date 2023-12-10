@extends('layouts.plantillaBase')
<style>
.form-group input{

 border:2px solid transparent;
 font-size: 12px;

}
.form-group{
    background-color: rgba(100, 83, 153, 1) !important;
    margin: 5px;
    padding: 5px;
    width:100% !important;
    height:100%!important;
    color:#ffffff;
    
}


label{
    font-size: 20px;
    font-weight:bold;
}
</style>
@section('contenido')
<link rel="stylesheet" type="text/css" href="{{asset('estiloControl.css')}}">  
<div class="row m-2 p-2">
    <div class="col-3 text-center pt-2">
        <img src="/iconos/logo_salud.png" alt="logo_salud" height="160" width="200" class="iconos" id="boton"> 
    </div>
    <div class="col-6 text-center pt-5">
        <h2 class="text-center fw-bold" >Detalle Clínico</h2>
    </div>
    <div class="col-3 text-center pt-5"> <a href="{{url()->previous()}}" class="btn btn-secondary rounded-pill m-1 p-2"><i class="fa-solid fa-arrow-rotate-left"></i></a>
    </div>
    <div class="form-group  text-center ">
        <div class="row container-fluid d-flex justify-content-center m-2 p-2 ">
            <div class="col-md-6">
        <form method="POST" id='formulario'>
            @csrf
            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
            <div class="formulario__grupo " id="grupo__patologia">
                <label for="patologia" class="formulario__label">Patología *</label>
                <div class="formulario__grupo-input">
                    <textarea type="text" class="form-control formulario__input " id="patologia" name="patologia" maxlength='101'  tabindex="3" style="overflow: hidden"required></textarea>
                    <i class="formulario__validacion-estado fas fa-times-circle"></i>
                </div>
                <p class="formulario__input-error">La patologia tiene que ser de 2 a 100 caracteres y solo puede contener letras y numeros.</p>
            </div>

            <div class="formulario__grupo " id="grupo__tratamiento">
                <label for="tratamiento" class="form-label">Tratamiento *</label>
                <div class="formulario__grupo-input">
                    <textarea type="text" class="form-control formulario__input text-break" id="tratamiento" name="tratamiento" maxlength='201'tabindex="2" style="overflow: hidden" required></textarea>
                    <i class="formulario__validacion-estado fas fa-times-circle"></i>
                </div>
                <p class="formulario__input-error">El tratamiento tiene que ser de 8 a 200 caracteres y solo puede contener letras y numeros.</p>
            </div>

            <div class="formulario__grupo " id="grupo__peso">
                <label for="peso" class="form-label">Peso(kg) *</label>
                <div class="formulario__grupo-input">
                    <input class="form-control formulario__input" id="peso" name="peso" type="number" step="0.01" tabindex="3" title="valor número del peso de la mascota" required>
                    <i class="formulario__validacion-estado fas fa-times-circle"></i>
                </div>
                <p class="formulario__input-error">El peso solo puede contener numeros y punto decimal.</p>
            </div>

            <div class="formulario__grupo " id="grupo__observaciones">
                <label for="observaciones" class="form-label">Observaciones</label>
                <div class="formulario__grupo-input">
                    <textarea  type="text" class="form-control formulario__input" id="observaciones" name="observaciones" maxlength='301' tabindex="1" style="overflow: hidden"></textarea>
                    <i class="formulario__validacion-estado fas fa-times-circle"></i>
                </div>
                <p class="formulario__input-error">La descripción tiene que ser de 2 a 300 caracteres y solo puede contener letras y numeros.</p>
            </div>

            <div class="mb-3">
                <label for="" class="form-label"></label>
                <input id="idHistorialClinico" name="idHistorialClinico" type="hidden" class="form-control" tabindex="5" value="{{$historialClinico_id}}"required>
            </div>
            
            <input name="urlAnterior" type="hidden" value="{{url()->previous()}}">

            <a href="{{url()->previous()}}" class="btn btn-secondary" tabindex="3">Cancelar</a>
            
            <button type="submit" class="btn btn-primary" tabindex="7">Guardar</button>
        </form>
    </div>

</div>
<script src="{{asset('validarDetalleClinico.js')}}" defer></script>
@endsection