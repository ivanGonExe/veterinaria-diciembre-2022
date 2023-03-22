const formulario = document.getElementById("formulario");
const inputs = document.querySelectorAll("#formulario input");

const expresiones = {
    descripcion: /^([a-zA-Z-ZÀ-ÿ-0-9_-\s\.\/]){1,200}$/, // Letras y espacios, pueden llevar acentos.
    minimoStock: /^[0-9]{1,3}$/, // Validar Numero de codigo Solo Numeros y longitud 4
    iva: /^[0-9]{1,2}$/, // 0 - 2 numeros
    precioVenta: /^[0-9]{1,8}$/, // 0 - 8 numeros
    alerta: /^[0-9]{1,3}$/, // Validar Numero de codigo Solo Numeros y longitud 3
};
const campos = {
    descripcion: false,
    minimoStock: false,
    iva: false,
    seleccionTurno: false,
    precioVenta: false,
    alerta: false,
};

const validarFormulario = (e) => {
    switch (e.target.name) {
        case "descripcion":
            validarCampo(expresiones.descripcion, e.target, "descripcion");
            break;
        case "minimoStock":
            validarCampo(expresiones.minimoStock, e.target, "minimoStock");
            break;
        case "iva":
            validarCampo(expresiones.iva, e.target, "iva");
            break;
        case "precioVenta":
            validarCampo(expresiones.precioVenta, e.target, "precioVenta");
            break;
        case "alerta":
            validarCampo(expresiones.alerta, e.target, "alerta");
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
        campos.descripcion &&
        campos.minimoStock &&
        campos.iva &&
        campos.precioVenta &&
        campos.alerta
    ) {
        Swal.fire({
            position: "top-center",
            icon: "success",
            title: "Artículo Guardado",
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
let iva = document.getElementsByName("iva");
let alerta = document.getElementsByName("alerta");
validarCampo(expresiones.iva, iva[0], "iva");
validarCampo(expresiones.alerta, alerta[0], "alerta");
