<?php
session_start();

/* 
   PRODUCTION ROLE PROTECTION HOOK:
   --------------------------------------------------
   if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
       header("Location: login.php");
       exit;
   }
*/

// Comprehensive Global Order Repository (Simulating database pulls across multiple system clients)
$global_orders = [
    [
        "order_id" => "AE-98241",
        "client" => "Aarav Sharma",
        "email" => "aarav@domain.com",
        "date" => "2026-07-14",
        "city" => "Lalitpur",
        "items_count" => 2,
        "total" => 18700,
        "status" => "Processing",
        "status_style" => "text-amber-700 bg-amber-50 border-amber-200",
        "payment" => "eSewa"
    ],
    [
        "order_id" => "AE-98242",
        "client" => "Priya Thapa",
        "email" => "priya.t@domain.np",
        "date" => "2026-07-16",
        "city" => "Kathmandu",
        "items_count" => 3,
        "total" => 35500,
        "status" => "Placed",
        "status_style" => "text-neutral-600 bg-neutral-50 border-neutral-200",
        "payment" => "Bank Transfer"
    ],
    [
        "order_id" => "AE-94112",
        "client" => "Tshering Sherpa",
        "email" => "tshering.s@domain.com",
        "date" => "2026-05-28",
        "city" => "Pokhara",
        "items_count" => 1,
        "total" => 16650,
        "status" => "Shipped",
        "status_style" => "text-blue-700 bg-blue-50 border-blue-200",
        "payment" => "COD"
    ],
    [
        "order_id" => "AE-81094",
        "client" => "Niranjan Shrestha",
        "email" => "niru@domain.com",
        "date" => "2026-04-10",
        "city" => "Dharan",
        "items_count" => 1,
        "total" => 9950,
        "status" => "Delivered",
        "status_style" => "text-emerald-700 bg-emerald-50 border-emerald-200",
        "payment" => "Khalti"
    ],
    [
        "order_id" => "AE-76521",
        "client" => "Elena Joshi",
        "email" => "elena.j@domain.com",
        "date" => "2026-03-15",
        "city" => "Butwal",
        "items_count" => 2,
        "total" => 22400,
        "status" => "Delivered",
        "status_style" => "text-emerald-700 bg-emerald-50 border-emerald-200",
        "payment" => "COD"
    ]
];

// Operational Analytics Calculus
$total_revenue = 0;
$processing_backlog = 0;
$shipped_transit = 0;

foreach ($global_orders as $o) {
    $total_revenue += $o['total'];
    if ($o['status'] === 'Processing' || $o['status'] === 'Placed') $processing_backlog++;
    if ($o['status'] === 'Shipped') $shipped_transit++;
}

