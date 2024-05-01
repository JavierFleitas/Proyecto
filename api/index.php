<?php

require 'flight/Flight.php';

Flight::register('db', PDO::class, ['mysql:host=localhost;dbname=pcfleitas', 'root', '']);
Flight::route('GET /usuarios', function () {

    $db = Flight::db();
    $query = $db->prepare("SELECT * FROM usuarios");
    $query->execute();
    $data = $query->fetchAll();

    $array = [];

    foreach ($data as $row){

      $array[]=[
        "cod" => $row['cod'],
        "user" => $row['usuario'],
        "email" => $row['correo'],
        "password" => $row['clave'],
        "perfil" => $row['perfil'],
      ];

    }

    Flight::json([
      "total_rows" => $query->rowCount(),
      "rows" => $array
    ]);
  });



  Flight::route('GET /usuarios/@cod', function ($cod) {

    $db = Flight::db();
    $query = $db->prepare("SELECT * FROM usuarios WHERE cod = :cod");
    $query->execute([":cod" => $cod]);
    $data = $query->fetch();

      $array = [
        "cod" => $data['cod'],
        "user" => $data['usuario'],
        "email" => $data['correo'],
        "password" => $data['clave'],
      ];

    

    Flight::json($array);
  });

    //--------------- POST

    Flight::route('POST /usuarios', function () {
      $db = Flight::db();
      $user = Flight::request()->data->user;
      $email = Flight::request()->data->email;
      $password = Flight::request()->data->password;
  
      // Consulta para verificar si el correo ya existe
      $query_check_email = $db->prepare("SELECT COUNT(*) AS count FROM usuarios WHERE correo = :email");
      $query_check_email->execute([":email" => $email]);
      $result = $query_check_email->fetch(PDO::FETCH_ASSOC);
  
    
      // Si el correo ya existe, devuelve un mensaje de error
      if ($result['count'] > 0) {
        $array = [
          "error" => "El correo electrónico ya está registrado",
          "status" => "error"
      ];
      Flight::json($array);
      } else {
          // Inserta un nuevo usuario si el correo no existe
          $query_insert_user = $db->prepare("INSERT INTO usuarios (usuario, correo, clave, perfil) VALUES (:user, :email, :password, 'Cliente')");
  
          try {
              if ($query_insert_user->execute([":user" => $user, ":email" => $email, ":password" => $password])) {
                  $array = [
                      "data" => [
                          "cod" => $db->lastInsertId(),
                          "user" => $user,
                          "email" => $email,
                          "password" => $password,
                          "perfil" => "Cliente"
                      ],
                      "status" => "success"
                  ];
              }
          } catch (PDOException $e) {
            $array = [
                "error" => $e->getMessage(),
                "status" => "error"
            ];
        }
      }
  
      Flight::json($array);
  });





function generarToken($usuario, $expiracion) {
  $payload = array(
      "usuario" => $usuario,
      "exp" => $expiracion
  );
  $clave_secreta = "clave_secreta_javier";
  return base64_encode(json_encode($payload) . $clave_secreta);
}


// Función para obtener el token más antiguo y válido
function obtenerTokenValido($usuario_id) {
  $db = Flight::db();
  $query = $db->prepare("SELECT * FROM registros WHERE cod_user = :cod_user AND fecha_exp > NOW() ORDER BY fecha LIMIT 1");
  $query->execute(['cod_user' => $usuario_id]);
  $tokenInfo = $query->fetch(PDO::FETCH_ASSOC);
  return $tokenInfo;
}


Flight::route('POST /login', function () {
  $db = Flight::db();
  $email = Flight::request()->data->email;
  $password = Flight::request()->data->password;

  // Verifica si el correo y la clave son correctas
  $query = $db->prepare("SELECT * FROM usuarios WHERE correo = :email AND clave = :password");
  $query->execute(['email' => $email, 'password' => $password]);
  $user = $query->fetch(PDO::FETCH_ASSOC);


  if ($user) {
 
      $tokenValido = obtenerTokenValido($user['cod']);

      if ($tokenValido && strtotime($tokenValido['fecha_exp']) > time()) {
          // Si el token es válido, responde con una respuesta HTTP 200
          Flight::json([
              "status" => "success",
              "message" => "¡Inicio de sesión exitoso!",
              "token" => $tokenValido['token'],
          ]);
      } else {
          // Si el token ha caducado o no existe, crea uno nuevo
          $expiracion = strtotime('+15 second');
          $nuevoToken = generarToken($user['usuario'], $expiracion);
          $insertQuery = $db->prepare("INSERT INTO registros (cod_user, token, fecha, fecha_exp) VALUES (:cod_user, :token, NOW(), :fecha_exp)");
          $insertQuery->execute(['cod_user' => $user['cod'], 'token' => $nuevoToken, 'fecha_exp' => date('Y-m-d H:i:s', $expiracion)]);

          Flight::json([
              "status" => "success",
              "message" => "¡Inicio de sesión exitoso!",
              "token" => $nuevoToken,
              "user" => [
                  "cod" => $user['cod'],
                  "email" => $user['correo'],
              ]
          ]);
      }
  } else {
      Flight::json([
          "status" => "error",
          "message" => "Credenciales incorrectas. Por favor, verifica tu correo y contraseña."
      ]);
  }
});




