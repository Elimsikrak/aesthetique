<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include("../includes/db.php");

/** @var mysqli $conn */
global $conn;

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id > 0) {
    // Look up current record asset image filename map to clear disk footprint
    $product_query = mysqli_query($conn, "SELECT image FROM products WHERE id=$id");
    if ($product_query && mysqli_num_rows($product_query) === 1) {
        $product = mysqli_fetch_assoc($product_query);
        $file_path = "../uploads/" . $product['image'];
        
        if (file_exists($file_path) && !empty($product['image'])) {
            @unlink($file_path);
        }
    }
    
    // Purge entry from system tables
    mysqli_query($conn, "DELETE FROM products WHERE id=$id");
}

header("Location: view_products.php");
exit();