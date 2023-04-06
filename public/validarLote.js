const formulario = document.getElementById("formulario");
const inputs = document.querySelectorAll("#formulario input");
const fechaVencimiento = document.getElementById("vencimiento"); 

const expresiones = {
    
    precioCompra: /^[0-9]{1,8}$/,  // Validar Numero de codigo Solo Numeros y longitud 4
    unidades: /^[0-9 ]{1,8}$/, // Validar Numero de codigo Solo Numeros y longitud 8
   /*  vecimiento:/^([a-zA-Z0-9_\s\.]){1,30}$/,   */



};
const campos = {
    precioCompra:false,
   unidades: false,
/*     vencimiento: true,   */
  
};

const validarFormulario = (e) => {
    switch (e.target.name) {
        case "precioCompra":
            validarCampo(expresiones.precioCompra, e.target, "precioCompra");
            break;
         case "unidades":
            validarCampo(expresiones.unidades, e.target, "unidades");
            break;
          /* case "vencimiento":
            validarCampo(expresiones.vecimiento, e.target, "vencimiento");
            break; */
            }   
};

const validarCampo = (expresion, input, campo) => {
    if (expresion.test(input.value)) {
        document
            .getElementById(`grupo__${campo}`)
            .classList.remove("formulario__grupo-incorrecto");
        document
            .getElementById(`grupo__${campo}`)
            .classList.add("formulario__grupo-correcto");
        document
            .querySelector(`#grupo__${campo} i`)
            .classList.remove("fa-times-circle");
        document
            .querySelector(`#grupo__${campo} i`)
            .classList.add("fa-check-circle");
        document
            .querySelector(`#grupo__${campo} .formulario__input-error`)
            .classList.remove("formulario__input-error-activo");
        campos[campo] = true;
    } else {
        document
            .getElementById(`grupo__${campo}`)
            .classList.add("formulario__grupo-incorrecto");

        document
            .querySelector(`#grupo__${campo} i`)
            .classList.remove("fa-check-circle");
        document
            .querySelector(`#grupo__${campo} i`)
            .classList.add("fa-times-circle");
        document
            .querySelector(`#grupo__${campo} .formulario__input-error`)
            .classList.add("formulario__input-error-activo");
        campos[campo] = false;
    }
};

let longitud = inputs.length;
for (let i = 0; i < longitud; i++) {
    inputs[i].addEventListener("keyup", validarFormulario); //cuando se levante la tecla
    inputs[i].addEventListener("blur", validarFormulario); //cuando le de un click fuera del imput */ */
}



let precioAnterior = Number( document.getElementById('precioCompra').value);

