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

$user_id = (int)$_SESSION['user_id'];
$user_query = mysqli_query($conn, "SELECT * FROM users WHERE id=$user_id");
$user = mysqli_fetch_assoc($user_query);

$orders_query = mysqli_query($conn, "SELECT * FROM orders WHERE user_id=$user_id ORDER BY id DESC LIMIT 5");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Ledger | AESTHETIQUE</title>
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

    <main class="flex-grow max-w-5xl w-full mx-auto px-4 sm:px-6 py-12">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-start">
            
            <!-- Structural Profile Identity Block -->
            <div class="bg-white border border-neutral-200/60 p-6 shadow-2xs space-y-4 text-center sm:text-left">
                <div class="w-16 h-16 bg-neutral-900 text-white rounded-full flex items-center justify-center text-lg font-medium serif-font mx-auto sm:mx-0">
                    <?= strtoupper(substr($user['fullname'] ?? 'P', 0, 1)) ?>
                </div>
                <div>
                    <h2 class="serif-font text-lg font-normal text-neutral-900"><?= htmlspecialchars($user['fullname']) ?></h2>
                    <p class="text-[11px] text-neutral-400 font-light mt-0.5"><?= htmlspecialchars($user['email']) ?></p>
                </div>
                <div class="pt-4 border-t border-neutral-100 text-xs text-neutral-500 space-y-1">
                    <p><span class="font-medium text-neutral-400 text-[10px] uppercase block">Communication Matrix</span> <?= htmlspecialchars($user['phone'] ?? 'Unlisted') ?></p>
                </div>
            </div>

            <!-- Historical Orders Ledger Block -->
            <div class="md:col-span-2 bg-white border border-neutral-200/60 p-6 shadow-2xs space-y-6">
                <div class="flex justify-between items-baseline pb-3 border-b border-neutral-100">
                    <h3 class="serif-font text-base font-normal tracking-wide text-neutral-900">Recent Purchase Manifests</h3>
                    <span class="text-[9px] uppercase tracking-widest font-mono text-neutral-400">Vault Ledger</span>
                </div>

                <?php if (mysqli_num_rows($orders_query) === 0): ?>
                    <div class="text-center py-10">
                        <p class="text-xs text-neutral-400 italic">No historical purchase registries identified under this configuration token.</p>
                    </div>
                <?php else: ?>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="text-[10px] uppercase tracking-wider text-neutral-400 border-b border-neutral-100">
                                    <th class="pb-3 font-medium">Manifest</th>
                                    <th class="pb-3 font-medium">Date</th>
                                    <th class="pb-3 font-medium">Aggregate</th>
                                    <th class="pb-3 font-medium">Fulfillment</th>
                                    <th class="pb-3 text-right font-medium">Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-xs divide-y divide-neutral-100">
                                <?php while($order = mysqli_fetch_assoc($orders_query)): ?>
                                    <tr class="hover:bg-neutral-50/50 transition-colors">
                                        <td class="py-3.5 font-mono font-medium text-neutral-900">#<?= $order['id'] ?></td>
                                        <td class="py-3.5 text-neutral-500"><?= date('M d, Y', strtotime($order['created_at'])) ?></td>
                                        <td class="py-3.5 font-mono font-semibold">Rs. <?= number_format($order['total_amount']) ?></td>
                                        <td class="py-3.5">
                                            <span class="text-[9px] uppercase tracking-wider px-2 py-0.5 rounded-xs font-semibold <?= strtolower($order['status']) === 'delivered' ? 'bg-emerald-50 text-emerald-700' : 'bg-neutral-100 text-neutral-700' ?>">
                                                <?= htmlspecialchars($order['status']) ?>
                                            </span>
                                        </td>
                                        <td class="py-3.5 text-right">
                                            <a href="view_order.php?id=<?= $order['id'] ?>" class="text-[10px] uppercase tracking-widest font-bold underline underline-offset-4 text-neutral-900 hover:text-neutral-500">Inspect</a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>

        </div>
    </main>

    <?php include("includes/footer.php"); ?>
</body>
</html>