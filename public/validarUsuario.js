const formulario = document.getElementById("formulario");
const inputs     = document.querySelectorAll("#formulario input");
const cambio     = document.getElementsByClassName("formulario__input");

const expresiones = {
    nombre: /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{2,30}$/, // Letras y espacios, pueden llevar acentos.
    mail:  /^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/, // Letras y espacios, pueden llevar acentos.

};
const campos = {
    nombre: false,
    mail: false,
};

let objeto = {
    nombre: "", 
    email: "", 
    password: "", 
    tipo: "",
    idUsuario: "" 
};

const validarFormulario = (e) => {
    switch (e.target.name) {
        case "nombre":
            validarCampo(expresiones.nombre, e.target, "nombre");
            objeto.nombre = e.target.value;
            break;
        case "mail":
            validarCampo(expresiones.mail, e.target, "mail");
            objeto.email = e.target.value;
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

if (window.location.href.match("edit"))
{
    let nombre = document.getElementById('nombre');
    let mail = document.getElementById('mail');
    objeto.nombre = nombre.value;
    objeto.email = mail.value;
    validarCampo(expresiones.nombre, nombre, "nombre");
    validarCampo(expresiones.mail, mail, "mail");
    
}else {
    objeto.password = document.getElementById("password").value;
    
}

formulario.addEventListener("submit", async(e) => {
    e.preventDefault();

    if (
        campos.nombre &&
        campos.mail
    ) {
        
        objeto.tipo = document.getElementById("tipo").value;
        let token = document.getElementById("token");

        let url = "";

        let idUsuario = document.getElementById("idUsuario");
        url = '/usuarios/editar/'+idUsuario.value;
        console.log(url);   

        const respuesta = await fetch(url, {
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
                  title: "Usuario Guardado",
                  showConfirmButton: false,
                  timer: 4000,
              });
            
            setTimeout(() => {
              location.href = "/usuario";
            }, 4000);
            
          }

        // Swal.fire({
        //     position: "top-center",
        //     icon: "success",
        //     title: "Usuario Guardado",
        //     showConfirmButton: false,
        //     timer: 4000,
        // });
        // /* 		document.getElementById('formulario__mensaje-exito').classList.add('formulario__mensaje-exito-activo'); */
        // setTimeout(() => {
        //     /* 	document.getElementById('formulario__mensaje-exito').classList.remove('formulario__mensaje-exito-activo'); */

        //     formulario.submit();
        // }, 4000);

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
