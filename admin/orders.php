<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include("../includes/db.php");

/** @var mysqli $conn */
global $conn;

// Process State Update Requests Inline
if (isset($_POST['update_status'])) {
    $order_id   = (int)$_POST['order_id'];
    $new_status = mysqli_real_escape_string($conn, trim($_POST['status']));
    
    mysqli_query($conn, "UPDATE orders SET status='$new_status' WHERE id=$order_id");
}

$result = mysqli_query($conn, "
    SELECT o.*, u.fullname, u.email 
    FROM orders o 
    JOIN users u ON o.user_id = u.id 
    ORDER BY o.id DESC
");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoices Workspace | AESTHETIQUE Control</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Playfair+Display:ital,wght@0,400;0,600;1,400&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #FAF9F6; }
        .serif-font { font-family: 'Playfair Display', serif; }
    </style>
</head>
<body class="text-neutral-800 antialiased min-h-screen flex flex-col justify-between">

    <header class="w-full py-5 px-6 border-b border-neutral-200/60 bg-white flex justify-between items-center">
        <a href="dashboard.php" class="text-[10px] font-semibold tracking-widest text-neutral-400 uppercase hover:text-black"><i class="fa-solid fa-arrow-left-long mr-1"></i> Dashboard</a>
        <h1 class="serif-font text-base font-semibold tracking-widest uppercase">Fulfillment Desk</h1>
        <div class="w-20"></div>
    </header>

    <main class="flex-grow max-w-7xl w-full mx-auto px-4 sm:px-6 py-12">
        <div class="bg-white border border-neutral-200/60 p-6 shadow-2xs overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="text-[10px] uppercase tracking-wider text-neutral-400 border-b border-neutral-100">
                        <th class="pb-3 font-medium">Manifest ID</th>
                        <th class="pb-3 font-medium">Patron Client</th>
                        <th class="pb-3 font-medium">Date Logged</th>
                        <th class="pb-3 font-medium">Aggregate Value</th>
                        <th class="pb-3 font-medium">State Config</th>
                        <th class="pb-3 text-right font-medium">Pipeline Action</th>
                    </tr>
                </thead>
                <tbody class="text-xs divide-y divide-neutral-100">
                    <?php while($row = mysqli_fetch_assoc($result)): ?>
                        <tr class="hover:bg-neutral-50/40 transition-colors">
                            <td class="py-4 font-mono font-semibold text-neutral-900">#<?= $row['id'] ?></td>
                            <td class="py-4">
                                <p class="font-medium text-neutral-900"><?= htmlspecialchars($row['fullname']) ?></p>
                                <p class="text-[10px] text-neutral-400"><?= htmlspecialchars($row['email']) ?></p>
                            </td>
                            <td class="py-4 text-neutral-500"><?= date('Y-m-d H:i', strtotime($row['created_at'])) ?></td>
                            <td class="py-4 font-mono font-medium text-neutral-900">Rs. <?= number_format($row['total_amount']) ?></td>
                            <td class="py-4">
                                <form method="POST" class="flex items-center space-x-2">
                                    <input type="hidden" name="order_id" value="<?= $row['id'] ?>">
                                    <select name="status" class="bg-neutral-50 border border-neutral-200 p-1 text-[11px] focus:outline-hidden focus:border-neutral-900">
                                        <option value="Pending" <?= $row['status'] === 'Pending' ? 'selected' : '' ?>>Pending</option>
                                        <option value="Shipped" <?= $row['status'] === 'Shipped' ? 'selected' : '' ?>>Shipped</option>
                                        <option value="Delivered" <?= $row['status'] === 'Delivered' ? 'selected' : '' ?>>Delivered</option>
                                        <option value="Cancelled" <?= $row['status'] === 'Cancelled' ? 'selected' : '' ?>>Cancelled</option>
                                    </select>
                                    <button type="submit" name="update_status" class="text-[10px] uppercase tracking-widest bg-neutral-900 text-white px-2 py-1 font-medium hover:bg-neutral-800">Save</button>
                                </form>
                            </td>
                            <td class="py-4 text-right">
                                <a href="../view_order.php?id=<?= $row['id'] ?>" target="_blank" class="text-[10px] uppercase tracking-widest font-bold text-neutral-900 hover:text-neutral-500 underline underline-offset-4">Inspect Invoice</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </main>

    <footer class="w-full py-6 text-center text-neutral-400 text-[10px] bg-white border-t border-neutral-200/40">
        <p>&copy; 2026 AESTHETIQUE Matrix Suite. Pipeline flows tracked globally.</p>
    </footer>
</body>
</html>