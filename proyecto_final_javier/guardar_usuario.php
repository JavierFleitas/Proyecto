
<?php

include_once "usuario.php";

$usuario = new Proyecto\Usuario();

//guarda el usuario creado
$usuario->guardarUsuarios($_POST["usuario"], $_POST["correo"], $_POST["clave"]);


header("Location: index.php");
