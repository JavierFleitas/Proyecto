function printError(elemId, hintMsg) {
    document.getElementById(elemId).innerHTML = hintMsg;
}
function validateContras() {
    
    var contraNueva = document.panelContra.contraNueva.value.trim();


    printError("errorcontra2", "");
    
    var contraNuevaError = false;
    


    if(contraNueva === "") {
        printError("errorcontra2", "(Introduce una clave)");
        contraNuevaError = true;
    } else {
        var regex = /^[0-9a-zA-Z]+$/; 
            if(!regex.test(contraNueva)) {
            printError("errorcontra2", "error");
            contraNuevaError = true;
        } 
    }


    if((contraNuevaError) == true) {
        return validarFormulario();
        
    }

    return true;

    
}

function validarFormulario() {
            
    var nuevaContraseñaInput = document.getElementById("cN");
    
    if (nuevaContraseñaInput.value.trim() === "") {
        alert("La contraseña está vacía. No se puede procesar.");
        return false; // Detener el envío del formulario
    }
    
    
    return true;
}