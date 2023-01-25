     
     @extends('menu')
  
     @section('formulario')
    <!-- estilos CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('estiloNoticias.css')}}">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
    
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Gluten:wght@600&display=swap" rel="stylesheet">
     <style>


h1,h2,p,a{
  font-family: 'Gluten', cursive;
}
p{
      color:#000000b2;
      size: 14px;
      text-align: center;
      padding:10px ;
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
 
 /*    p{
      color:#000000;
      size: 14px;
      text-align: justify;
    }
    table th{
      background-color: rgb(127, 6, 113,0.7) !important;
      color:#ffffff;
  }
  table td{
      background-color: rgba(215, 61, 238, 0.2) !important;
      color:#000000;
  } */
     </style>
<body>
  <body>
    <!--   Tarjetas-->
    <h2 ><i class="fa-solid fa-paw"></i> Noticia Animal </h2>
  
  <div class="row"> 
    <div class="title-cards">
    

  <div class="container-card">
    
  <div class="card">
    <figure>
      <!--imagen-->      
<img src="https://tn.com.ar/resizer/dgJ4gZ6mjsDDgUTIZ0YQ7hjZCs0=/1440x0/smart/filters:format(webp)/cloudfront-us-east-1.images.arcpublishing.com/artear/OHLM5W5P6BHIJOCVUWH7WELEQE.jpg" >
    </figure>
    <div class="contenido-card">
      <h4 type="text" id="titulo" name="titulo">Cómo entender las emociones de tu perro</h4><!--titulo abajo copete--> 
      <p type="type" id="asunto" class="limitar-texto-principal" name="asunto">Los perros, tal vez como ninguna otra mascota, son muy expresivos. Y su expresión favorita es la de la felicidad.</p>
      <a href="#">Leer Más</a>
    </div>
  </div>
  <div class="card">
    <figure>
      <img src="https://www.infobae.com/new-resizer/eEw2j_Z1yjD2rds0xprHDunleOs=/768x432/filters:format(webp):quality(85)/cloudfront-us-east-1.images.arcpublishing.com/infobae/Y6CUURF5LFDABO4GDCSPFLXH2Y.jpg">
    </figure>
    <div class="contenido-card">
      <h4 type="text" id="titulo" name="titulo">¿Las dietas veganas son viables para las mascotas?</h4>
       <p type="type" id="asunto" class="limitar-texto-principal" name="asunto">Las tendencias globales hacia una dieta libre de carne se han vuelto un tópico en la población</p>
      <a href="#">Leer Más</a>
    </div>
  </div>
  <div class="card">
    <figure>
      <img src="https://www.infobae.com/new-resizer/iWR_l0gfJrkq554PBf41C_Gmoq4=/265x149/filters:format(webp):quality(85)/cloudfront-us-east-1.images.arcpublishing.com/infobae/IRF7JT2DLFG3RP6WVHKC6EKMTA.png">
    </figure>
    <div class="contenido-card">
      <h4 type="text" id="titulo"  name="titulo">Vacaciones con mascotas: cuáles son los trámites necesarios para viajar al exterior</h4>
      <p type="type" id="asunto" class="limitar-texto-principal" name="asunto">Quienes viajen fuera del país deberán cumplir con una serie de requisitos del Senasa además de los que exija el país de destino. </p>
      <a href="#">Leer Más</a>
    </div>
  </div>
</div>
<br>
  <div style="border-top: 1px solid black; width:100%;"></div>
  <h4 class="tituloNoticias"> Leer Más Noticias </h4>
  <div style="border-top: 1px solid black; width:100%;"></div>
  <br>
  <br>
  <div class="card p-2">
    <div class="row">
    <div class="col-4"> 
      <img src="https://www.infobae.com/new-resizer/eEw2j_Z1yjD2rds0xprHDunleOs=/768x432/filters:format(webp):quality(85)/cloudfront-us-east-1.images.arcpublishing.com/infobae/Y6CUURF5LFDABO4GDCSPFLXH2Y.jpg" alt="Imagen de la tarjeta" height="200" width="100%">
    </div>
    <div class="col-8">
       <h2>¿Las dietas veganas son viables para las mascotas?</h2>
       <div class="text-container">
   <p class= "limitar-texto">Las tendencias globales hacia una dieta libre de carne se han vuelto un tópico en la población, lo que ha provocado que algunos dueños de perros y gatos consideren implementar estas costumbres alimenticias en sus mascotas. </p> 
       </div>
  </div> 
   <div class="row">
    <div class="col-12 text-end"><a href="#" class="fw-bold" title="leer..."><i class="fa-solid fa-plus"></i></a></div>
  
  </div>
    </div>
     
  </div>


  <div class="card p-2">
    <div class="row">
    <div class="col-4"> 
      <img src="https://www.infobae.com/new-resizer/iWR_l0gfJrkq554PBf41C_Gmoq4=/265x149/filters:format(webp):quality(85)/cloudfront-us-east-1.images.arcpublishing.com/infobae/IRF7JT2DLFG3RP6WVHKC6EKMTA.png" alt="Imagen de la tarjeta" height="100%" width="100%">
    </div>
    <div class="col-8">
       <h2>Título de la tarjeta</h2>
     
       <p class="text">Contenido de la tarjeta</p> 
  </div> 
   <div class="row">
    <div class="col-12 text-end"><a href="#" class="fw-bold" title="leer..."><i class="fa-solid fa-plus"></i></a></div>
  
  </div>
    </div>
     

  </div>
  </div>
   

</div>

  <!--Fin   Tarjetas 1, 2 3 -->

  

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

</body>


<script>
  
  let elements = document.getElementsByClassName("limitar-texto");
   // Establecemos el número máximo de caracteres permitidos
  let maxLength = 200;
  
  // Recorremos cada una de las etiquetas <p>
  for (let i = 0; i < elements.length; i++) {
    // Comprobamos si el texto es mayor al número máximo de caracteres permitidos
    if (elements[i].innerText.length > maxLength) {
      // Si es así, recortamos el texto y agregamos un elipsis
      elements[i].innerText = elements[i].innerText.substring(0, maxLength) + "...";
    }
  }

  let elementos = document.getElementsByClassName("limitar-texto-principal");
   // Establecemos el número máximo de caracteres permitidos
  let max = 80;
  
  // Recorremos cada una de las etiquetas <p>
  for (let i = 0; i < elementos.length; i++) {
    // Comprobamos si el texto es mayor al número máximo de caracteres permitidos
    if (elementos[i].innerText.length > max) {
      // Si es así, recortamos el texto y agregamos un elipsis
      elementos[i].innerText = elementos[i].innerText.substring(0, max) + "...";
    }
  }



</script>




@endsection

