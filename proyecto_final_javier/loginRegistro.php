<?php 
include_once 'usuario.php';
include_once 'sesiones.php';
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Document</title>	
    <link rel="stylesheet" href="diseños/style.css">
    <script type = "text/javascript" src = "js/formuRegistro.js"></script>
    <script type = "text/javascript" src = "js/formuIniciarSesion.js"></script>


</head>
<body>


<div class="wrapper">


        <span class="icon-close">
            <ion-icon name="close"></ion-icon>
        </span>

        <div class="form-box login">
            
        
            <h2>Login</h2>
            <section>
            <form action="" method = "post" name="contactInicio" onsubmit="return validarFormularioLogin()">

                <div class="input-box">
                    <span class="icon"><ion-icon name="mail"></ion-icon></span>
                    <input type="email" name = "correo" id="correoInicio">
                    <label for="">Correo</label><label class="errorcorre" id="correError"></label>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
                    <input type="password" name = "clave" id="claveInicio">
                    <label for="">Contraseña</label><label class="errorclav" id="clavError"></label>  
                </div>
                
                <button id="btnIniciar" onclick="validateInicio()" class="btnn">Iniciar Sesión</button>

                <div class="login-register">
                    <p>¿No tienes una cuenta?<a href="#" class="register-link"> Registrar</a></p>
                </div>
            </form>
            </section>     
            
        </div>

        
        <div class="form-box register">

            <h2>Registro</h2>
            <form action="guardar_usuario.php" name="contactRegistro" method="post" onsubmit="return validarFormularioRegistro()">
                <div class="input-box">
                    <span class="icon"><ion-icon name="person"></ion-icon></span>
                    <input type="text" name="usuario" id="user">
                    <label for="">Usuario</label><label class="errorusurio" id="usuarioError"></label>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="mail"></ion-icon></span>
                    <input type="email" name="correo" id="emai">
                    <label for="">Correo</label><label class="errorcorreo" id="correoError"></label>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
                    <input type="password" name="clave" id="clav">
                    <label for="">Contraseña</label><label class="errorclave" id="claveError"></label>
                </div>
                <div class="remember-forgot">
                    <label for=""><input required type="checkbox" id="terminos">Terminos & condiciones</label><label for="" id="terminosError"></label>
                </div>
                <button onclick="validateRegistro()" class="btnn">Registrar</button>
                <div class="login-register">
                    <p>¿Ya tienes una cuenta?<a href="#" class="login-link"> Iniciar Sesión</a></p>
                </div>
            </form>
        </div>
        </div>

<script src="js/scriptGene.js"></script>  
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>