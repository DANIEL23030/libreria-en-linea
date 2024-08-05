<?php
include 'config.php'; // Archivo con la configuración de la base de datos

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = filter_var($_POST['titulo'], FILTER_SANITIZE_STRING);
    $autor = filter_var($_POST['autor'], FILTER_SANITIZE_STRING);
    $precio = filter_var($_POST['precio'], FILTER_VALIDATE_FLOAT);

    // Insertar datos en la base de datos
    $stmt = $conn->prepare("INSERT INTO libros (titulo, autor, precio) VALUES (?, ?, ?)");
    $stmt->bind_param("ssd", $titulo, $autor, $precio);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "Libro registrado exitosamente.";
    } else {
        echo "Error al registrar el libro.";
    }

    $stmt->close();
    $conn->close();
}
?>
