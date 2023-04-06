@extends('administrador.plantillaAdmin')
 

@section('contenido')

<body>
    <div class="main_content">
        <div class="content">
       
          <div class="header"><h2 class="text-dark fw-bold text-center">Editar Usuario</h2></div>    
         
          <div class="content text-center p-2">
            <div class="row">
                <div class="col-12 content-fluid d-flex justify-content-center p-2 "></div>
       
 
        <div class="form-group">
        
            <div class=" container-fluid d-flex justify-content-center">
    <div class= "container w-50 m-5">  
   
    <form action="/usuario/guardar/{{$usuario->id}}" method="POST">
        @csrf
        @method('Post')
        <div class=" mb-3 ml-2 mr-2">
            <label for="" class="form-label">Nombre y Apellido *</label>
            <input id="nombre" name="nombre" type="text" class="form-control" value="{{$usuario->name}}"  tabindex="3" required>
            <p class="text-white">*Campo obligatorio</p>
        </div>

        <div class=" mb-3 ml-2 mr-2">
            <label for="" class="form-label"> Mail *</label>
            <input id="mail" name="mail" type="text" class="form-control" value="{{$usuario->email}}"  tabindex="3" required>
          <p class="text-white">*Campo obligatorio</p>
        </div>
        
        <label for="tipo" class=" col-form-label text-md-right">Rol*</label>
            
                            <div class= "ml-2 mr-2">
                                <select class='form-select selecTipo' name= 'tipo'>
                                @if($usuario->tipo == 'admin' )
                                    <option class='form-option' value ='admin' selected>Administrador</option>
                                @else
                                    <option class='form-option' value ='admin'>Administrador</option>
                                @endif
                                @if($usuario->tipo == 'veterinario' )
                                    <option class='form-option' value ='veterinario'selected>Veterinario</option>
                                @else
                                    <option class='form-option' value ='veterinario'>Veterinario</option>
                                @endif
                                @if($usuario->tipo == 'peluquero' )
                                    <option class='form-option' value ='peluquero' selected>Peluquero</option>
                                @else
                                    <option class='form-option' value ='peluquero'>Peluquero</option>
                                @endif
                                @if($usuario->tipo == 'cajero' )
                                    <option class='form-option' value ='cajero' selected>Cajero</option>
                                @else
                                    <option class='form-option' value ='cajero'>Cajero</option>
                                @endif
                                </select>
                                <p class="text-white">*Campo obligatorio</p>
                            <div>
                                <br>

        <a href="/usuario" class="btn btn-secondary" tabindex="6">Cancelar</a>
        
        <button type="submit" class="btn btn-primary" tabindex="7">Guardar</button>
    </form>
</div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

@endsection