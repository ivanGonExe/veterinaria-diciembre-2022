     
     @extends('menu')
  
     @section('formulario')
    <!-- estilos CSS -->
  
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
    

      <style>
    p{
      color:black;
      size: 14px;
      text-align: justify;
    }
    #asunto{
       color:black !important;
    }
     </style> 
<body>
  <body  class="bg-white">
  

  <div class="container">
    <div class="row">
  

        <div class="col-2"></div>
        <div class="col-8">
           
            <h3 type="text" id="titulo" name="titulo" class="text-center fw-bold m-3" >{{$noticia->titulo}}</h3><!--titulo abajo copete--> 
           
            <img src="{{$noticia->file}}" height="400" width="700">
            <div class="container-fluid d-flex justify-center">
            <div type="type" id="asunto" name="asunto" class="text-dark m-3">
                {!!$noticia->asunto!!}
            </div>
           
        </div>
        <div class="col-2"></div>

 
     </div>
   
   
    
  </div>
</div>



  </div>
  <div class="row"> 
 


   

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

</body>
@endsection

