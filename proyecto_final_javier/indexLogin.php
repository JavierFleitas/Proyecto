
<?php
include_once 'usuario.php';
include_once 'sesiones.php';

use Proyecto\Usuario;

$userSession = new Sesiones();
$user = new Usuario();


if (isset($_SESSION['correo'])) {
    $user->setUser($userSession->getCurrentUser());
} else if (isset($_POST['correo']) && isset($_POST['clave'])) {
    $correoForm = $_POST['correo'];
    $passForm = $_POST['clave'];

    $user = new Usuario();
    $loginResult = $user->comprobacion_user($correoForm, $passForm);
    if ($loginResult['success']) {
        $userSession->setCurrentUser($correoForm);
        $user->setUser($correoForm);
        
        echo "<div id='message-alert' class='success-message'>" . $loginResult['message'] . "</div>";
    } else {

        echo "<div id='message-alert' class='error-message'>" . $loginResult['message'] . "</div>";
    }

    
}





?>

