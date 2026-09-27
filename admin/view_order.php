<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include("includes/db.php");

/** @var mysqli $conn */
global $conn;

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id  = (int)$_SESSION['user_id'];
$order_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$order_query = mysqli_query($conn, "SELECT * FROM orders WHERE id=$order_id AND user_id=$user_id");
$order = mysqli_fetch_assoc($order_query);

if (!$order) {
    die("Access signature validation failed or manifest scope does not exist.");
}

$items_query = mysqli_query($conn, "
    SELECT oi.*, p.product_name, p.image 
    FROM order_items oi 
    JOIN products p ON oi.product_id = p.id 
    WHERE oi.order_id = $order_id
");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manifest Record #<?= $order_id ?> | AESTHETIQUE</title>
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

    <?php include("includes/navbar.php"); ?>

    <main class="flex-grow max-w-3xl w-full mx-auto px-4 sm:px-6 py-12">
        <div class="mb-6"><a href="profile.php" class="text-[10px] uppercase tracking-widest font-semibold text-neutral-400 hover:text-black transition-colors"><i class="fa-solid fa-arrow-left-long mr-1.5"></i> Back to Profile</a></div>

        <div class="bg-white border border-neutral-200/60 p-6 sm:p-10 shadow-2xs space-y-6">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center border-b border-neutral-100 pb-6 gap-4">
                <div>
                    <span class="text-[9px] uppercase tracking-widest text-neutral-400 font-semibold block">Order Vault Manifest</span>
                    <h1 class="serif-font text-2xl font-normal text-neutral-900 mt-0.5">Invoice #<?= $order_id ?></h1>
                    <p class="text-[10px] font-mono text-neutral-400 mt-1">Logged: <?= date('F d, Y H:i', strtotime($order['created_at'])) ?></p>
                </div>
                <span class="px-3 py-1 bg-neutral-900 text-white text-[10px] tracking-widest font-semibold uppercase"><?= htmlspecialchars($order['status']) ?></span>
            </div>

            <div class="divide-y divide-neutral-100">
                <?php while($item = mysqli_fetch_assoc($items_query)): ?>
                    <div class="flex items-center py-4 first:pt-0 last:pb-0 gap-4">
                        <div class="w-14 aspect-[3/4] bg-neutral-50 overflow-hidden border border-neutral-200/40"><img src="uploads/<?= htmlspecialchars($item['image']) ?>" class="w-full h-full object-cover"></div>
                        <div class="flex-grow"><h3 class="text-xs font-medium text-neutral-900"><?= htmlspecialchars($item['product_name']) ?></h3><p class="text-[10px] text-neutral-400 mt-0.5 font-mono">Qty: <?= $item['quantity'] ?></p></div>
                        <span class="text-xs font-mono font-semibold text-neutral-900">Rs. <?= number_format($item['price'] * $item['quantity']) ?></span>
                    </div>
                <?php endwhile; ?>
            </div>

            <div class="border-t border-neutral-100 pt-4 flex justify-between items-baseline">
                <span class="text-[10px] uppercase tracking-widest text-neutral-400 font-semibold">Total Invoice Value</span>
                <span class="serif-font text-lg font-semibold font-mono text-neutral-900">Rs. <?= number_format($order['total_amount']) ?></span>
            </div>
        </div>
    </main>

    <?php include("includes/footer.php"); ?>
</body>
</html>