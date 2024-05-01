function printError(elemId, hintMsg) {
    document.getElementById(elemId).innerHTML = hintMsg;
}
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