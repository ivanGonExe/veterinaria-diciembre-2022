const formulario = document.getElementById("formulario");
const textareas  = document.querySelectorAll("#formulario textarea");
const inputs     = document.querySelectorAll("#formulario input");
const cambio     = document.getElementsByClassName("formulario__input");

const expresiones = {
    patologia:     /^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ\s]{2,100}$/, // Letras y espacios, pueden llevar acentos.
    tratamiento:   /^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ\s]{8,200}$/, // Letras y espacios, pueden llevar acentos.
    observaciones: /^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ\s]{2,300}$/, // Validar Numero de Dni Solo Numeros y longitud 8 // Letras y espacios, pueden llevar acentos.
    peso:          /^[0-9]{1,3}$/, 
};

const campos = {
    patologia:     false,
    tratamiento:   false,
    observaciones: false,
    peso:          false,
};

let objeto = {
    patologia: "",
    tratamiento: "",
    observaciones: "" ,
    peso: "" ,
    idHistorialClinico: "" ,
};

const validarFormulario = (e) => {
    switch (e.target.name) {
        case "patologia":
            validarCampo(expresiones.patologia, e.target, "patologia");
            objeto.patologia = e.target.value;
            break;
        case "tratamiento":
            validarCampo(expresiones.tratamiento, e.target, "tratamiento");
            objeto.tratamiento = e.target.value;
            break;
        case "observaciones":
            validarCampo(expresiones.observaciones, e.target, "observaciones");
            objeto.observaciones = e.target.value;
            break;
        case "peso":
            validarCampo(expresiones.peso, e.target, "peso");
            objeto.peso = e.target.value;
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

textareas.forEach((textarea ) => {
    textarea.addEventListener("keyup", validarFormulario); //cuando se levante la tecla
    textarea.addEventListener("blur", validarFormulario); //cuando le de un click fuera del imput */ */
});

inputs.forEach((input ) => {
    input.addEventListener("keyup", validarFormulario); //cuando se levante la tecla
    input.addEventListener("blur", validarFormulario); //cuando le de un click fuera del imput */ */
});

formulario.addEventListener("submit", async(e) => {
    e.preventDefault();

    if (
        campos.patologia &&
        campos.tratamiento &&
        campos.observaciones &&
        campos.peso
    ) {
        let token = document.getElementById("token");
        let idHistorialClinico = document.getElementById("idHistorialClinico");

        objeto.idHistorialClinico = idHistorialClinico.value;
        console.log(objeto);
        const respuesta = await fetch('/detalleClinico/store', {
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
            console.log(data["errores"]);
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
                title: "Detalle clínico Guardado",
                showConfirmButton: false,
                timer: 4000,
            });
            
            setTimeout(() => {
                location.href = "/historialesClinicos/" + objeto.idHistorialClinico;
            }, 4000);
            
        }
        /* 		document.getElementById('formulario__mensaje-exito').classList.add('formulario__mensaje-exito-activo'); */
        //setTimeout(() => {
            /* 	document.getElementById('formulario__mensaje-exito').classList.remove('formulario__mensaje-exito-activo'); */

            //formulario.submit();
        //}, 4000);

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
