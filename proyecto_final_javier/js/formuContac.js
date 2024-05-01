function printError(elemId, hintMsg) {
    document.getElementById(elemId).innerHTML = hintMsg;
}
function validateForm() {
    var nombre = document.contactForm.nombre.value.trim();
    var correo = document.contactForm.correo.value.trim();
    var telefono = document.contactForm.telefono.value.trim();
    var asunto = document.contactForm.asunto.value.trim();
    var mensaje = document.contactForm.mensaje.value.trim();
    
    

    var nombreErr = correoErr = telefonoErr = asuntoErr = mensajeErr = true;
    
    if(nombre == "") {
        printError("nombreErr", "(Introduce el nombre)");
    } else {
        var regex = /^[a-zA-Z\s]+$/; 
        if(regex.test(nombre) === false) {
            printError("nombreErr", "Solo es valido letras");
        } else {
            printError("nombreErr", "");
        nombreErr = false;
        }
    }

    if(correo == "") {
        printError("correoErr", "(Introduce el correo)");
    } else {
        var regex = /^\S+@\S+\.\S+$/;
        if(regex.test(correo) === false) {
            printError("correoErr", "Introduce un correo valido");
        } else{
            printError("correoErr", "");
            correoErr = false;
        }
    }



    if(telefono == "") {
        printError("telefonoErr", "(Introduce un telefono)");
    } else {
        var numeroTelefono = parseInt(telefono);
        if(isNaN(numeroTelefono)) { 
            printError("telefonoErr", "Solo es valido numeros");
        } else {
            var regex = /^[0-9]{9}$/;
            if(regex.test(numeroTelefono.toString()) === false) {
                printError("telefonoErr", "El número de teléfono debe tener 9 dígitos");
            } else {
                printError("telefonoErr", "");
                telefonoErr = false;
            }
        }
    }

    if(asunto == "") {
        printError("asuntoErr", "(Introduce el asunto)");
    } else {
        var regex = /^[a-zA-Z0-9\s,?!.¡¿]+$/; 
        if(regex.test(asunto) === false) {
            printError("asuntoErr", "Solo es válido letras y números");
        } else {
            printError("asuntoErr", "");
            asuntoErr = false;
        }
    }

    if(mensaje == "") {
        printError("mensajeErr", "(Introduce el mensaje)");
    } else {
        var regex = /^[a-zA-Z0-9\s,?!.¡¿]+$/;
        if(regex.test(mensaje) === false) {
            printError("mensajeErr", "Solo es válido letras y números");
        } else {
            printError("mensajeErr", "");
            mensajeErr = false;
        }
    }


    if((nombreErr || correoErr || telefonoErr || asuntoErr || mensajeErr) == true) {
        return false;
    } else {
        var dataPreview = "Detalles del Formulario enviado a pcFleitas: \n" +
            "Nombre: " + nombre + "\n" +
            "Correo: " + correo + "\n" +
            "Telefono: " + telefono + "\n" +
            "Asunto: " + asunto + "\n" +
            "Mensaje: " + mensaje + "\n";
            
        alert(dataPreview);
        document.contactForm.reset();
    }
};