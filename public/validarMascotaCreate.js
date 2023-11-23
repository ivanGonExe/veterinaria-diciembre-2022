const formulario = document.getElementById("formulario");
const inputs     = document.querySelectorAll("#formulario input");
const cambio     = document.getElementsByClassName("formulario__input");


const expresiones = {
    nombre:         /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{2,20}$/, // Letras y espacios, pueden llevar acentos.
    color:          /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{2,30}$/, // Letras y espacios, pueden llevar acentos.
    raza:           /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{2,30}$/, // Letras y espacios, pueden llevar acentos.
    anioNacimiento: /\d{4}-\d{2}-\d{2}/, // validacion de fecha  que solo contenga numeros   
};
const campos = {
    nombre:         false,
    color:          false,
    raza:           false,
    anioNacimiento: false,
};  

let objeto = {
    nombre: "", 
    color: "", 
    esterilizado: "", 
    especie: "", 
    raza: "", 
    sexo: "", 
    anioNacimiento: ""
};

const validarFormulario = (e) => {
    switch (e.target.name) {
        case "nombre":
            validarCampo(expresiones.nombre, e.target, "nombre");
            objeto.nombre = e.target.value;
            break;
        case "color":
            validarCampo(expresiones.color, e.target, "color");
            objeto.color = e.target.value;
            break;
        case "raza":
            validarCampo(expresiones.raza, e.target, "raza");
            objeto.raza = e.target.value;
            break;
        case "anioNacimiento":
            validarCampo(expresiones.anioNacimiento, e.target, "anioNacimiento");
            objeto.anioNacimiento = e.target.value;
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
    if (campos.nombre && campos.color && campos.raza && campos.anioNacimiento ) 
    {
        objeto.esterilizado = document.getElementById("esterilizado").value;
        objeto.especie = document.getElementById("especie").value;
        objeto.sexo = document.querySelector('input[name="sexo"]:checked');

        let token = document.getElementById("token");
        let idPersona = document.getElementById("idPersona");
        let url = "";

        if (window.location.href.match("edit"))
        {
            let idMascota = document.getElementById("idMascota");

            url = '/mascota/editar/' + idMascota.value;

        }
        else{
            url = '/mascota/crear/' + idPersona.value;
        }
        
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
                  title: "Mascota Guardada",
                  showConfirmButton: false,
                  timer: 4000,
              });
            
            setTimeout(() => {
              location.href = "/mascotas/verMascota/" + idPersona.value;
            }, 4000);
            
          }
        // Swal.fire({
        //     position: "top-center",
        //     icon:     "success",
        //     title:    "Mascota Guardada",
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

//comprobar que esten validados los input en edit

if (window.location.href.match("edit"))
{
    let nombre         = document.getElementById('nombre');         
    let color          = document.getElementById('color');         
    let raza           = document.getElementById('raza');          
    let anioNacimiento = document.getElementById('anioNacimiento');

    validarCampo(expresiones.nombre        ,nombre         ,"nombre");
    validarCampo(expresiones.color         ,color          ,"color");
    validarCampo(expresiones.raza          ,raza           ,"raza");
    validarCampo(expresiones.anioNacimiento,anioNacimiento,"anioNacimiento");
}


