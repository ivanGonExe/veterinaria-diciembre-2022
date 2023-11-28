const formulario = document.getElementById("formulario");
const inputs = document.querySelectorAll("#formulario input");

let objeto = {
    nombre: "", 
    apellido: "", 
    dni: "", 
    direccion: "", 
    numeroCalle: "" ,
  };

const expresiones = {
    nombre: /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{2,30}$/, // Letras y espacios, pueden llevar acentos.
    apellido: /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{2,30}$/, // Letras y espacios, pueden llevar acentos.
    dni: /^[0-9]{1,8}$/, // Validar Numero de Dni Solo Numeros y longitud 8
    numeroCalle: /^[0-9]{1,5}$/, // 0 - 5 numeros
    direccion: /^([a-zA-Z0-9áéíóúÁÉÍÓÚñÑ\s]){1,30}$/, // Letras y espacios, pueden llevar acentos.
};
const campos = {
    nombre: false,
    apellido: false,
    dni: false,
    seleccionTurno: false,
    numeroCalle: false,
    direccion: false,
};

const validarFormulario = (e) => {
    switch (e.target.name) {
        case "nombre":
            validarCampo(expresiones.nombre, e.target, "nombre");
            objeto.nombre = e.target.value;
            break;
        case "apellido":
            validarCampo(expresiones.apellido, e.target, "apellido");
            objeto.apellido = e.target.value;
            break;
        case "dni":
            validarCampo(expresiones.dni, e.target, "dni");
            objeto.dni = e.target.value;
            break;
        case "numeroCalle":
            validarCampo(expresiones.numeroCalle, e.target, "numeroCalle");
            objeto.numeroCalle = e.target.value;
            break;
        case "direccion":
            validarCampo(expresiones.direccion, e.target, "direccion");
            objeto.direccion = e.target.value;
            break;
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
for (let i = 2; i < longitud - 1; i++) {
    inputs[i].addEventListener("keyup", validarFormulario); //cuando se levante la tecla
    inputs[i].addEventListener("blur", validarFormulario); //cuando le de un click fuera del imput */ */
}

formulario.addEventListener("submit", async(e) => {
    e.preventDefault();

    if (
        campos.nombre &&
        campos.apellido &&
        campos.dni &&
        campos.direccion &&
        campos.numeroCalle
    ) {
        let token = document.getElementById("token");
        let idPersona = document.getElementById("idPersona");


        const respuesta = await fetch('/personas/editar/' + idPersona.value, {
            method: 'POST',
            mode: 'cors',
            headers:{
            'X-CSRF-TOKEN': token.value,
            'Content-Type': 'application/json'
            },
    
            body: JSON.stringify(objeto),
        });
    
    
        const data = await respuesta.json();
        //Si hay errores
        if(data["errores"]){
        
            let errores = data["errores"];
            let mensaje = `<div class="text-center text-danger">`;
            for(let i = 0; i < errores.length; i++){
            mensaje += "<h6>" + errores[i] + "</h6>";
            }
            mensaje+= "</div>";
            
            
            Swal.fire({
            icon: 'error',
            title: 'Error',
            html: mensaje,
            });
        }
    
        if(data["valido"]){ 
            Swal.fire({
                position: "top-center",
                icon: "success",
                title: data["valido"],
                showConfirmButton: false,
                timer: 4000,
            });
            
            setTimeout(() => {
            location.href = "/personas";
            }, 4000);
            
        }
       
        // /* 		document.getElementById('formulario__mensaje-exito').classList.add('formulario__mensaje-exito-activo'); */
        // setTimeout(() => {
        //     /* 	document.getElementById('formulario__mensaje-exito').classList.remove('formulario__mensaje-exito-activo'); */

        //     formulario.submit();
        // }, 3000);

        // document
        //     .querySelectorAll(".formulario__grupo-correcto")
        //     .forEach((icono) => {
        //         icono.classList.remove("formulario__grupo-correcto");
        //     });
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

let nombre = document.getElementsByName("nombre");
let apellido = document.getElementsByName("apellido");
let dni = document.getElementsByName("dni");
let numeroCalle = document.getElementsByName("numeroCalle");
let direccion = document.getElementsByName("direccion");
let formulario__mensaje = document.getElementById("formulario__mensaje");

validarCampo(expresiones.nombre, nombre[0], "nombre");
validarCampo(expresiones.apellido, apellido[0], "apellido");
validarCampo(expresiones.dni, dni[0], "dni");
validarCampo(expresiones.numeroCalle, numeroCalle[0], "numeroCalle");
validarCampo(expresiones.direccion, direccion[0], "direccion");

objeto.nombre = nombre[0].value;
objeto.apellido = apellido[0].value;
objeto.dni = dni[0].value;
objeto.numeroCalle = numeroCalle[0].value;
objeto.direccion = direccion[0].value;

formulario__mensaje.style.display = "none";

//--------------------------------------------
