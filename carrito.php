<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $libro_id = filter_var($_POST['libro_id'], FILTER_SANITIZE_NUMBER_INT);
    $cantidad = filter_var($_POST['cantidad'], FILTER_VALIDATE_INT);
    $action = filter_var($_POST['action'], FILTER_SANITIZE_STRING);

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    switch ($action) {
        case 'add':
            $stmt = $conn->prepare("SELECT * FROM LIBROS WHERE ID = ?");
            $stmt->bind_param("i", $libro_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $libro = $result->fetch_assoc();

            if ($libro) {
                if (isset($_SESSION['cart'][$libro_id])) {
                    $_SESSION['cart'][$libro_id]['cantidad'] += $cantidad;
                } else {
                    $_SESSION['cart'][$libro_id] = [
                        'id' => $libro['ID'],
                        'titulo' => $libro['titulo'],
                        'precio' => $libro['precio'],
                        'cantidad' => $cantidad
                    ];
                }
            }
            break;
        case 'remove':
            if (isset($_SESSION['cart'][$libro_id])) {
                $_SESSION['cart'][$libro_id]['cantidad'] -= $cantidad;
                if ($_SESSION['cart'][$libro_id]['cantidad'] <= 0) {
                    unset($_SESSION['cart'][$libro_id]);
                }
            }
            break;
        case 'clear':
            unset($_SESSION['cart']);
            break;
    }

    header("Location: carrito.html");
    exit();
}
?>

