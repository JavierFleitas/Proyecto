
<!DOCTYPE html>
<html>
    <head>
        
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Inicio</title>
        <link rel="stylesheet" href="diseños/style.css">
        <link rel="stylesheet" href="diseños/general.css">
        <script src="js/scriptGene.js"></script>
    </head>	
    <body>		
    <?php
    include "encabezado.php";

    ?>

		
<div class="container-fluid cuerpo p" id="idnavbar">


<div class="row text-center">
    
    
<h2 class="tituh">Componentes</h2>
</div>

<div class="row text-center ">

<div class="conthov">



<?php

$base_url = "http://localhost/dsw/proyecto/api/";


$categoria_ids = [1, 2, 3, 4]; 

// Iterar sobre cada ID de categoría
foreach ($categoria_ids as $categoria_id) {

    $url = $base_url . "categorias/" . $categoria_id;

    $data = file_get_contents($url);
    $categoria_data = json_decode($data, true);

    // Verifica si se obtuvieron los datos correctamente
    if ($categoria_data && isset($categoria_data['id'])) {
        ?>
        <div class="col-auto mt-4 mx-auto card">
            <img src="img/<?php echo $categoria_data['img'] . '.jpg'; ?>">
            <h4><?php echo $categoria_data['name']; ?></h4>
            <p><?php echo $categoria_data['desc']; ?></p>
            <a href="<?php echo 'producto' . ucfirst($categoria_data['name']) . '.php'; ?>" class="stylenlace stylenlaceindex">Leer más</a>
        </div>
        <?php
    } else {
   
        echo "No se pudieron obtener los datos de la categoría con ID $categoria_id";
    }
}
?>



<?php
include_once 'LoginRegistro.php';

?>

</div>

</div>
</div>


<?php include_once "pie.php"; ?> 


<script src="js/script.js"></script>

    </body>
</html>
