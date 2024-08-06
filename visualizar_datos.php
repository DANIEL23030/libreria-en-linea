<?php
include 'config.php'; // Archivo con la configuración de la base de datos

// Consulta de datos de la tabla USUARIOS
$result_usuarios = $conn->query("SELECT * FROM usuarios");
$usuarios = $result_usuarios->fetch_all(MYSQLI_ASSOC);

// Consulta de datos de la tabla LIBROS
$result_libros = $conn->query("SELECT * FROM libros");
$libros = $result_libros->fetch_all(MYSQLI_ASSOC);

// Consulta de datos de la tabla CARRITO
$result_carrito = $conn->query("SELECT * FROM carrito");
$carrito = $result_carrito->fetch_all(MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Visualizar Datos - Librería en Línea</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
  <div class="container mt-4">
    <h1>Visualizar Datos</h1>

    <h2>Usuarios</h2>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Email</th>
          <th>Dirección</th>
          <th>Teléfono</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($usuarios as $usuario) : ?>
        <tr>
          <td><?php echo $usuario['ID']; ?></td>
          <td><?php echo $usuario['nombre']; ?></td>
          <td><?php echo $usuario['email']; ?></td>
          <td><?php echo $usuario['direccion']; ?></td>
          <td><?php echo $usuario['telefono']; ?></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

    <h2>Libros</h2>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>Título</th>
          <th>Autor</th>
          <th>Precio</th>
          <th>Cantidad</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($libros as $libro) : ?>
        <tr>
          <td><?php echo $libro['ID']; ?></td>
          <td><?php echo $libro['titulo']; ?></td>
          <td><?php echo $libro['autor']; ?></td>
          <td><?php echo $libro['precio']; ?></td>
          <td><?php echo $libro['cantidad']; ?></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

    <h2>Carrito</h2>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>ID Usuario</th>
          <th>ID Libro</th>
          <th>Cantidad</th>
          <th>Monto Total</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($carrito as $item) : ?>
        <tr>
          <td><?php echo $item['ID']; ?></td>
          <td><?php echo $item['usuario_id']; ?></td>
          <td><?php echo $item['libro_id']; ?></td>
          <td><?php echo $item['cantidad']; ?></td>
          <td><?php echo $item['monto_total']; ?></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</body>
</html>
