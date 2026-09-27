<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include("../includes/db.php");

/** @var mysqli $conn */
global $conn;

$result = mysqli_query($conn, "SELECT * FROM products ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalog Logs | AESTHETIQUE</title>
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

    <header class="w-full py-5 px-6 border-b border-neutral-200/60 bg-white flex justify-between items-center">
        <a href="dashboard.php" class="text-[10px] font-semibold tracking-widest text-neutral-400 uppercase hover:text-black"><i class="fa-solid fa-arrow-left-long mr-1"></i> Dashboard</a>
        <h1 class="serif-font text-base font-semibold tracking-widest uppercase">Inventory Registry</h1>
        <a href="add_product.php" class="text-[10px] font-semibold tracking-widest bg-neutral-900 text-white px-3 py-1.5 uppercase hover:bg-neutral-800">Add Piece</a>
    </header>

    <main class="flex-grow max-w-7xl w-full mx-auto px-4 sm:px-6 py-12">
        <div class="bg-white border border-neutral-200/60 p-6 shadow-2xs overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="text-[10px] uppercase tracking-wider text-neutral-400 border-b border-neutral-100">
                        <th class="pb-3 font-medium">Piece</th>
                        <th class="pb-3 font-medium">Designation</th>
                        <th class="pb-3 font-medium">Category</th>
                        <th class="pb-3 font-medium">Price Metric</th>
                        <th class="pb-3 text-right font-medium">Modifications</th>
                    </tr>
                </thead>
                <tbody class="text-xs divide-y divide-neutral-100">
                    <?php while($row = mysqli_fetch_assoc($result)): ?>
                        <tr class="hover:bg-neutral-50/40 transition-colors">
                            <td class="py-3"><div class="w-10 aspect-[3/4] bg-neutral-50 overflow-hidden"><img src="../uploads/<?= htmlspecialchars($row['image']) ?>" class="w-full h-full object-cover"></div></td>
                            <td class="py-3 font-medium text-neutral-900"><?= htmlspecialchars($row['product_name']) ?></td>
                            <td class="py-3 text-neutral-500"><?= htmlspecialchars($row['category']) ?></td>
                            <td class="py-3 font-mono font-medium text-neutral-900">Rs. <?= number_format($row['price'], 2) ?></td>
                            <td class="py-3 text-right space-x-3">
                                <a href="edit_product.php?id=<?= $row['id'] ?>" class="text-neutral-900 hover:text-neutral-500 font-medium"><i class="fa-regular fa-pen-to-square"></i> Edit</a>
                                <a href="delete_product.php?id=<?= $row['id'] ?>" onclick="return confirm('Confirm permanent deletion from system inventory?')" class="text-red-600/70 hover:text-red-600 font-medium"><i class="fa-regular fa-trash-can"></i> Evict</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </main>

    <footer class="w-full py-6 text-center text-neutral-400 text-[10px] bg-white border-t border-neutral-200/40">
        <p>&copy; 2026 AESTHETIQUE Matrix Suite. Inventory indices verified.</p>
    </footer>
</body>
</html>