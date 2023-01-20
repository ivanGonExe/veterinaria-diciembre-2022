@extends('administrador.plantillaAdmin')

<script src="https://cdn.ckeditor.com/4.20.1/standard/ckeditor.js"></script>
@section('contenido')

<div class="main_content">
        <div class="content">
       
          <div class="header"><h2 class="text-dark fw-bold text-center">Editar Noticia</h2></div>    
         
          <div class="content text-center p-2">
            <div class="row">
                <div class="col-12 content-fluid d-flex justify-content-center p-2 "></div>
       
<div class="container">
    <div class="row justify-content-center">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        <form action="/actualizarNoticia/{{$dato->id}}" method="POST" enctype="multipart/form-data">
                @csrf
      
           <!--      <script>
                        CKEDITOR.replace( 'desc' );
                </script> -->
                <div class="mb-3">
                  <label for="titulo" class="form-label"><h3>Titulo</h3></label>
                  <input type="text" name="titulo" class="form-control" id="titulo" value='{{$dato->titulo}}'>
                </div>
                <div class="mb-3">
                  <label for="asunto" class="form-label"><h3>Parrafo</h3></label>
                  <textarea name="asunto" class="my-editor form-control" id="my-editor" cols="30" rows="10" >{{$dato->asunto}}</textarea>
                  <script>
                        CKEDITOR.replace( 'asunto' );
                </script>
    
                <div class="row w-50">
                <img id="imgPreview" > 
             <input type="file" accept="image/*" height="600" width="900"  onchange="previewImage(event, '#imgPreview')">
                </div>
           
              

                  <br>
                <a class="btn btn-danger" href="/entradaNoticia">Cancelar</a>
                <button type="submit" class="btn btn-primary">Enviar</button>
              </form>
        </div>
    </div>
</div> 







<script>

  function previewImage(event, querySelector){
  
  //Recuperamos el input que desencadeno la acción
  const input = event.target;
  
  //Recuperamos la etiqueta img donde cargaremos la imagen
  $imgPreview = document.querySelector(querySelector);
  
  // Verificamos si existe una imagen seleccionada
  if(!input.files.length) return
  
  //Recuperamos el archivo subido
  file = input.files[0];
  
  //Creamos la url
  objectURL = URL.createObjectURL(file);
  
  //Modificamos el atributo src de la etiqueta img
  $imgPreview.src = objectURL;
                
  }
  
  
  
   
      CKEDITOR.editorConfig = function( config ) {
  
    config.removeButtons = 'Image,Flash,Table,HorizontalRule,Smiley,SpecialChar,PageBreak,Iframe,Anchor,Language,BidiRtl,BidiLtr,Blockquote,CreateDiv,Indent,Outdent,CopyFormatting,RemoveFormat,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,Scayt,SelectAll,Find,Replace,Undo,Redo,Source,Save,NewPage,Preview,Print,Templates,Cut,Copy,Paste,PasteFromWord,PasteText';
  };
  
      </script>

@endsection



   