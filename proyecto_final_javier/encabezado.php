<?php
include_once 'indexLogin.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="diseños/style.css">
</head>

<body>
    <div class="container-fluid cabeza">
        <nav class="navegation navbar navbar-expand-lg">
            <a class="navbar-brand" href="index.php">
                <img alt="" src="img/pcfleitas.png" style="max-height: 80px" />
            </a>
            <button class="navbar-toggler" onclick="margentoggle()" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="index.php">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contacto.php">Contacto</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="ver_carrito.php">Ver carrito 
                            <?php
                                $idSesion = session_id();
                                $url = 'http://localhost/dsw/proyecto/api/carrito/' . $idSesion;
                                $data = file_get_contents($url);
                                $response = json_decode($data, true);
                                $conteo = $response['total_rows'];
                                if ($conteo > 0) {
                                    printf("(%d)", $conteo);
                                }
                            ?>
                            &nbsp;<i class="fa fa-shopping-cart"></i>
                        </a>
                    </li>
                </ul>
                
                <?php if(isset($_SESSION['correo']) === true): ?>
                    <a href="logout.php" class="me-2 stylenlace">Cerrar sesión |</a>
                <?php else: ?>
                    <button class="btnLogin me-2 stylenlace" id="botoniniciar">Login</button>
                <?php endif; ?>
                
                <a href="paneluser.php" class="sinespacio stylenlace"><?php echo $user->getUsuario();?></a>
                <a href="paneladm.php" class="sinespacio stylenlace"><?php echo $user->getUsuarioAdmin(); ?> </a>
            </div>
        </nav>
    </div>

    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
