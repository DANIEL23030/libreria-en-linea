<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}

include 'config.php'; // Archivo con la configuración de la base de datos

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $book_id = filter_var($_POST['book_id'], FILTER_SANITIZE_STRING);
    $action = filter_var($_POST['action'], FILTER_SANITIZE_STRING);

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    switch ($action) {
        case 'add':
            $stmt = $conn->prepare("SELECT * FROM libros WHERE id = ?");
            $stmt->bind_param("i", $book_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $product = $result->fetch_assoc();

            if ($product) {
                $_SESSION['cart'][$book_id] = [
                    'id' => htmlspecialchars($product['id'], ENT_QUOTES, 'UTF-8'),
                    'titulo' => htmlspecialchars($product['titulo'], ENT_QUOTES, 'UTF-8'),
                    'precio' => htmlspecialchars($product['precio'], ENT_QUOTES, 'UTF-8'),
                    'cantidad' => ($_SESSION['cart'][$book_id]['cantidad'] ?? 0) + 1
                ];
            } else {
                echo "El producto no existe.";
            }
            break;
        case 'remove':
            if (isset($_SESSION['cart'][$book_id])) {
                $_SESSION['cart'][$book_id]['cantidad']--;
                if ($_SESSION['cart'][$book_id]['cantidad'] <= 0) {
                    unset($_SESSION['cart'][$book_id]);
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
