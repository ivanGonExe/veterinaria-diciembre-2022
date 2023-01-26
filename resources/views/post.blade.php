     
     @extends('menu')
  
     @section('formulario')
    <!-- estilos CSS -->
  
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
    
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Gluten:wght@600&display=swap" rel="stylesheet">
  <style>


h1,h2,h3,h4,p,a{
font-family: 'Gluten', cursive;
color:black;
text-align: justify;

}
.asunto{
  text-align: justify;
  text-indent: 40px;
line-height: 3em;
}
.titulo{
  color:rgb(73, 1, 141);
  text-shadow: 18px 7px 17px rgba(0,0,0,0.1);
}
.zoom {
    transition: transform .20s; 
}
 
.zoom:hover {
    transform: scale(1.2); 
    border: 10px solid #000000;
}
     </style> 
<body>
  <body  class="bg-white">
  

  <div class="container">
  

           
            <h3 type="text" id="titulo" name="titulo" class="titulo text-center fw-bold p-3 m-3" >{{$noticia->titulo}}</h3><!--titulo abajo copete--> 
            <div class="container-fluid d-flex justify-content-center p-4 m-4">
            <img src="{{$noticia->file}}" class="imagen zoom" height="400" width="600">
            </div>
            <div class="container-fluid d-flex justify-content-center">
            <div class="row">
                  <div class="col-2"></div>
                  <div class="col-8">
                        <div type="type" id="asunto" name="asunto" class="asunto">
                                        
                        {!!$noticia->asunto!!}
                      </div>
                 <div class="col-2"></div>
            </div>
            
           
        </div>
      

 
     </div>
   
   
    
  </div>
</div>



  </div>
  <div class="row"> 
 


   

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

</body>
@endsection