formulario.addEventListener("submit", (e) => {
    e.preventDefault();
    let precioActual =  Number(document.getElementById('precioCompra').value);

    if (precioCompra && unidades ) {

    //  Detecta el cambio de precio
        if(precioAnterior != precioActual){
             //condiciond de que supere el mino de ganancia
             
            if((((articulos.precioVenta - precioActual)*100)/precioActual)<articulos.porcentGanancia){
                //muestro el modal y seteo los datos
                $("#exampleModal").modal("show");
                document.getElementById('precioUnitLote').value = precioActual;
                document.getElementById('aumento').value        = articulos.porcentGanancia;

                let varAux = precioActual* (1+(articulos.porcentGanancia/100));

                document.getElementById('montoAumentado').value = varAux.toFixed(2);

                //funcion de calculo de monto aumentado segun porcentaje
                    let aumento = document.getElementById('aumento');
                    aumento.addEventListener('keyup', function(){
                        let montoAumentado  = document.getElementById('montoAumentado');
                        
                        // control de que el porcentaje tenga dos lugares depues de la coma
                        let cadenaAux = aumento.value.split('.');
                        let conversionAux = Number(aumento.value).toFixed(1);
                        if(cadenaAux.length > 1){
                            if(cadenaAux[1].length > 1){
                                aumento.value = conversionAux;
                            }
                        }
                        if(this.value > 101 ) 
                            this.value = this.value.slice(0,3);
                        if(this.value < 0)
                            this.value = 0;
                        let porcentaje = Number(aumento.value);
                        let precioAux = precioActual* (1+(porcentaje/100));  
                        montoAumentado.value = precioAux.toFixed(2); 

                    })

                // funcion de calculo de porcentaje segun el monto colocado

                    let montoAumentado = document.getElementById('montoAumentado');
    
                    montoAumentado.addEventListener('keyup', function(){
    
                        let aumento         = document.getElementById('aumento');
                        let precioUnitLote  = document.getElementById('precioUnitLote'); 
                        let numaumento      = Number(montoAumentado.value);
                        let numPrecio       = Number(precioUnitLote.value);
                //control de que no halla mas de dos numeros en los inputs
   
                        let conversion = Number(montoAumentado.value).toFixed(2);
                        let cadena     =  montoAumentado.value.split('.');
    
                        if(cadena.length == 2){
                            if(cadena[1].length > 2){
                                montoAumentado.value = conversion;
                            }
                        }
                        
                        let montoAux     = (numaumento-numPrecio)*100/numPrecio ;
                        aumento.value    = montoAux.toFixed(2);
                        if(aumento.value<0){
                            document.getElementById('modalAplicar').disabled = true;
                        }
                        else{
                            document.getElementById('modalAplicar').disabled = false;
                        }
                        
                        })

                        let precioProducto  = document.getElementById('precioProducto');

                        montoAumentado.addEventListener('input',function(){

                        let aumento         = document.getElementById('aumento');
                        let precioProducto  = document.getElementById('precioProducto'); 
                        let numaumento      = parseFloat(montoAumentado.value);
                        let numPrecio       = parseFloat(precioProducto.value);
                    //control de que no halla mas de dos numeros en los inputs
   
                        let conversion = Number(montoAumentado.value).toFixed(2);
                        let cadena     =  montoAumentado.value.split('.');
                        if(cadena.length == 2){
                            if(cadena[1].length > 2){
                                montoAumentado.value = conversion;
                            }
                        }
                    })

            //ajax para el guardado de la configuracion nueva y el precio nuevo de venta del articulo
                let botonAplicar = document.getElementById('modalAplicar');
                botonAplicar.addEventListener('click', function(){
                    
                $.ajax({
                    type: "GET",
                    url: "/Guardar/ConfigArticulo",
                    data: {
                        id:articulos.id,
                        porcentaje:aumento.value,
                        precioVenta:montoAumentado.value,
                        _token: $('input[name="_token"]').val(),
                    },
                }).done(function (res) {
                    console.log(typeof(res) );
                    if(res == 'false'){
                        Swal.fire('No se ha guardado correctamente la configuracion del articulo, intentelo mas tarde')
                    }
                    if( res == 'true'){
                        Swal.fire({
                            position: "top-center",
                            icon: "success",
                            title: " configuracion y Lote Guardado",
                            showConfirmButton: false,
                            timer: 6000,
                        });
                        
                        formulario.submit();
                    }
                
                });
            });

        }
    
    else{
        alert('entro');
            Swal.fire({
                position: "top-center",
                icon: "success",
                title: "Lote Guardado",
                showConfirmButton: false,
                timer: 6000,
            });
            formulario.submit();
        }

        document
            .querySelectorAll(".formulario__grupo-correcto")
            .forEach((icono) => {
                icono.classList.remove("formulario__grupo-correcto");
            });
    } else {
        console.log("entro a la parte de mostrar el mensaje de error ");
        document
            .getElementById("formulario__mensaje")
            .classList.add("formulario__mensaje-activo");
        setTimeout(() => {
            document
                .getElementById("formulario__mensaje")
                .classList.remove("formulario__mensaje-activo");
        }, 3000);
    }
}});

//comprobar los input al inicio

let precioCosto = document.getElementsByName("precioCosto");
let unidades = document.getElementsByName("unidades");
let formulario__mensaje = document.getElementById("formulario__mensaje");
validarCampo(expresiones.precioCosto,precioCosto[0],"precioCosto");
validarCampo(expresiones.unidades,unidades[0],"unidades");
formulario__mensaje.style.display = "none"; ç

//Algoritmo de calculo de porcentaje y monto final





aumento.addEventListener('input',function(){
    if (this.value > 100 ) 
        this.value = this.value.slice(0,2);
    if (this.value < 0)
        this.value = 0; 
})

