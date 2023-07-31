
const formulario = document.getElementById("formulario");
const inputs     = document.querySelectorAll("#formulario input");
const cambio     = document.getElementsByClassName("formulario__input");

const expresiones = {
    descripcion:  /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s,-]{10,300}$/, 
    direccion:    /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s,-]{4,200}$/, 
    celular:      /^\+\d{1,3}\s?\d{1,}\s?\d{1,}$/, 
    telefonoFijo: /^\+\d{1,3}\s?\(\d{1,}\)\s?\d{1,}\s?\d{1,}$/, // 0 - 9 numeros
    instagram:    /^(?:https?:\/\/)?(?:www\.)?instagram\.com\/[a-zA-Z0-9_\.]+\/?$/, // 0 - 9 numeros
    mapa:         /\S/, // 0 - 5 numeros
};
const campos = {
    descripcion:  false,
    direccion:    false,
    celular:      false,
    telefonoFijo: false,
    intagram:     false,
    mapa:         false,
};

const validarFormulario = (e) => {
    switch (e.target.name) {
        case "descripcion":
            validarCampo(expresiones.descripcion, e.target, "descripcion");
            break;
        case "direccion":
            validarCampo(expresiones.direccion, e.target, "direccion");
            break;
        case "celular":
            validarCampo(expresiones.celular, e.target, "celular");
            break;
        case "telefonoFijo":
            validarCampo(expresiones.telefonoFijo, e.target, "telefonoFijo");
            break;
        case "intagram":
            validarCampo(expresiones.intagram, e.target, "intagram");
            break;
        case "mapa":
            validarCampo(expresiones.mapa, e.target, "mapa");
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

inputs.forEach((input) => {
    input.addEventListener("keyup", validarFormulario); //cuando se levante la tecla
    input.addEventListener("blur", validarFormulario); //cuando le de un click fuera del imput */ */
});

formulario.addEventListener("submit", (e) => {
    e.preventDefault();

    if (
        campos.descripcion &&
        campos.direccion &&
        campos.celular &&
        campos.telefonoFijo &&
        campos.instagram &&
        campos.mapa 
    ) {
        Swal.fire({
            position: "top-center",
            icon: "success",
            title: "Información de empresa guardada",
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
