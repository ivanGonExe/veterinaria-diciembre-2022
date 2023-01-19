@extends('administrador.plantillaAdmin')

<script src="https://cdn.ckeditor.com/4.20.1/standard/ckeditor.js"></script>
@section('contenido')

<div class="main_content">
        <div class="content">
       
          <div class="header"><h2 class="text-dark fw-bold text-center">Entrada de Noticia</h2></div>    
         
          <div class="content text-center p-2">
            <div class="row">
                <div class="col-12 content-fluid d-flex justify-content-center p-2 "></div>
       
<div class="container">
    <div class="row justify-content-center">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        <form action="/guardarNoticia" method="POST">
                @csrf
      
           <!--      <script>
                        CKEDITOR.replace( 'desc' );
                </script> -->
                <div class="mb-3">
                  <label for="titulo" class="form-label">Titulo</label>
                  <input type="text" name="titulo" class="form-control" id="titulo">
                </div>
                <div class="mb-3">
                  <label for="asunto" class="form-label">Parrafo</label>
                  <textarea name="asunto" class="my-editor form-control" id="my-editor" cols="30" rows="10"> </textarea>
                  <script>
                        CKEDITOR.replace( 'asunto' );
                </script>

                 
                </div>
                <a class="btn btn-danger" href="/entradaNoticia">Cancelar</a>
                <button type="submit" class="btn btn-primary">Enviar</button>
              </form>
        </div>
    </div>
</div> 
@endsection

@push('scripts')
<script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('my-editor');
    </script>
@endpush