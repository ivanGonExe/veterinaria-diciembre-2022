const formulario = document.getElementById("formulario");
const inputs = document.querySelectorAll("#formulario input");

let descripcion = document.getElementsByName("descripcion");
let cerrar = document.getElementById('cerrar');



const expresiones = {
    descripcion: /^([a-zA-Z0-9áéíóúÁÉÍÓÚñÑ\s]){1,100}$/, // Letras y espacios, pueden llevar acentos.

};
const campos = {
    descripcion: false,
};

const validarFormulario = (e) => {
    switch (e.target.name) {
        case "descripcion":
            validarCampo(expresiones.descripcion, e.target, "descripcion");
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
for (let i = 0; i < longitud; i++) {
    inputs[i].addEventListener("keyup", validarFormulario); //cuando se levante la tecla
    inputs[i].addEventListener("blur", validarFormulario); //cuando le de un click fuera del imput */ */
}

formulario.addEventListener("submit", (e) => {
    e.preventDefault();

    if (
        campos.descripcion 
      
    ) {
        Swal.fire({
            position: "top-center",
            icon: "success",
            title: "Categoria Guardada",
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
cerrar.addEventListener('click',()=>{
 
  document
            .getElementById(`grupo__descripcion`)
            .classList.remove("formulario__grupo-incorrecto");
        document
            .getElementById(`grupo__descripcion`)
            .classList.add("formulario__grupo-correcto");
        document
            .querySelector(`#grupo__descripcion i`)
            .classList.remove("fa-times-circle");
    
        document
            .querySelector(`#grupo__descripcion .formulario__input-error`)
            .classList.remove("formulario__input-error-activo");

})

if(descripcion[0].value != "")
{


validarCampo(expresiones.descripcion, descripcion[0], "descripcion");

formulario__mensaje.style.display = "none"; 
}

