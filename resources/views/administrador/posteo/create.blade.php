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
        

        <form action="/guardarNoticia" method="POST"  enctype="multipart/form-data">
                @csrf
                    <div class="mb-3">
                  <label for="titulo" class="form-label"><h3>Titulo</h3></label>
                  <input type="text" name="titulo" class="form-control" id="titulo">
                </div>
                <div class="mb-3">
                  <label for="asunto" class="form-label"><h3>Parrafo</h3></label>
                  <textarea name="asunto" class="my-editor form-control" id="my-editor" cols="30" rows="10"> </textarea>
               <script>
                        CKEDITOR.replace( 'asunto' );
                </script>
               
                <div class="container ">
                <div class="row w-50">
                <img id="imgPreview" > 
             <input type="file" aria-label="Archivo" accept="image/*" class="file" name="file" id="file" height="600" width="700"  onchange="previewImage(event, '#imgPreview')">
                </div> 
               
                <br>
                <a class="btn btn-danger" href="/entradaNoticia">Cancelar</a>
                <button type="submit" class="btn btn-primary">Enviar</button>
              </form>
        </div>
    </div>
</div> 

<!-- data table javacript-->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/fixedheader/3.3.1/js/dataTables.fixedHeader.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.4.0/js/responsive.bootstrap.min.js"></script>

<script>

function previewImage(event, querySelector){

console.log("entro perro");
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