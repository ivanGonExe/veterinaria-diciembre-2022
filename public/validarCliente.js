const formulario = document.getElementById("formulario");
const inputs     = document.querySelectorAll("#formulario input");
const cambio     = document.getElementsByClassName("formulario__input");


let objeto = {
    nombre: "", 
    apellido: "", 
    dni: "", 
    direccion: "", 
    numeroCalle: "" ,
    codigoArea:  "",
    telefono: "",
  };

const expresiones = {
    nombre: /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{2,30}$/, // Letras y espacios, pueden llevar acentos.
    apellido: /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{2,30}$/, // Letras y espacios, pueden llevar acentos.
    dni: /^[0-9]{1,8}$/, // Validar Numero de Dni Solo Numeros y longitud 8
    telefono: /^[0-9]{1,7}$/, // 0 - 9 numeros
    codigoArea: /^[0-9]{3,7}$/, // 0 - 9 numeros
    numeroCalle: /^[0-9]{1,4}$/, // 0 - 5 numeros
    direccion: /^([a-zA-Z0-9áéíóúÁÉÍÓÚñÑ\s]){1,30}$/, // Letras y espacios, pueden llevar acentos.
};

const campos = {
    nombre: false,
    apellido: false,
    dni: false,
    telefono: false,
    codigoArea: false,
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
        case "telefono":
            validarCampo(expresiones.telefono, e.target, "telefono");
            objeto.telefono = e.target.value;
            break;
        case "dni":
            validarCampo(expresiones.dni, e.target, "dni");
            objeto.dni = e.target.value;
            break;
        case "codigoArea":
            validarCampo(expresiones.codigoArea, e.target, "codigoArea");
            objeto.codigoArea = e.target.value;
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

inputs.forEach((input) => {
    input.addEventListener("keyup", validarFormulario); //cuando se levante la tecla
    input.addEventListener("blur", validarFormulario); //cuando le de un click fuera del imput */ */
});

formulario.addEventListener("submit", async(e) => {
    e.preventDefault();

    if (
        campos.nombre &&
        campos.apellido &&
        campos.dni &&
        campos.telefono &&
        campos.codigoArea &&
        campos.direccion &&
        campos.numeroCalle
    ) {
        
    let token = document.getElementById("token");


    const respuesta = await fetch('/personas/crear', {
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
        
        /* 		document.getElementById('formulario__mensaje-exito').classList.add('formulario__mensaje-exito-activo'); */
        setTimeout(() => {
            /* 	document.getElementById('formulario__mensaje-exito').classList.remove('formulario__mensaje-exito-activo'); */

         //         icono.classList.remove("formulario__grupo-correcto");
        //     });     //formulario.submit();
        }, 4000);

        // document
        //     .querySelectorAll(".formulario__grupo-correcto")
        //     .forEach((icono) => {
      
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