// Simulated Status Update Form Processor
$update_success = false;
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action_update'])) {
    $target_id = filter_var($_POST['target_order_id'], FILTER_SANITIZE_SPECIAL_CHARS);
    $new_status = filter_var($_POST['new_status'], FILTER_SANITIZE_SPECIAL_CHARS);
    
    // In production: UPDATE orders SET status = :status WHERE order_id = :id
    $update_success = true;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atelier Backoffice Registry | AESTHETIQUE</title>
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

    <!-- ADMIN CONSOLE TOP NAVIGATION -->
    <header class="w-full py-5 px-4 sm:px-8 border-b border-neutral-200/60 bg-white sticky top-0 z-50 shadow-xs">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <a href="index.php" class="serif-font text-xl tracking-[0.25em] uppercase font-semibold text-neutral-900">
                    AESTHETIQUE
                </a>
                <span class="text-[10px] uppercase tracking-widest bg-neutral-900 text-white px-2 py-0.5 font-medium">Atelier Admin</span>
            </div>
            
            <nav class="hidden md:flex items-center space-x-8 text-xs tracking-widest uppercase font-medium text-neutral-500">
                <a href="#" class="text-neutral-900 underline underline-offset-8 decoration-1">Orders Ledger</a>
                <a href="index.php" class="hover:text-black transition-colors">Storefront View</a>
                <a href="logout.php" class="hover:text-red-700 transition-colors"><i class="fa-solid fa-power-off"></i></a>
            </nav>
        </div>
    </header>

    <!-- CORE ADMIN LAYOUT WRAPPER -->
    <main class="flex-grow max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-10">
        
        <!-- Welcome banner -->
        <div class="mb-10">
            <p class="text-[11px] uppercase tracking-[0.3em] text-neutral-400 font-medium mb-1">Internal Operations Suite</p>
            <h1 class="serif-font text-3xl font-normal tracking-wide text-neutral-900">Global Transaction Manifest</h1>
        </div>

        <!-- METRIC SUMMARY CARDS LAYER -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
            
            <div class="bg-white border border-neutral-200/60 p-6 shadow-xs">
                <span class="text-[10px] uppercase text-neutral-400 tracking-wider font-semibold block mb-2">Gross Transacted Capital</span>
                <span class="serif-font text-2xl font-normal text-neutral-900">Rs. <?= number_format($total_revenue) ?></span>
                <span class="text-[10px] text-emerald-700 block mt-1 font-medium"><i class="fa-solid fa-arrow-trend-up mr-1"></i> +12.4% vs last cycle</span>
            </div>

            <div class="bg-white border border-neutral-200/60 p-6 shadow-xs">
                <span class="text-[10px] uppercase text-neutral-400 tracking-wider font-semibold block mb-2">Processing Backlog</span>
                <span class="serif-font text-2xl font-normal text-neutral-900"><?= $processing_backlog ?> Orders</span>
                <span class="text-[10px] text-amber-700 block mt-1 font-medium"><i class="fa-solid fa-clock mr-1"></i> Awaiting atelier curation</span>
            </div>

            <div class="bg-white border border-neutral-200/60 p-6 shadow-xs">
                <span class="text-[10px] uppercase text-neutral-400 tracking-wider font-semibold block mb-2">Logistics In Transit</span>
                <span class="serif-font text-2xl font-normal text-neutral-900"><?= $shipped_transit ?> Consignments</span>
                <span class="text-[10px] text-blue-700 block mt-1 font-medium"><i class="fa-solid fa-truck-moving mr-1"></i> Handed to local carriers</span>
            </div>

            <div class="bg-white border border-neutral-200/60 p-6 shadow-xs">
                <span class="text-[10px] uppercase text-neutral-400 tracking-wider font-semibold block mb-2">Fulfilment Velocity</span>
                <span class="serif-font text-2xl font-normal text-neutral-900">98.2%</span>
                <span class="text-[10px] text-neutral-400 block mt-1 font-light">Target optimization metric achieved</span>
            </div>

        </div>

        <!-- Notification Alert Segment -->
        <?php if ($update_success): ?>
            <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-light flex items-center justify-between shadow-xs">
                <span class="flex items-center gap-2"><i class="fa-solid fa-circle-check text-emerald-600"></i> Logistical parameters for Manifest <strong class="font-mono font-medium"><?= $target_id ?></strong> successfully updated to <strong><?= $new_status ?></strong>.</span>
                <button onclick="this.parentElement.remove();" class="text-neutral-400 hover:text-black"><i class="fa-solid fa-xmark"></i></button>
            </div>
        <?php endif; ?>

        <!-- MAIN DATA TABLE HUB -->
        <div class="bg-white border border-neutral-200/60 shadow-xs overflow-hidden">
            
            <!-- Table Controls Filtering Ribbon -->
            <div class="p-5 border-b border-neutral-100 bg-neutral-50/50 flex flex-col sm:flex-row items-center justify-between gap-4">
                <div class="relative w-full sm:w-72">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-neutral-400"><i class="fa-solid fa-magnifying-glass text-xs"></i></span>
                    <input type="text" placeholder="Filter by client, manifest ID, or city..." class="w-full bg-white border border-neutral-200 pl-9 pr-4 py-2 text-xs focus:outline-none focus:border-neutral-900 rounded-none">
                </div>
                <div class="flex gap-2 w-full sm:w-auto justify-end">
                    <button class="bg-white border border-neutral-200 px-4 py-2 text-xs font-medium uppercase tracking-wider text-neutral-700 hover:border-neutral-400 transition-colors"><i class="fa-solid fa-filter mr-2 text-neutral-400"></i> Filter Matrix</button>
                    <button class="bg-white border border-neutral-200 px-4 py-2 text-xs font-medium uppercase tracking-wider text-neutral-700 hover:border-neutral-400 transition-colors"><i class="fa-solid fa-file-export mr-2 text-neutral-400"></i> Export CSV</button>
                </div>
            </div>

            <!-- Responsive Scrolling Table Container -->
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-neutral-900 text-white text-[10px] uppercase tracking-widest font-semibold">
                            <th class="py-4 px-6">Manifest ID</th>
                            <th class="py-4 px-6">Client Profile</th>
                            <th class="py-4 px-6">Routing Hub</th>
                            <th class="py-4 px-6">Items Count</th>
                            <th class="py-4 px-6">Transacted Capital</th>
                            <th class="py-4 px-6">Logistical Status</th>
                            <th class="py-4 px-6 text-right">Operational Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-neutral-100 text-xs text-neutral-700">
                        <?php foreach ($global_orders as $order): ?>
                            <tr class="hover:bg-neutral-50/60 transition-colors">
                                
                                <!-- Order Code ID -->
                                <td class="py-4 px-6 font-mono font-medium text-neutral-900">
                                    <a href="orderdetails.php?id=<?= $order['order_id'] ?>" class="hover:underline text-black"><?= htmlspecialchars($order['order_id']) ?></a>
                                </td>
                                
                                <!-- Client Identity Context -->
                                <td class="py-4 px-6">
                                    <div class="font-medium text-neutral-900"><?= htmlspecialchars($order['client']) ?></div>
                                    <div class="text-[10px] text-neutral-400 font-light"><?= htmlspecialchars($order['email']) ?></div>
                                </td>
                                
                                <!-- Logistics Routing City Location -->
                                <td class="py-4 px-6 font-light">
                                    <div><?= htmlspecialchars($order['city']) ?></div>
                                    <div class="text-[10px] text-neutral-400"><?= date("M d, Y", strtotime($order['date'])) ?></div>
                                </td>
                                
                                <!-- Items Count Quantities -->
                                <td class="py-4 px-6 font-light text-neutral-600">
                                    <?= $order['items_count'] ?> active <?= $order['items_count'] > 1 ? 'pieces' : 'piece' ?>
                                </td>
                                
                                <!-- Capital Cost Currency Values -->
                                <td class="py-4 px-6">
                                    <span class="font-semibold text-neutral-900">Rs. <?= number_format($order['total']) ?></span>
                                    <span class="text-[9px] block text-neutral-400 uppercase tracking-wider font-light"><?= $order['payment'] ?></span>
                                </td>
                                
                                <!-- Status Badge Indicators -->
                                <td class="py-4 px-6">
                                    <span class="px-2.5 py-1 text-[10px] tracking-wider font-medium uppercase border <?= $order['status_style'] ?>">
                                        <?= htmlspecialchars($order['status']) ?>
                                    </span>
                                </td>

                                <!-- Control Action Dropdowns / Triggers -->
                                <td class="py-4 px-6 text-right">
                                    <div class="inline-flex items-center space-x-2">
                                        <!-- Dynamic Quick-Shift Status Form Hook -->
                                        <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="inline flex items-center gap-1">
                                            <input type="hidden" name="target_order_id" value="<?= $order['order_id'] ?>">
                                            <input type="hidden" name="action_update" value="1">
                                            <select name="new_status" onchange="this.form.submit();" class="bg-neutral-50 border border-neutral-200 px-2 py-1 text-[11px] font-medium focus:outline-none focus:border-neutral-900 rounded-none cursor-pointer">
                                                <option value="">Shift Status</option>
                                                <option value="Processing">Processing</option>
                                                <option value="Shipped">Shipped</option>
                                                <option value="Delivered">Delivered</option>
                                            </select>
                                        </form>
                                        
                                        <!-- Explicit Deep Dive Blueprint Link -->
                                        <a href="orderdetails.php?id=<?= $order['order_id'] ?>" class="border border-neutral-200 bg-white hover:bg-neutral-900 hover:text-white text-neutral-800 p-1.5 transition-colors text-[11px]" title="Deep Review Manifest">
                                            <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                        </a>
                                    </div>
                                </td>

                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- Table Footnote Pagination Segment -->
            <div class="p-4 border-t border-neutral-100 bg-neutral-50/30 text-center text-[11px] text-neutral-400 font-light">
                Showing <?= count($global_orders) ?> entries across continuous historical tracking matrices.
            </div>

        </div>

    </main>

    <!-- SECURE COMPLIANCE LAYER FOOTER SIGNATURE -->
    <footer class="w-full py-6 px-4 border-t border-neutral-200/40 text-center text-neutral-400 text-[11px] font-light tracking-wider bg-white">
        <p>&copy; <?= date('Y'); ?> AESTHETIQUE Atelier Administration System. Encrypted Backoffice Node.</p>
    </footer>

</body>
</html>