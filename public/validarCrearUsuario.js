const formulario = document.getElementById("formulario");
const inputs = document.querySelectorAll("#formulario input");
const cambio = document.getElementsByClassName("formulario__input");

const expresiones = {
    name: /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{2,30}$/, // Letras y espacios, pueden llevar acentos.
    email: /^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/, // email. /@.*\.com$/i
    password: /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])\w{8,}$/, // Debe contener al menos una letra, un número, una mayúscula y mínimo 8 caracteres.
    passwordConfirmation: /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])\w{8,}$/, //Debe contener al menos una letra, un número, una mayúscula y mínimo 8 caracteres.
    // codigoArea: /^[0-9]{3,7}$/, // 0 - 9 numeros
    // numeroCalle: /^[0-9]{1,4}$/, // 0 - 5 numeros
    // direccion: /^([a-zA-Z0-9áéíóúÁÉÍÓÚñÑ\s]){1,30}$/, // Letras y espacios, pueden llevar acentos.
};
const campos = {
    name: false,
    email: false,
    password: false,
    passwordConfirmation: false,
    // codigoArea: false,
    // seleccionTurno: false,
    // numeroCalle: false,
    // direccion: false,
};

const validarFormulario = (e) => {
    switch (e.target.name) {
        case "name":
            validarCampo(expresiones.name, e.target, "name");
            break;
        case "email":
            validarCampo(expresiones.email, e.target, "email");
            break;
        case "password":
            validarCampo(expresiones.password, e.target, "password");
            break;
        case "password-confirmation":
            validarCampo(expresiones.passwordConfirmation, e.target, "password-confirm");
            break;
        // case "codigoArea":
        //     validarCampo(expresiones.codigoArea, e.target, "codigoArea");
        //     break;
        // case "numeroCalle":
        //     validarCampo(expresiones.numeroCalle, e.target, "numeroCalle");
        //     break;
        // case "direccion":
        //     validarCampo(expresiones.direccion, e.target, "direccion");
        //     break;
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
        campos.name &&
        campos.email
        // campos.dni &&
        // campos.telefono &&
        // campos.codigoArea &&
        // campos.direccion &&
        // campos.numeroCalle
    ) {
        Swal.fire({
            position: "top-center",
            icon: "success",
            title: "Usuario Guardado",
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
