@extends((auth()->user()->tipo == 'admin')? ((auth()->user()->estadoIngreso =='veterinario')? 'layouts.plantillaBase':'layouts.plantillaBase3') : ( (auth()->user()->tipo == 'veterinario')? 'layouts.plantillaBase' :'layouts.plantillaBase3'))

<!--Jquery-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<!--Floating WhatsApp css-->
<link rel="stylesheet" href="https://rawcdn.githack.com/rafaelbotazini/floating-whatsapp/3d18b26d5c7d430a1ab0b664f8ca6b69014aed68/floating-wpp.min.css">
<!--Floating WhatsApp javascript-->
<script type="text/javascript" src="https://rawcdn.githack.com/rafaelbotazini/floating-whatsapp/3d18b26d5c7d430a1ab0b664f8ca6b69014aed68/floating-wpp.min.js"></script>
<style>

.formulario{
background-color: #ffffff;
padding: 20px;
margin: 5px;
border-radius: 10px;

}
.formulario__input:hover{
background-color: silver;
}
.formulario__input {
width: 100%;
height: 45px;
line-height: 45px; /*cuando se escriba adentro*/
/*padding: arriba derecha abajo izquierda*/
padding: 0px 40px 0 10px;
transition: 0.3s ease all; /*transicion de tiempo para todas las propiedades*/
}.a{
    font-size: 16px;
}
.card-header{
font-size: 16px;
border-radius: 10px;
background-color: #fff !important;
}
.box-input{
	border-bottom: 1px solid #000000;
	position: relative;
	margin: 30px 0px;
  
} 
label{
    margin: 5px;
}
.box-input input{

    font-size: 14px;
	color: #333;
	border: none;
	width: 100%;
	outline: none;
	background: none;
	padding: 0 5px;
	height: 40px;
   
} 
.box-input .mensaje{

    font-size: 20px;
 
}.mensaje:hover{
    background-color: rgb(122, 116, 116,0.3);
    zoom: 101%;
}



.boton{
	display: block;
	width: 50%;
	height: 50px;
   
    align-content: center;
	
	background-color: #0b743f;
	color: #fff;
    border: solid 2px #2F855A;
	border-radius: 5px;
	font-weight: 600;
	font-size: 18px;
	box-shadow: 2px 2px 5px 2px rgba(0, 0, 0, 0.1);
    width: 100%;
    height: 40px;
}

.boton:hover{
	
    background-color: #48bb78;
    color:#000000;
	border: solid 2px #2F855A;
	transition: 0.2s;
  
} */

.botonVolver{

    
}

</style>
@section('contenido')


    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" charset="utf-8"></script>
    <!-- <link rel="stylesheet" href="style.css"> -->
</head>
<body>
<div class='text-end botonVolver '>
    <a type=""class="btn btn-secondary rounded-pill botonVolver"  id="botonVolver" href="{{url()->previous()}}"><i class="fa-solid fa-arrow-rotate-left"></i></a>
</div>
<input type="hidden" id="nombre" value="{{$persona->nombre}} {{$persona->apellido}}">
<input type="hidden" id="telefono" value="{{$celular}}">
<input type="hidden" id="fecha" value="{{$fecha}}">
<input type="hidden" id="hora" value="{{$hora}}">

   <div class="container-fluid d-flex justify-content-center"> 
            
            <form id="formulario" class="formulario">
              
                <div class="card-header text-center">Enviar WhatsApp al Cliente</div>
                <div class="box-input">
                    <label>Nombre</label>
                    <input name="nombre" id="nombre" type="text" class="text-center text-white  bg-success" value="{{$persona->nombre}} {{$persona->apellido}}" disabled>
                    </div>
                    <div class="box-input">
                        <label>Celular</label>
                        <input name="telefono" id="telefono" type="text" class="text-center text-white  bg-success" value="{{$celular}}" disabled>
                        </div>
            
                <div class="box-input" >
                    <label>Mensaje</label>
                    <input name="mensaje" id="mensaje" class="mensaje" type="areatext" value="" placeholder="Escriba su mensaje..." >
                    
                </div>
                <div class="container-fluid d-flex justify-content-center"> 

               
                <button id="submit" type="submit" class="boton text-center"><i class="fab fa-whatsapp"></i> Enviar</button>
                   </div>           
            </form>

        </div>
   </div>
    

