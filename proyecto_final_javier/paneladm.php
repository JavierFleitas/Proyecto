<?php

include_once 'indexLogin.php';
include_once 'bd.php';


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['eliminarUsuario'])) {

    $codUsuario = $_POST['codUsuario'];

    // Llama a la función eliminarUsuario para procesar la eliminación del usuario
    Bd::eliminarUsuario($codUsuario);
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['actualizarUsuario'])) {
 

    $usuario = $_POST['usuario'];
    $correo = $_POST['correo'];
    $clave = $_POST['contraNueva'];

    // Llama a la función actualizarUsuario para procesar la actualización del usuario
    Bd::actualizarUsuario($usuario, $correo, $clave);
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['actualizarPerfil'])) {
 
    $codUsuario = $_POST['codUsuario'];
    $perfil = $_POST['perfil_' . $codUsuario];

    // Llama a la función actualizarPerfil para procesar la actualización del perfil
    Bd::actualizarPerfil($codUsuario, $perfil);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Admin</title>
    <link rel="stylesheet" href="diseños/general.css">
    <script type = "text/javascript" src = "js/formuPanelUser.js"></script>
</head>
<body>

<?php
include_once "encabezado.php";
?>

<?php
// Verifica si hay un mensaje en la sesión y lo muestra
if (isset($_SESSION['mensajeperfil'])) {
    if (strpos($_SESSION['mensajeperfil'], 'éxito') !== false) {
        echo '<div id="message-alert-perfil" class="success-message">';
    } else {
        echo '<div id="message-alert-perfil" class="error-message">';
    }
    echo $_SESSION['mensajeperfil'];
    echo '</div>';
 
    unset($_SESSION['mensajeperfil']);
}


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

if (isset($_SESSION['mensajeborraruser'])) {
    if (strpos($_SESSION['mensajeborraruser'], 'éxito') !== false) {
        echo '<div id="message-alert-perfil" class="success-message">';
    } else {
        echo '<div id="message-alert-perfil" class="error-message">';
    }
    echo $_SESSION['mensajeborraruser'];
    echo '</div>';
   
    unset($_SESSION['mensajeborraruser']);
}
?>



<div class="container-fluid cuerpo" id="idnavbar">

<div class="row my-5">

<div class="columns">
    <div class="column">
        <h2 class="is-size-2">Usuarios existentes</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Cod</th>
                    <th>Usuario</th>
                    <th>Correo</th>
                    <th>Perfil</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
            <?php
                        
                        $url = 'http://localhost/dsw/proyecto/api/usuarios';
                        $usuarios = json_decode(file_get_contents($url), true);

                        if (isset($usuarios['rows'])) {
                            foreach ($usuarios['rows'] as $usuario) {
                                ?>
                                <tr>
                                    <td><?php echo $usuario['cod'] ?></td>
                                    <td><?php echo $usuario['user'] ?></td>
                                    <td><?php echo $usuario['email'] ?></td>
                                    <td>
                                        <form method="post">
                                            <select name="perfil_<?php echo $usuario['cod'] ?>" id="perfil_<?php echo $usuario['cod'] ?>">
                                                <option value="Cliente" <?php if ($usuario['perfil'] === 'Cliente') echo 'selected'; ?>>Cliente</option>
                                                <option value="Admin" <?php if ($usuario['perfil'] === 'Admin') echo 'selected'; ?>>Admin</option>
                                            </select>
                                            <input type="hidden" name="codUsuario" value="<?php echo $usuario['cod'] ?>">
                                            <button class="button is-danger" type="submit" name="actualizarPerfil">Actualizar perfil</button>
                                        </form>
                                    </td>
                                    
                                    <td>
                                        
                                    <form method="post">
                                        <input type="hidden" name="eliminarUsuario">
                                        <input type="hidden" name="codUsuario" value="<?php echo $usuario['cod'] ?>">
                                        <button class="button is-danger" type="submit">Borrar</button>
                                    </form>
                                    </td>
                                </tr>
                            <?php
                            }
                        }
                        ?>
            </tbody>
        </table>
        <div class="col-12">
        <h2 class="is-size-2">Usuario <?php echo $user->getuser();?></h2>
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
</div>
</div>

<?php include_once "pie.php"; ?> 

<script src="js/formuPanelUser.js"></script>
<script src="js/scriptGene.js"></script>

</body>
</html>

