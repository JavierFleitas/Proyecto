function printError(elemId, hintMsg) {
    document.getElementById(elemId).innerHTML = hintMsg;
}

function validateRegistro() {
    var usuario = document.contactRegistro.usuario.value.trim();
    var correo = document.contactRegistro.correo.value.trim();
    var clave = document.contactRegistro.clave.value.trim();
    var terminos = document.getElementById("terminos");

    printError("usuarioError", "");
    printError("correoError", "");
    printError("claveError", "");
    printError("terminosError", "");

    var usuarioError = correoError = claveError = terminosError = false;

    if (usuario === "") {
        printError("usuarioError", "(Introduce el usuario)");
        usuarioError = true;
    } else {
        var regex = /^[a-zA-Z\s]+$/;
        if (!regex.test(usuario)) {
            printError("usuarioError", "(Solo es válido letras)");
            usuarioError = true;
        }
    }

    if (correo === "") {
        printError("correoError", "(Introduce el correo)");
        correoError = true;
    } else {
        var regex = /^\S+@\S+\.\S+$/;
        if (!regex.test(correo)) {
            printError("correoError", "(Correo no válido)");
            correoError = true;
        }
    }

    if (clave === "") {
        printError("claveError", "(Introduce una clave)");
        claveError = true;
    }

    if (!terminos.checked) {
        printError("terminosError", "Por favor, acepta los términos y condiciones");
        terminosError = true;
    }

    if (usuarioError || correoError || claveError || terminosError) {
        return false; // Evita que el formulario se envíe
    }

    return true;
}
