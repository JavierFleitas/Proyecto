
<?php
include_once 'indexLogin.php';
include_once 'bd.php';


// Procesa la actualización del usuario si se envió una solicitud POST
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['actualizarUsuario'])) {

    $usuario = $_POST['usuario'];
    $correo = $_POST['correo'];
    $clave = $_POST['contraNueva'];

    // Llamar a la función actualizarUsuario para procesar la actualización del usuario
    Bd::actualizarUsuario($usuario, $correo, $clave);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Cliente</title>
    <link rel="stylesheet" href="diseños/general.css">
    <script type = "text/javascript" src = "js/formuPanelUser.js"></script>
    
</head>
<body>


<?php include_once "encabezado.php"; 


if (isset($_SESSION['mensajeactucontra'])) {
    if (strpos($_SESSION['mensajeactucontra'], 'éxito') !== false) {
        echo '<div id="message-alert-perfil" class="success-message">';
    } else {
        echo '<div id="message-alert-perfil" class="error-message">';
    }
    echo $_SESSION['mensajeactucontra'];
    echo '</div>';

    unset($_SESSION['mensajeactucontra']);
}


?>


<div class="container-fluid cuerpo" id="idnavbar">

<div class="row my-5">

<div class="col-12">
        <h2 class="is-size-2">Usuario <?php echo $user->getUsuario();?></h2>
        <table class="table">
            <thead>
                <tr>
                    
                    <th>Usuario</th>
                    <th>Correo</th>
                    <th>Contraseña Nueva</th>
                    <th>Cambiar Contraseña</th>
                </tr>
            </thead>
            <tbody>
            <tr>
            <form name="panelContra" method="post" onsubmit="return validateContras()">
                    
                    <td><input type="text" readonly class="form-control" name=usuario value="<?php echo $user->getuser();?>"></td>
                    <td><input type="text" readonly class="form-control" name=correo value="<?php echo $user->getcorreo();?>"></td>
                    <input type="hidden" name="actualizarUsuario" value="true">
                    <td><input type="password" class="form-control" id="cN" placeholder="Escriba la nueva" name=contraNueva><label for=""></label>
                    <label class="errorcontra2" id="errorcontra2"></label></td>
                    
                    <td><button class="button is-danger" type="submit">Actualizar</button></td>
            </form> 
            </tr>
            </tbody>
            
        </table>
        
    </div>
</div>
</div>


<?php include_once "pie.php"; ?> 


<script src="js/scriptGene.js"></script>
<script src="js/formuPanelUser.js"></script>

    
</body>
</html>



