<?php
include 'config.php'; // Archivo con la configuración de la base de datos

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Validación adicional
    if (empty($username) || empty($email) || empty($password)) {
        die("Por favor, complete todos los campos.");
    }

    // Validar formato del correo electrónico
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("El formato del correo electrónico es inválido.");
    }

    // Verificar si el usuario ya existe
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        die("El nombre de usuario ya existe.");
    }

    // Insertar datos en la base de datos
    $stmt = $conn->prepare("INSERT INTO usuarios (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $password);
    if ($stmt->execute()) {
        header("Location: gracias.php?success=1");
    } else {
        die("Error en el registro.");
    }

    $stmt->close();
    $conn->close();
}
?>
