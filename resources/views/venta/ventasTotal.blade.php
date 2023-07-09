@extends('layouts.plantillaBase2')
    <!-- select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button { 
  -webkit-appearance: none; 
  margin: 0; 
}

input[type=number] { -moz-appearance:textfield; }
.marco{
background-color: rgb(255, 255, 255);
border: 1px solid #000;
border-radius: 10px;
padding: 20px;
margin: 50px;
height:auto;
box-shadow: 2px 2px 2px 1px rgba(0, 0, 0, 0.2);
} 
.container-fluid{
    padding: 10px;  
}
</style>

@section('contenido')
<body>
 <div class="marco">
    <div class="container-fluid d-flex justify-content-center  text-light ">
        <h4 class="text-center p-2 m-2 fs-1 fw-bold text-dark" >Seleccione método de pago</h4>
    
    </div>
<form action="/ventas/confirmarVenta/{{$venta->id}}" method="Post">
    @csrf
    @method('Post')
    <div class="container-fluid d-flex justify-content-center  text-light">
        <select  id='tipoPago' class="js-example-basic-single" name="tipoPago" style="width:70%">
                <option value="efectivo">Efectivo</option>
                <option value="debito">Debito</option>
                <option value="tarjetaDeCredito">Tarjeta de Crédito</option>
        </select>
    </div>
    <br>
    <br>
        <div class="row text-center"> 
            <div class="col-6">
                <h4 class="text-black" >Costo total: ${{$venta->total}}</h4>
                <input type='hidden' id='total' id="total" value ='{{$venta->total}}' step="0.01">
                <div id="contenedorVuelto">
                        <h4 class="text-black " id="vuelto" step="0.01" >Vuelto: </h4>
                </div>
            </div>
            <div class="col-6">
                <label class="pesos text-dark">$<label><input type="number" name="pago" id="pago" step="0.1" >
            </div>
        </div>
        <div class="row"> 
        <div class="col-12 p-2"></div>
        <div class="col-2"></div>
            <div class="col-8 text-center">
            <button class="btn btn-primary" type="submit" id='boton' disabled><i class="fa-solid fa-sack-dollar"></i> Confirmar</button>
            </div>
            <div class="col-2"></div>
        </div>
    </div>
</div>
</form>
</div>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11">                                 </script>
    <script src="  https://code.jquery.com/jquery-3.5.1.js">                             </script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js">         </script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js">     </script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>

        $(document).ready(function () {

           $('.js-example-basic-single').select2();
      

        });
    
    </script>
    <script>
        let boton     = document.getElementById('boton');
        let vuelto    = document.getElementById('vuelto');
        let total     = document.getElementById('total');
        let monto     = document.getElementById('pago');
        let divVuelto = document.getElementById('contenedorVuelto');

        monto.addEventListener('keyup',function(){

        let montoAux = parseFloat(document.getElementById('pago').value);
        let totalAux = parseFloat(document.getElementById('total').value);

        let conversion = Number(monto.value).toFixed(2);
        let cadena     =  monto.value.split('.');
        
        if(cadena.length == 2){
            if(cadena[1].length > 2){
                monto.value = conversion;
            }
        }

            if(montoAux < totalAux){

                if(document.getElementById("vuelto")){
                    document.getElementById("vuelto").remove();
                }
                
                let texto      = document.createTextNode('vuelto: $');
                boton.disabled = true;
                
            }else if(montoAux >= totalAux){

                if(document.getElementById("vuelto")){
                    document.getElementById("vuelto").remove();
                }
                boton.disabled    = false;
                let vueltoCalAux  = montoAux - totalAux;
                let vueltoCal     = vueltoCalAux.toFixed(2);
                let h4            = document.createElement('h4');

                h4.setAttribute('id','vuelto');
                
                if(vueltoCal <= 0 ){

                    if(document.getElementById("vuelto")){
                        document.getElementById("vuelto").remove();
                    }

                    let texto = document.createTextNode('vuelto: $');
                    h4.append(texto);
                    divVuelto.append(h4);
                }else{

                    if(document.getElementById("vuelto")){
                        document.getElementById("vuelto").remove();
                    }
                    
                    let texto = document.createTextNode('vuelto: $'+ vueltoCal);
                    h4.append(texto);
                    divVuelto.append(h4);
                }   
            }
        })
    </script>

    
</body>
@endsection