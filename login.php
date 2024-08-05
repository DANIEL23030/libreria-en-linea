<?php
session_start();
include 'config.php'; // Archivo con la configuración de la base de datos

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Consultar la base de datos para verificar las credenciales
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['username'] = $username;
        header("Location: index.php");
    } else {
        echo "Nombre de usuario o contraseña incorrectos.";
    }

    $stmt->close();
    $conn->close();
}
?>