Flight::route('GET /correo', function () {
  $db = Flight::db();
  $email = Flight::request()->query->email;

  // consulta para buscar usuarios por correo electrónico
  $query = $db->prepare("SELECT * FROM usuarios WHERE correo = :email");
  $query->execute(['email' => $email]);
  $user = $query->fetch(PDO::FETCH_ASSOC);


  if ($user) {

      $response = [
          "status" => "success",
          "user" => [
              "cod" => $user['cod'],
              "user" => $user['usuario'],
              "password" => $user['clave'],
              "email" => $user['correo'],
              "perfil" => $user['perfil'],

          ]
      ];
  } else {

      $response = [
          "status" => "error",
          "message" => "No se encontró ningún usuario con el correo electrónico proporcionado."
      ];
  }

  Flight::json($response);
});


  // ---------- PUT ACTUALIZAR CONTRASEÑA

  Flight::route('PUT /usuariosContra', function () {
    $db = Flight::db();

    $data = Flight::request()->data;
    $user = isset($data->usuario) ? $data->usuario : null;
    $email = isset($data->correo) ? $data->correo : null;
    $password = isset($data->clave) ? $data->clave : null;


    if ($user === null || $email === null || $password === null) {
        Flight::json(["error" => "error en la solicitud"]);
        return;
    }

    // Consulta para obtener la contraseña actual del usuario
    $query_current_password = $db->prepare("SELECT clave FROM usuarios WHERE correo = :email");
    $query_current_password->execute([":email" => $email]);
    $current_password = $query_current_password->fetchColumn();

    // Verifica si la nueva contraseña es igual a la contraseña actual
    if ($current_password === $password) {
        Flight::json(["error" => "La nueva contraseña es igual a la contraseña actual"]);
        return;
    }

    // Actualiza la contraseña solo si no es igual a la actual
    $query_update_password = $db->prepare("UPDATE usuarios SET usuario = :user, clave = :password WHERE correo = :email");
    if ($query_update_password->execute([":user" => $user, ":password" => $password, ":email" => $email])) {
        Flight::json(["status" => "success", "message" => "Usuario actualizado con éxito"]);
    } else {
        Flight::json(["error" => "Error al actualizar usuario"], 500);
    }
});




//--------- PUT ACTUALIZAR PERFIL

Flight::route('PUT /usuarios', function () {
  $db = Flight::db();
  $cod = Flight::request()->data->cod; 
  $perfil = Flight::request()->data->perfil; 

  $query_update_user = $db->prepare("UPDATE usuarios SET perfil = :perfil WHERE cod = :cod");

  $array = [
      "error" => "Hubo un error",
      "status" => "error"
  ];

  if ($query_update_user->execute([":perfil" => $perfil, ":cod" => $cod])) {
      $array = [
          "data" => [
              "cod" => $cod,
              "perfil" => $perfil,
          ],
          "status" => "success"
      ];
  }

  Flight::json($array);
});



// ------------ DELETE

Flight::route('DELETE /usuarios', function () {

  
  $db = Flight::db();
  $cod = Flight::request()->data->cod; 

  $query_insert_user = $db->prepare("DELETE FROM usuarios WHERE cod = :cod");

  $array = [
      "error" => "Hubo un error",
      "status" => "error"
  ];

          if ($query_insert_user->execute([":cod" => $cod])) {
              $array = [
                  "data" => [
                      "cod" => $cod,
                  ],
                  "status" => "success"
              ];
          }
       
  
  Flight::json($array);
});


//------------ PRODUCTOS


Flight::route('GET /productos', function () {

  $db = Flight::db();
  $query = $db->prepare("SELECT * FROM productos");
  $query->execute();
  $data = $query->fetchAll();

  $array = [];

  foreach ($data as $row){

    $array[]=[
      "id" => $row['id'],
      "name" => $row['nombre'],
      "descripcion" => $row['descripcion'],
      "price" => $row['precio'],
    ];

  }

  Flight::json([
    "total_rows" => $query->rowCount(),
    "rows" => $array
  ]);
});



Flight::route('GET /productos/@categoria', function ($categoria) {

  $db = Flight::db();
  $query = $db->prepare("SELECT * FROM productos WHERE categoria_id = :categoria");
  $query->execute([":categoria" => $categoria]);
  $data = $query->fetchAll();

  $array = [];

  foreach ($data as $row){

    $array[]=[
      "id" => $row['id'],
      "name" => $row['nombre'],
      "descripcion" => $row['descripcion'],
      "img" => $row['img'],
      "price" => $row['precio'],
    ];

  }

  Flight::json([
    "total_rows" => $query->rowCount(),
    "rows" => $array
  ]);
});


// ------------- CARRITO


