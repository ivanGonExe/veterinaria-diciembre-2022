@extends('layouts.plantillaBase3')
<link rel="stylesheet" type="text/css" href="{{asset('estiloControl.css')}}">  
<style>
    .form-group input{
        height:           100px;
        background-color: #f3dcf3;
        border:           2px solid transparent;
        font-size:        18px;
    }
    .form-select option:hover {
        transform:  translateY(-2px); /* Mueve el botón hacia arriba */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    
    .form-group{
        background-color: rgba(100, 83, 153, 1) !important;
        margin:           5px;
        padding:          5px;
        width:            100% !important;
        height:           100%!important;
        color:            #ffffff;
    }
    #contendorPrincipal{
        margin-left:  20% !important;
        margin-right: 20% !important;
        width:        60% !important;
        text-align:   center !important;
    
    }
    .fondo_veterinario{
        max-height: 100% !important;
    }
    
    label{
        font-size:   20px;
        font-weight: bold;
    }
   
</style>
@section('contenido')

<div class="row m-2 p-2">
    <div class="col-3 text-center pt-2">
        <!-- <img src="/iconos/img-peluqueria-canina.png" alt="logo_salud" height="160" width="160" class="iconos" id="boton">  -->
    </div>
    <div class="col-6 text-center pt-5">
        <h2 class="text-center fw-bold" >Detalle de servicio</h2>
    </div>
    <div class="col-3 text-center pt-5">
        <a href="{{url()->previous()}}" class="btn btn-secondary rounded-pill m-1 p-2"><i class="fa-solid fa-arrow-rotate-left"></i></a>
    </div>
    <div class=" row justify-content-center mt-3" >
        <div class="form-group  text-center justify-content-center" id="contendorPrincipal">
            <div class="row container-fluid d-flex justify-content-center m-1 p-1">
                <div class="col-md-12 justify-content-center " >
                    <form action="/DetallesServicio/store/{{$servicio->id}}" method="POST" id='formulario'>
                        @csrf
                        <!--Grupo servicio -->
                        <div class="formulario__grupo " id="grupo__tipo">
                            <label for="tipoServicio" class="formulario__label my-2 ">Tipo de servicio *</label>
                            <select class="form-select" aria-label="Default select example" name="tipo" id="tipo" required>
                                <option value="Baño con shampoo medicado"    >Baño con shampoo medicado    </option> 
                                <option value="Baño y secado"               >Baño y secado               </option>
                                <option value="Corte de pelo y desenredado" >Corte de pelo y Desenredado </option>
                                <option value="Corte de uñas"               >Corte de uñas               </option>
                                <option value="Limpieza de oídos"           >Limpieza de oídos           </option>
                                <option value="Limpieza de glándulas"       >Limpieza de glándulas       </option>
                                <option value="Perfumería y fragancias"     >Perfumería y fragancias     </option>
                                <option value="Tintes o colorantes"         >Tintes                      </option>
                            </select> 
                        </div>   
                        <div class="formulario__grupo " id="grupo__descripcion">
                            <label for="descripcion" class="formulario__label">Descripción *</label>
                            <div class="formulario__grupo-input">
                                <textarea type="text" class="form-control formulario__input"  id="descripcion" name="descripcion" maxlength="300" required></textarea>
                                <i class="formulario__validacion-estado fas fa-times-circle"></i>
                            </div>
                            <p class="formulario__input-error">La descrición tiene que ser de 2 a 300 caracteres y solo puede contener letras y numeros.</p>
                        </div>
                        <br>
                        <a href="{{url()->previous()}}" class="btn btn-secondary" tabindex="3">Cancelar</a>
                        <button type="submit" class="btn btn-primary" tabindex="7">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('validarDetalleServicio.js')}}" defer></script>
@endsection