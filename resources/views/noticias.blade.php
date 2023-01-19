     
     @extends('menu')
  
     @section('formulario')
    <!-- estilos CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('estiloNoticias.css')}}">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
    

{{--      <style>
    p{
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
  }
     </style> --}}
<body>
  <body>
    <!--   Tarjetas-->
    <h2 class="text-center p-2 m-2 fs-1 fw-bold text-dark" ><i class="fa-solid fa-paw"></i> Noticia Animal </h2>
  
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
      <p type="type" id="asunto" name="asunto">Los perros, tal vez como ninguna otra mascota, son muy expresivos. Y su expresión favorita es la de la felicidad.</p>
      <a href="#">Leer Más</a>
    </div>
  </div>
  <div class="card">
    <figure>
      <img src="https://www.infobae.com/new-resizer/eEw2j_Z1yjD2rds0xprHDunleOs=/768x432/filters:format(webp):quality(85)/cloudfront-us-east-1.images.arcpublishing.com/infobae/Y6CUURF5LFDABO4GDCSPFLXH2Y.jpg">
    </figure>
    <div class="contenido-card">
      <h4 type="text" id="titulo" name="titulo">¿Las dietas veganas son viables para las mascotas?</h4>
       <p type="type" id="asunto" name="asunto">Las tendencias globales hacia una dieta libre de carne se han vuelto un tópico en la población</p>
      <a href="#">Leer Más</a>
    </div>
  </div>
  <div class="card">
    <figure>
      <img src="https://www.infobae.com/new-resizer/iWR_l0gfJrkq554PBf41C_Gmoq4=/265x149/filters:format(webp):quality(85)/cloudfront-us-east-1.images.arcpublishing.com/infobae/IRF7JT2DLFG3RP6WVHKC6EKMTA.png">
    </figure>
    <div class="contenido-card">
      <h4 type="text" id="titulo" name="titulo">Vacaciones con mascotas: cuáles son los trámites necesarios para viajar al exterior</h4>
      <p>Quienes viajen fuera del país deberán cumplir con una serie de requisitos del Senasa además de los que exija el país de destino. </p>
      <a href="#">Leer Más</a>
    </div>
  </div>
</div>
    </div>

  <!--Fin   Tarjetas 1, 2 3 -->

  

  <div class="row"> 
    <div class="title-cards">
    

  <div class="container-card">
    
  <div class="card">
    <figure>
      <!--imagen-->      
<img src="https://www.infobae.com/new-resizer/GkYPB3hOl4EgR2l7MKzzApRBrmE=/768x432/filters:format(webp):quality(85)/cloudfront-us-east-1.images.arcpublishing.com/infobae/L3OOG6FS7RH7FBUQJ3L2QGMFRE.jpg">
    </figure>
    <div class="contenido-card">
      <h4 type="text" id="titulo" name="titulo">¿Dejar salir al gato?, esto es lo que dice la ciencia</h4><!--titulo abajo copete--> 
      <p type="type" id="asunto" name="asunto">Los gatos son los animales de acompañamiento más independientes que pueden existir</p>
      <a href="#">Leer Más</a>
    </div>
  </div>
  <div class="card">
    <figure>
      <img src="https://www.infobae.com/new-resizer/QSYYLYtoAg6NV5PbWhJ_mHRlHsk=/768x432/filters:format(webp):quality(85)/cloudfront-us-east-1.images.arcpublishing.com/infobae/4TAC6IN2OVENPH2PEIB6QMRN5A.jpg">
    </figure>
    <div class="contenido-card">
      <h4 type="text" id="titulo" name="titulo">12 comidas de las Fiestas que un perro no debería comer</h4>
       <p type="type" id="asunto" name="asunto">La costumbre de compartir lo que queda en el plato con las mascotas es frecuente. Sin embargo, muchos alimentos pueden resultar perjudiciales para la salud de los animales</p>
      <a href="#">Leer Más</a>
    </div>
  </div>
  <div class="card">
    <figure>
      <img src="https://www.infobae.com/new-resizer/dJAH-kQz3B_tGfB0vMz84-IsoUc=/768x432/filters:format(webp):quality(85)/cloudfront-us-east-1.images.arcpublishing.com/infobae/F3ZTN6UMARCPNER2UZMSB6QT7Q.jpg">
    </figure>
    <div class="contenido-card">
      <h4 type="text" id="titulo" name="titulo">Cinco gatos que sacaron más de una risa en concurso de fotografía</h4>
      <p>Estos felinos son los ganadores de The Comedy Pet Photo Awards, concurso que tiene como objetivo concientizar a las personas</p>
      <a href="#">Leer Más</a>
    </div>
  </div>
</div>
    </div>

    <!--Fin   Tarjetas 4,5 y 6 -->

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

</body>
@endsection

