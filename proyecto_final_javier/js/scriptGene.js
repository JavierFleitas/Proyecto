
function validarFormularioContacto() {
    var NombreInput = document.getElementById("nombre");
    var CorreoInput = document.getElementById("correo");
    var TelefonoInput = document.getElementById("telefono");
    var AsuntoInput = document.getElementById("asunto");
    var MensajeInput = document.getElementById("mensaje");
    
    if (NombreInput.value.trim() === "" || CorreoInput.value.trim() === "" || TelefonoInput.value.trim() === "" || AsuntoInput.value.trim() === "" || MensajeInput.value.trim() === "") {
        alert("Rellena todos los campos. No se puede procesar.");
        return false; // Detiene el envío del formulario
    }
    

    return true;
}

function validarFormularioRegistro() {
    var UserInput = document.getElementById("user");
    var CorreoInput = document.getElementById("emai");
    var ContraseñaInput = document.getElementById("clav");
    
    if (UserInput.value.trim() === "" || CorreoInput.value.trim() === "" || ContraseñaInput.value.trim() === "") {
        alert("Rellena todos los campos. No se puede procesar.");
        return false; // Detiene el envío del formulario
    }
    

    return true;
}

function validarFormularioLogin() {
    
    var CorreooInput = document.getElementById("correoInicio");
    var ContraseñaaInput = document.getElementById("claveInicio");
    
    if (CorreooInput.value.trim() === "" || ContraseñaaInput.value.trim() === "") {
        alert("Rellena todos los campos. No se puede procesar.");
        return false; // Detiene el envío del formulario
    }
    
    
    return true;
}




function margentoggle(){

    var navbar = document.getElementById("idnavbar");
    navbar.classList.toggle("margin-added");

}


function printError(elemId, hintMsg) {
    document.getElementById(elemId).innerHTML = hintMsg;
}

// validacion de inicio 

function validateInicio() {
    var correo = document.contactInicio.correo.value.trim();
    var clave = document.contactInicio.clave.value.trim();


    var clavError = correoError = false;
    

    if(correo === "") {
        printError("correError", "(Introduce el correo)");
        correoError = true;
    } else {
        var regex = /^\S+@\S+\.\S+$/;
        if(regex.test(correo) === false) {
            printError("correError", "Error no es valido");
            correoError = true;
        } else{
            printError("correError", "");
            
        }
    }

    if(clave === "") {
        printError("clavError", "(Introduce una clave)");
        clavError = true;
    } else {
        var regex = /^[0-9a-zA-Z]+$/; 
            if(regex.test(clave) === false) {
            printError("clavError", "(Solo es valido numeros)");
            clavError = true;
        } else{
            printError("clavError", "");
            
        }
    }

    if (correoError || clavError) {
        return false; // Evita que el formulario se envíe
    }

    return true;

    
};




function manejarErrores(response) {
    if (response.ok) {
        return response;
    } else {
        throw new Error('Error al procesar la solicitud: ' + response.status);
    }
}

//alertas 

setTimeout(function() {
    var errorMessage = document.getElementById('message-alert');
    var errorMessagecarrito = document.getElementById('message-alert-carrito');
    var errorMessageperfil = document.getElementById('message-alert-perfil');
    var errorMessageactucontra = document.getElementById('message-alert-actucontra');
    var errorMessageborraruser = document.getElementById('message-alert-borraruser');
    var errorMessageregist = document.getElementById('message-alert-regist');

    if (errorMessage) {
        errorMessage.style.display = 'none';
    }

    if (errorMessagecarrito) {
        errorMessagecarrito.style.display = 'none';
    }

    if (errorMessageperfil) {
        errorMessageperfil.style.display = 'none';
    }

    if (errorMessageactucontra) {
        errorMessageactucontra.style.display = 'none';
    
    }

    if (errorMessageborraruser) {
        errorMessageborraruser.style.display = 'none';
    }
    
    if (errorMessageregist) {
        errorMessageregist.style.display = 'none';
    }

}, 3000);



