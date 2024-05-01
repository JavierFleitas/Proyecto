<?php


class Bd{

    //producto en el carrito
public static function productoYaEstaEnCarrito($idProducto)
{
   
    $url = 'http://localhost/dsw/proyecto/api/carrito';
    $data = file_get_contents($url);
    $response = json_decode($data, true);

    if ($response && $response['total_rows'] > 0) {
        foreach ($response['rows'] as $row) {
            if ($row['id_product'] == $idProducto) {
                return true; 
            }
        }
    }

    return false; // El producto ya no esta en el carrito
}


public static function eliminarProductoCarrito($idSesion, $idProducto, $redireccion = null) {
   
    $data = [
        'idsesion' => $idSesion,
        'idproducto' => $idProducto
    ];

    $json_data = json_encode($data);

    $options = [
        'http' => [
            'method' => 'DELETE',
            'header' => 'Content-Type: application/json',
            'content' => $json_data
        ]
    ];

    $context = stream_context_create($options);

    $url = 'http://localhost/dsw/proyecto/api/borrar-carrito';
    $response = file_get_contents($url, false, $context);

    if ($response !== false) {

        $result = json_decode($response, true);

        if (isset($result['status']) && $result['status'] === 'success') {
            // Redirige a la página especificada después de eliminar el producto
            header("Location: $redireccion");
            exit;
        } else {

            echo 'Error al eliminar el producto';
        }
    } else {
        echo 'Error al eliminar el producto';
    }
}


// Agregar un producto al carrito en la vista de prodcutos

public static function agregarAlCarrito($idSesion, $idProducto, $categoria) {

    $data = [
        'idsesion' => $idSesion,
        'idproducto' => $idProducto
    ];

    $json_data = json_encode($data);

    $options = [
        'http' => [
            'method' => 'POST',
            'header' => 'Content-Type: application/json',
            'content' => $json_data
        ]
    ];

    $context = stream_context_create($options);

    $url = 'http://localhost/dsw/proyecto/api/agregar-producto-carrito';
    $response = file_get_contents($url, false, $context);

    if ($response !== false) {

        $result = json_decode($response, true);
        if (isset($result['status']) && $result['status'] === 'success') {
            // Redirecciona a la página según la categoría del producto
            switch ($categoria) {
                case '2':
                    header('Location: productoProcesadores.php');
                    exit;
                case '1':
                    header('Location: productoGraficas.php');
                    exit;
                case '3':
                    header('Location: productoPlacas bases.php');
                    exit;
                case '4':
                    header('Location: productoMemoria RAM.php');
                    exit;
                default:
                    
                    header('Location: paginaPorDefecto.php');
                    exit;
            }
        } else {
           
            echo 'Error al agregar el producto al carrito';
        }
    } else {

        echo 'Error al agregar el producto al carrito';
    }
}




// Definir la función eliminarUsuario en PHP
public static function eliminarUsuario($codUsuario) {
    // Verificar si se recibió una solicitud POST para eliminar un usuario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['eliminarUsuario'])) {
    // Obtener el código del usuario a eliminar
    $codUsuario = $_POST['codUsuario'];

    // Enviar solicitud DELETE a la API
    $url = 'http://localhost/dsw/proyecto/api/usuarios';
    $data = array('cod' => $codUsuario);
    $options = array(
        'http' => array(
            'method' => 'DELETE',
            'header' => 'Content-Type: application/json',
            'content' => json_encode($data)
        )
    );
    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    
    // Verificar si la solicitud DELETE fue exitosa
    if ($result !== false) {
        $response = json_decode($result, true);
        if (isset($response['status']) && $response['status'] === 'success') {
            
            $_SESSION['mensajeborraruser'] = "Usuario eliminado con éxito";
            header("Location: paneladm.php");
            exit();
            
        } else {
            
            $_SESSION['mensajeborraruser'] = "Error al eliminar usuario";
            header("Location: paneladm.php");
            exit();
        }
    } else {
      
            $_SESSION['mensajeborraruser'] = "Error al eliminar usuario";
            header("Location: paneladm.php");
            exit();
    }
}
    
}


public static function actualizarUsuario($usuario, $correo, $clave) {
    // Verificar si se recibió una solicitud POST para actualizar un usuario
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['actualizarUsuario'])) {
        // Enviar solicitud PUT a la API
        $url = 'http://localhost/dsw/proyecto/api/usuariosContra';
        $data = array(
            
            'usuario' => $usuario,
            'correo' => $correo,
            'clave' => $clave
        );
        $options = array(
            'http' => array(
                'method' => 'PUT',
                'header' => 'Content-Type: application/json',
                'content' => json_encode($data)
            )
        );
        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        
        // Verificar si la solicitud PUT fue exitosa
        if ($result !== false) {
            $response = json_decode($result, true);
            if (isset($response['status']) && $response['status'] === 'success') {
                // Mostrar alerta de éxito
                $_SESSION['mensajeactucontra'] = "Usuario actualizado con éxito";
               
                header("Location: logout.php");
                
                exit();
            } else {
                // Mostrar alerta de error
                $_SESSION['mensajeactucontra'] = "Contraseña actual repetida, introduzca una nueva";
                header("Location: " . $_SERVER['PHP_SELF']);
                exit();
               
            }
        } else {
            // Mostrar alerta de error
            $_SESSION['mensajeactucontra'] = "Error al actualizar usuario";
            exit();
        }
    }
}



public static function actualizarPerfil($codUsuario) {
    // Obtener el valor seleccionado del perfil
    if (isset($_POST['perfil_' . $codUsuario])) {
        $perfil = $_POST['perfil_' . $codUsuario];
    } else {
        // Manejar el caso en que no se haya seleccionado ningún perfil
        $_SESSION['mensajeperfil'] = "Debe seleccionar un perfil";
        header("Location: paneladm.php");
        exit();
    }

    // Verificar si se envió una solicitud POST para actualizar el perfil
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['actualizarPerfil'])) {
        $url = 'http://localhost/dsw/proyecto/api/usuarios';
        $data = array(
            'cod' => $codUsuario,
            'perfil' => $perfil
        );
        $options = array(
            'http' => array(
                'method' => 'PUT',
                'header' => 'Content-Type: application/json',
                'content' => json_encode($data)
            )
        );
        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);

        // Verificar si la solicitud PUT fue exitosa
        if ($result !== false) {
            $response = json_decode($result, true);
            if (isset($response['status']) && $response['status'] === 'success') {
                // Mostrar alerta de éxito

                $_SESSION['mensajeperfil'] = "Perfil de Usuario actualizado con éxito";
                header("Location: paneladm.php");
                exit();

            } else {
                $_SESSION['mensajeperfil'] = "Error al cambiar el perfil de Usuario";
                header("Location: paneladm.php");
                exit();
            }
        } else {
            $_SESSION['mensajeperfil'] = "Error al cambiar el perfil de Usuario";
            header("Location: paneladm.php");
            exit();
        }
    }
}



}






?>

