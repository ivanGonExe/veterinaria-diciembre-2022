     
     @extends('menu')
  
  @section('formulario')
 <!-- estilos CSS -->
 <link rel="stylesheet" type="text/css" href="{{asset('estiloNoticias.css')}}">
 <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
 
 <!-- estilos font google -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Gluten:wght@600&display=swap" rel="stylesheet">
  
  
  <style>


h1,h2,h3,h4,h4,h6,p,a{
font-family: 'Gluten', cursive;
}
p{
   color:#000000b2;
   size: 14px;
   text-align: justify;
   padding:10px ;
 }
 .limitar-texto{
  font-family: 'Gluten', cursive;
  text-align: justify;
 }
.tituloNoticias{

     font-family: 'Gluten', cursive;
     color: black;
     font-size: 40px;
     padding: 10px;
   }
   h2{
     font-family: 'Gluten', cursive;
     text-align: center;
     padding-top: 30px;
     color: black;
     font-size: 40px;
    
   }
   a{
     text-decoration: none;
   }
</style>

<body>
<body>
 <!--   Tarjetas-->
 <h2 ><i class="fa-solid fa-paw"></i> Noticia Animal </h2>

<div class="row"> 
 <div class="title-cards">
 
   @php
   $contador = 0;
   $contadorAux = 0;
   @endphp
<div class="container-card">
 @foreach($noticias as $unaNoticia)
   @php
     $contador++;      
   @endphp
 @if($contador < 4)
 <div class="card">
   <figure>
     <!--imagen-->      
 <img src="{{$unaNoticia->file}}" >
   </figure>
   <div class="contenido-card">
     <h4 type="text" id="titulo" name="titulo">{{$unaNoticia->titulo}}</h4><!--titulo abajo copete--> 
     
     <div type="type" id="asunto" class="limitar-texto-principal" name="asunto">{!! $unaNoticia->asunto !!}</div>
     <a href="/noticias/posteo/{{$unaNoticia->id}}">Leer Más...</a>
   </div>
 </div>

 @endif
 @endforeach
</div>
<br>
<div style="border-top: 1px solid black; width:100%;"></div>
<h4 class="tituloNoticias"> Leer Más Noticias </h4>
<div style="border-top: 1px solid black; width:100%;"></div>
<br>
<br>

@foreach($noticias as $unaNoticia2)
 @php
   $contadorAux++;      
 @endphp
 @if($contadorAux > 3)
 <div class="card p-2">
     <div class="row">
       <div class="col-4"> 
           <img src="{{$unaNoticia2->file}}" alt="Imagen de la tarjeta" height="200" width="100%">
         </div>
       <div class="col-8">
           <h2>{{$unaNoticia2->titulo}}</h2>
       <div class="text-container">
           <div class= "limitar-texto">{!! $unaNoticia2->asunto !!} </div>      
       </div>
     </div> 
   <div class="row">
     <div class="col-12 text-end"><a href="/noticias/posteo/{{$unaNoticia2->id}}" class="fw-bold" title="leer...">leer Más...<i class="fa-solid fa-plus"></i></a></div>
   </div>
 </div>   
</div>
 @endif
@endforeach

<!--Fin   Tarjetas 1, 2 3 -->



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

</body>


<script>



let elements = document.getElementsByClassName("limitar-texto");
// Establecemos el número máximo de caracteres permitidos
let maxLength = 100;

// Recorremos cada una de las etiquetas <p>
for (let i = 0; i < elements.length; i++) {
 // Comprobamos si el texto es mayor al número máximo de caracteres permitidos
 if (elements[i].innerText.length > maxLength) {
   // Si es así, recortamos el texto y agregamos un elipsis
   
   elements[i].textContent = elements[i].innerText.substring(0, maxLength) + "...";
 }
}

let elementos = document.getElementsByClassName("limitar-texto-principal");
// Establecemos el número máximo de caracteres permitidos
let max =70;

// Recorremos cada una de las etiquetas <p>
for (let i = 0; i < elementos.length; i++) {
 // Comprobamos si el texto es mayor al número máximo de caracteres permitidos
 if (elementos[i].innerText.length > max) {
   // Si es así, recortamos el texto y agregamos un elipsis
  
   elementos[i].textContent = elementos[i].innerText.substring(0, max) + "...";
 }
}



</script>




@endsection

