<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include("../includes/db.php");

/** @var mysqli $conn */
global $conn;

// Simple admin verification check placeholder
if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 0) {
    die("Access authorization signature verification failed.");
}

$prod_count   = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM products"))['total'];
$order_count  = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM orders"))['total'];
$gross_volume = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(total_amount) as total FROM orders"))['total'] ?? 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atelier Command | AESTHETIQUE</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Playfair+Display:ital,wght@0,400;0,600;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #FAF9F6; }
        .serif-font { font-family: 'Playfair Display', serif; }
    </style>
</head>
<body class="text-neutral-800 antialiased min-h-screen flex flex-col justify-between">

    <header class="w-full py-5 px-6 border-b border-neutral-200/60 bg-white shadow-xs">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex items-center space-x-3"><h1 class="serif-font text-lg tracking-widest font-semibold">AESTHETIQUE</h1><span class="text-[9px] font-mono bg-black text-white px-1.5 py-0.5 uppercase tracking-widest">Control Center</span></div>
            <a href="../logout.php" class="text-[10px] font-medium tracking-widest uppercase text-red-600/80 hover:text-red-600">Terminate Session</a>
        </div>
    </header>

    <main class="flex-grow max-w-7xl w-full mx-auto px-4 sm:px-6 py-12 space-y-10">
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
            <div class="bg-white border border-neutral-200/60 p-6 shadow-2xs"><span class="text-[9px] font-semibold tracking-widest text-neutral-400 uppercase">Gross Volume</span><p class="serif-font text-2xl font-semibold mt-1 font-mono text-neutral-900">Rs. <?= number_format($gross_volume) ?></p></div>
            <div class="bg-white border border-neutral-200/60 p-6 shadow-2xs"><span class="text-[9px] font-semibold tracking-widest text-neutral-400 uppercase">Active Invoices</span><p class="serif-font text-2xl font-semibold mt-1 font-mono text-neutral-900"><?= $order_count ?></p></div>
            <div class="bg-white border border-neutral-200/60 p-6 shadow-2xs"><span class="text-[9px] font-semibold tracking-widest text-neutral-400 uppercase">Catalog Items</span><p class="serif-font text-2xl font-semibold mt-1 font-mono text-neutral-900"><?= $prod_count ?></p></div>
        </div>

        <div class="bg-white border border-neutral-200/60 p-8 shadow-2xs space-y-6">
            <h3 class="serif-font text-base font-normal tracking-wide text-neutral-900 pb-3 border-b border-neutral-100">Control Matrices</h3>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-center">
                <a href="add_product.php" class="border border-neutral-200 p-4 text-xs font-semibold uppercase tracking-widest hover:bg-neutral-900 hover:text-white transition-all"><i class="fa-solid fa-plus block text-base mb-2"></i> Add Catalog Item</a>
                <a href="view_products.php" class="border border-neutral-200 p-4 text-xs font-semibold uppercase tracking-widest hover:bg-neutral-900 hover:text-white transition-all"><i class="fa-solid fa-boxes-stacked block text-base mb-2"></i> Manage Inventory</a>
                <a href="orders.php" class="border border-neutral-200 p-4 text-xs font-semibold uppercase tracking-widest hover:bg-neutral-900 hover:text-white transition-all"><i class="fa-solid fa-receipt block text-base mb-2"></i> Order Fulfillment</a>
            </div>
        </div>
    </main>

    <footer class="w-full py-6 text-center text-neutral-400 text-[10px] bg-white border-t border-neutral-200/40">
        <p>&copy; 2026 AESTHETIQUE Matrix Suite. Administrative operations audited.</p>
    </footer>
</body>
</html>