<script>
     function isMobile() {
    if (sessionStorage.desktop)
        return false;
    else if (localStorage.mobile)
        return true;
    var mobile = ['iphone', 'ipad', 'android', 'blackberry', 'nokia', 'opera mini', 'windows mobile', 'windows phone', 'iemobile'];
    for (var i in mobile)
        if (navigator.userAgent.toLowerCase().indexOf(mobile[i].toLowerCase()) > 0) return true;
    return false;
}

const formulario = document.querySelector('#formulario');
const buttonSubmit = document.querySelector('#submit');
const urlDesktop = 'https://web.whatsapp.com/';
const urlMobile = 'whatsapp://';
const telefono = document.querySelector('#telefono').value;
console.log(telefono);

formulario.addEventListener('submit', (event) => {
    event.preventDefault()
    console.log('entro');
    console.log(telefono);
    buttonSubmit.innerHTML = '<i class="fas fa-circle-notch fa-spin"></i>'
    buttonSubmit.disabled = true
    setTimeout(() => {
        let nombre = document.querySelector('#nombre').value;
        //  let fecha = document.querySelector('#fecha_hora').value; 
       
        let mensajeFormulario = document.querySelector('#mensaje').value;
          let mensaje = 'send?phone=' + telefono + '&text=*‼️Nos comunicamos de Veterinaria San Agustin‼️*' 
          +'%0A'+'Estimado/a: '+ nombre +' '+ mensajeFormulario ;

        // let mensaje = 'send?phone=' + telefono + '&text=*‼️Recordario de Turno‼️*%0A' 
        // +'Estimado/a: '+ nombre + '%0A'+'%0A'+ mensajeFormulario +'%0A*VETERINARIA SAN AGUSTIN*%0A' ;
        if(isMobile()) {
            window.open(urlMobile + mensaje, '_blank')
        }else{
            window.open(urlDesktop + mensaje, '_blank')
        }
        buttonSubmit.innerHTML = '<i class="fab fa-whatsapp"></i> Enviar WhatsApp'
        buttonSubmit.disabled = false
    }, 10);
});

    </script> 

  {{--   <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <!-- <script src="whatsapp.js"></script> --> --}}
</body>
</html>

























{{-- <input type="hidden" id="nombre" value="{{$persona->nombre}} {{$persona->apellido}}">
<input type="hidden" id="telefono" value="{{$persona->telefonos[0]->numero}}">
<input type="hidden" id="fecha" value="{{$fecha}}">
<input type="hidden" id="hora" value="{{$hora}}">


<h2 class="text-center p-2 m-2 fs-1 fw-bold text-dark" >Desear Enviar el Mensaje WhatsApp<div id="WAButton" class="icono"></div>
</h2>



<script>  

window.onload = function(){ 
 
var nombre = document.getElementById('nombre').value; 
var telefono = '+549343'+ document.getElementById('telefono').value; 
var fecha = document.getElementById('fecha').value;
var hora = document.getElementById('hora').value; 



    $(function(){
    
       $('#WAButton').floatingWhatsApp({
         phone: telefono, //WhatsApp Business phone number International format-
         //Get it with Toky at https://toky.co/en/features/whatsapp.
         headerTitle: '--Veterinaria San Agustin--', //Popup Title
         popupMessage: 'Notificación Turno:'+telefono, //Popup Message
         showPopup: true, //Enables popup display
         size:'120px',
         message: 'Hola ,'+nombre+','+' le informamos, que en la fecha y horario '+fecha+' '+hora+' '+'tiene el turno correspondiente.Gracias'

/*             buttonImage: '<img src="https://rawcdn.githack.com/rafaelbotazini/floating-whatsapp/3d18b26d5c7d430a1ab0b664f8ca6b69014aed68/whatsapp.svg" />', //Button Image */
         //headerColor: 'crimson', //Custom header color
         //backgroundColor: 'crimson', //Custom background button color
        /*  position: "center"  */

       });
     });

 } 



  
     </script>  
 --}}

@endsection