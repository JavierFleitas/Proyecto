<?php

    include_once 'sesiones.php';

    $userSession = new Sesiones();
    $userSession->closeSession();


    header("location: index.php");

?>