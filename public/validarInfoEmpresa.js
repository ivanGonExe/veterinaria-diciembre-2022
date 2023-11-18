
const formulario = document.getElementById("formulario");
const inputs     = document.querySelectorAll("#formulario input");
const cambio     = document.getElementsByClassName("formulario__input");

let objeto = {
    descripcion: "",
    direccion: "",
    celular: "",
    telefonoFijo: "",
    instagram: "",
    mapa: "",
};

const expresiones = {
    descripcion:  /^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ\s,.]{10,300}$/,    
    direccion:    /^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ\s,.]{4,50}$/, 
    celular:      /^\+\d{1,3}\s?\d{1,}\s?\d{1,}$/, 
    telefonoFijo: /^\d{4}-\d{7}$/, // 0 - 9 numeros
    instagram:    /^(?:https?:\/\/)?(?:www\.)?instagram\.com/, // 0 - 9 numeros
    mapa:         /^https?:\/\/www\.google\.com\/maps\/place/, // 0 - 5 numeros 
};
const campos = {
    descripcion:  false,
    direccion:    false,
    celular:      false,
    telefonoFijo: false,
    instagram:     false,
    mapa:         false,
};

const validarFormulario = (e) => {
    switch (e.target.name) {
        case "descripcion":
            validarCampo(expresiones.descripcion, e.target, "descripcion");
            objeto.descripcion = e.target.value;
            break;
        case "direccion":
            validarCampo(expresiones.direccion, e.target, "direccion");
            objeto.direccion = e.target.value;
            break;
        case "celular":
            validarCampo(expresiones.celular, e.target, "celular");
            objeto.celular = e.target.value;
            break;
        case "telefonoFijo":
            validarCampo(expresiones.telefonoFijo, e.target, "telefonoFijo");
            objeto.telefonoFijo = e.target.value;
            break;
        case "instagram":
            validarCampo(expresiones.instagram, e.target, "instagram");
            objeto.instagram = e.target.value;
            break;
        case "mapa":
            validarCampo(expresiones.mapa, e.target, "mapa");
            objeto.mapa = e.target.value;
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

formulario.addEventListener("submit", async(e) => {
    e.preventDefault();

    if (
        campos.descripcion &&
        campos.direccion &&
        campos.celular &&
        campos.telefonoFijo &&
        campos.instagram &&
        campos.mapa 
    ) {
        let token = document.getElementById("token");
        
        const respuesta = await fetch('/empresa/editar', {
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
                title: "Imformación editada exitosamente",
                html: mensaje,
                showConfirmButton: false,
                timer: 4000,
            });
            
            setTimeout(() => {
            location.href = "/infoEmpresa";
            }, 4000);
            
        }

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

let botonEditar = document.getElementById('botonEditar');
    botonEditar.addEventListener('click',function(){
        let inputDescripcion  = document.getElementById('descripcion');
        let inputDireccion    = document.getElementById('direccion');
        let inputCelular      = document.getElementById('celular');
        let inputTelefonoFijo = document.getElementById('telefonoFijo');
        let inputInstagram    = document.getElementById('instagram');
        let inputMapa         = document.getElementById('mapa');
        let botonCancelar     = document.getElementById('cancelar');
        let botonGuardar      = document.getElementById('guardar');

        inputDescripcion.disabled  = false;
        inputDireccion.disabled    = false;
        inputCelular.disabled      = false;
        inputTelefonoFijo.disabled = false;
        inputInstagram.disabled    = false;
        inputMapa.disabled         = false;

        botonEditar.style.display    = 'none';
        botonCancelar.style.display  = 'inline';
        botonGuardar.style.display   = 'inline';
        

    validarCampo(expresiones.descripcion, inputDescripcion, "descripcion");
    validarCampo(expresiones.direccion, inputDireccion, "direccion");
    validarCampo(expresiones.celular, inputCelular, "celular");
    validarCampo(expresiones.telefonoFijo, inputTelefonoFijo, "telefonoFijo");
    validarCampo(expresiones.instagram, inputInstagram, "instagram");
    validarCampo(expresiones.mapa, inputMapa, "mapa");
        
});

let botonCancelar = document.getElementById('cancelar');

botonCancelar.addEventListener('click',function(){
    location.href ="/login/administrador"; 
});
