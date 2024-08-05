<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = filter_var($_POST['titulo'], FILTER_SANITIZE_STRING);
    $autor = filter_var($_POST['autor'], FILTER_SANITIZE_STRING);
    $precio = filter_var($_POST['precio'], FILTER_VALIDATE_FLOAT);
    $cantidad = filter_var($_POST['cantidad'], FILTER_VALIDATE_INT);

    $stmt = $conn->prepare("INSERT INTO LIBROS (titulo, autor, precio, cantidad) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssdi", $titulo, $autor, $precio, $cantidad);
    if ($stmt->execute()) {
        echo "Libro registrado exitosamente.";
    } else {
        echo "Error al registrar el libro.";
    }

    $stmt->close();
    $conn->close();
}
?>
