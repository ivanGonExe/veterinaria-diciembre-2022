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
console.log("entro")
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




formulario.addEventListener("submit", (e) => {
    e.preventDefault();

    if (
        precioCompra && unidades 
    ) {
        Swal.fire({
            position: "top-center",
            icon: "success",
            title: "Lote Guardado",
            showConfirmButton: false,
            timer: 4000,
        });

        /* 		document.getElementById('formulario__mensaje-exito').classList.add('formulario__mensaje-exito-activo'); */
        setTimeout(() => {
            /* 	document.getElementById('formulario__mensaje-exito').classList.remove('formulario__mensaje-exito-activo'); */

            formulario.submit();
        }, 4000);

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
});

//comprobar los input al inicio

let precioCosto = document.getElementsByName("precioCosto");
let unidades = document.getElementsByName("unidades");
let formulario__mensaje = document.getElementById("formulario__mensaje");
validarCampo(expresiones.precioCosto,precioCosto[0],"precioCosto");
validarCampo(expresiones.unidades,unidades[0],"unidades");
formulario__mensaje.style.display = "none"; 

