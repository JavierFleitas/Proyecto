<?php
include_once "bd.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto</title>
    <script type = "text/javascript" src = "js/formuContac.js"></script>
    <link rel="stylesheet" href="diseños/contactocss.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

</head>
<body>

<?php
include "encabezado.php";


?>


<div class="container-fluid cuerpo p" id="idnavbar">
        <div class="divcontacto">
            
            <div class="content">
                
    </div>
    <h1 class="logo"><span class="cont">Conctact</span>&nbsp;&#160;<span>Us</span></h1>

    <div class="caja" >
    <div class="my-5 contact-wrapper">
        
        <div class="contact-form">
            <h3>Contáctanos</h3>
            <form name="contactForm" method="post" onsubmit="return validarFormularioContacto()">
                <p>
                    <label for="">Nombre</label>
                    <label class="error" id="nombreErr"></label><input type="text" name="nombre" id="nombre">
                    
                </p>
                <p>
                    <label for="">Correo</label>
                    <label class="error" id="correoErr"></label><input type="email" name="correo" id="correo">
                </p>
                <p>
                    <label for="">Teléfono</label>
                    <label class="error" id="telefonoErr"></label><input type="tel" name="telefono" id="telefono">
                </p>
                <p>
                    <label for="">Asunto</label>
                    <label class="error" id="asuntoErr"></label><input type="text" name="asunto" id="asunto">
                </p>
                <p class="bloqueo">
                    <label for="">Mensaje</label>
                    <label class="error" id="mensajeErr"></label><textarea name="mensaje" id="mensaje" rows="3"></textarea>
                </p>
                <p class="bloqueo">
                    <button type="button" onclick="validateForm()">enviar</button>
    
                </p>
                
            </form>
        </div>
        <div class="contact-info">
            <h4>Mas información</h4>
            <ul>
                <li><i class="fas fa-map-marker-alt"></i> C/ Madroño</li>
                <li><i class="fas fa-phone"></i> 666 77 88 22</li>
                <li><i class="fas fa-envelope-open"></i> Contact@Pcfleitas.com</li>
            </ul>
            <p>
            ¿Tienes preguntas o comentarios? Estamos aquí para ayudarte. Encuéntranos y comunícate fácilmente.
            </p>
            <p>PcFleitas.com</p>
        </div>
        
        </div>
        <?php include_once 'loginRegistro.php'; ?> 
    </div>
    
    </div>
     
    </div>

    <?php 
    include_once "pie.php"; 
    ?>   
    

    
<script src="js/scriptGene.js"></script>
<script src="js/script.js"></script>

</body>
</html>