Flight::route('GET /carrito', function () {

  $db = Flight::db();
  $query = $db->prepare("SELECT * FROM carrito_usuarios");
  $query->execute();
  $data = $query->fetchAll();

  $array = [];

  foreach ($data as $row){

    $array[]=[
      "id" => $row['ID'],
      "id_sesion" => $row['id_sesion'],
      "id_product" => $row['id_producto'],
   
    ];

  }

  Flight::json([
    "total_rows" => $query->rowCount(),
    "rows" => $array
  ]);
});


Flight::route('GET /carrito/@id', function ($id) {
  $db = Flight::db();
   // consulta para obtener los productos en el carrito por ID de sesión
  $query = $db->prepare("SELECT id_producto FROM carrito_usuarios WHERE id_sesion = :id");
  $query->execute([":id" => $id]);
  $data = $query->fetchAll();

  $array = [];

  foreach ($data as $row) {
      $array[] = [
          "id_product" => $row['id_producto'],
      ];
  }

  Flight::json([
      "total_rows" => $query->rowCount(),
      "rows" => $array
  ]);
});


Flight::route('GET /productos-en-carrito/@idSesion', function ($idSesion) {

  $bd = Flight::db();
  
  // consulta para obtener los productos en el carrito
  $sentencia = $bd->prepare("SELECT productos.id, productos.nombre, productos.precio
                             FROM productos
                             INNER JOIN carrito_usuarios
                             ON productos.id = carrito_usuarios.id_producto
                             WHERE carrito_usuarios.id_sesion = :idSesion");
  
  $sentencia->execute([":idSesion" => $idSesion]);
  
  $productos = $sentencia->fetchAll();

  $array = [];

  foreach ($productos as $row) {
      $array[] = [
          "id" => $row['id'],
          "name" => $row['nombre'],
          "price" => $row['precio'],
      ];
  }

  Flight::json([
      "total_rows" => $sentencia->rowCount(),
      "rows" => $array
  ]);
});


Flight::route('DELETE /borrar-carrito', function () {
  $db = Flight::db();
  $idsesion = Flight::request()->data->idsesion;
  $idproducto = Flight::request()->data->idproducto;

  // Verifica si el producto existe en el carrito para la sesión actual
  $query_check_product = $db->prepare("SELECT COUNT(*) AS num_rows FROM carrito_usuarios WHERE id_sesion = :idsesion AND id_producto = :idproducto");
  $query_check_product->execute([":idsesion" => $idsesion, ":idproducto" => $idproducto]);
  $result = $query_check_product->fetch(PDO::FETCH_ASSOC);

  // Verifica si se encontró el producto en el carrito
  if ($result && $result['num_rows'] > 0) {
      // Consulta para eliminar el producto del carrito
      $query_delete_product = $db->prepare("DELETE FROM carrito_usuarios WHERE id_sesion = :idsesion AND id_producto = :idproducto");
      if ($query_delete_product->execute([":idsesion" => $idsesion, ":idproducto" => $idproducto])) {
         
          Flight::json(["status" => "success"]);
      } else {
          
          Flight::json(["error" => "Hubo un error al eliminar el producto", "status" => "error"], 500);
      }
  } else {

      Flight::json(["error" => "El producto no existe en el carrito", "status" => "error"], 404);
  }
});



Flight::route('POST /agregar-producto-carrito', function () {
  $db = Flight::db();

  $idsesion = Flight::request()->data->idsesion;
  $idproducto = Flight::request()->data->idproducto;

  if (!isset($idsesion) || !isset($idproducto)) {

      Flight::json(["status" => "error", "message" => "Faltan datos en la solicitud"], 400);
      return;
  }

  // Verifica si el producto ya está en el carrito
  $sentencia_verificacion = $db->prepare("SELECT COUNT(*) FROM carrito_usuarios WHERE id_sesion = :idsesion AND id_producto = :idproducto");
  $sentencia_verificacion->execute([":idsesion" => $idsesion, ":idproducto" => $idproducto]);
  $resultado = $sentencia_verificacion->fetchColumn();

  if ($resultado > 0) {

      Flight::json(["status" => "error", "message" => "El producto ya está en el carrito"], 400);
      return;
  }

  // Inserta el producto en la tabla de carrito_usuarios
  $sentencia = $db->prepare("INSERT INTO carrito_usuarios(id_sesion, id_producto) VALUES (:idsesion, :idproducto)");

  if ($sentencia->execute([":idsesion" => $idsesion, ":idproducto" => $idproducto])) {

      Flight::json([
          "status" => "success",
          "data" => [
              "id" => $db->lastInsertId(),
              "idsesion" => $idsesion,
              "idproducto" => $idproducto
          ]
      ]);
  } else {
      Flight::json(["status" => "error", "message" => "Error al insertar el producto en la base de datos"], 500);
  }
});



Flight::route('GET /categorias/@id', function ($id) {

  $db = Flight::db();
  $query = $db->prepare("SELECT * FROM categorias WHERE id = :id");
  $query->execute([":id" => $id]);
  $data = $query->fetch();

    $array = [
      "id" => $data['id'],
      "name" => $data['Nombre'],
      "desc" => $data['Descripcion'],
      "img" => $data['img'],
    ];


  Flight::json($array);
});



  Flight::start();

?>




