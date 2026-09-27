<?php
session_start();

// Initialize unified response schema
$status = 'error';
$message = 'Invalid item modification request.';

// Ensure the cart session array exists
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Securely capture and validate the incoming product identity index
if (isset($_GET['id'])) {
    $product_id = (int)$_GET['id'];

    if (isset($_SESSION['cart'][$product_id])) {
        // Remove item from session registry
        unset($_SESSION['cart'][$product_id]);
        
        $status = 'success';
        $message = 'The selected piece has been removed from your curation.';
    } else {
        $message = 'The specified piece could not be located in your active cart.';
    }
}

// UX ENGINE CHOICE: Detect if the request is a modern asynchronous AJAX/Fetch action
$is_ajax = (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
           || (isset($_GET['format']) && $_GET['format'] === 'json');

if ($is_ajax) {
    // Return an instantaneous cryptographic JSON response state for sleek, no-reload UI transitions
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode([
        'status' => $status,
        'message' => $message,
        'cart_count' => count($_SESSION['cart'])
    ]);
    exit();
} else {
    // Standard Fallback: Append a luxury system alert to the session memory bank and route backwards
    $_SESSION['sys_alert'] = [
        'type' => $status,
        'text' => $message
    ];
    
    // Redirect cleanly back to the main ledger window
    header("Location: cart.php");
    exit();
}