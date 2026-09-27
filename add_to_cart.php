<?php
session_start();

// Basic input validation
$product_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($product_id <= 0) {
    header('Location: index.php');
    exit();
}

// Ensure cart exists
if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Prefill customer details for logged-in users (no file structure changes)
if (!empty($_SESSION['user_id'])) {
    $user_id = (int)$_SESSION['user_id'];
    if ($user_id > 0) {
        require_once __DIR__ . '/includes/db.php';

        $stmt = mysqli_prepare($conn, "SELECT id, fullname, phone, email FROM users WHERE id = ? LIMIT 1");
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, 'i', $user_id);
            mysqli_stmt_execute($stmt);
            $res = mysqli_stmt_get_result($stmt);
            if ($res && ($row = mysqli_fetch_assoc($res))) {
                $_SESSION['customer_prefill'] = [
                    'user_id' => (int)$row['id'],
                    'fullname' => (string)$row['fullname'],
                    'phone' => (string)$row['phone'],
                    'email' => (string)$row['email'],
                ];
            }
            mysqli_stmt_close($stmt);
        }
    }
}

// Add to cart: store quantity by product id
if (!isset($_SESSION['cart'][$product_id])) {
    $_SESSION['cart'][$product_id] = 1;
} else {
    $_SESSION['cart'][$product_id] += 1;
}

header('Location: cart.php');
exit();



