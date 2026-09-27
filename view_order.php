<?php
session_start();
include("includes/db.php");

// Strict authentication enforcement
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$user_id = (int)$_SESSION['user_id'];
$order_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if($order_id <= 0) {
    header("Location: my_orders.php");
    exit();
}

/**
 * Secure Ledger Query: Matches both order ID and active user session 
 * to strictly prevent cross-user data exposure.
 */
$order_query = mysqli_query($conn, "
    SELECT * FROM orders 
    WHERE id = $order_id AND user_id = $user_id
");
$order = mysqli_fetch_assoc($order_query);

if(!$order){
    die("Order record context not found or access authorization denied.");
}

/**
 * Fetch detailed line items mapped to the product matrix
 * Adjust column selections if your schema differs slightly (e.g., order_details, items)
 */
$items_query = mysqli_query($conn, "
    SELECT oi.*, p.product_name, p.image 
    FROM order_items oi 
    JOIN products p ON oi.product_id = p.id 
    WHERE oi.order_id = $order_id
");

// Determine uniform progress steps for visual tracking logic
$current_status = strtolower(trim($order['status'] ?? 'pending'));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Invoice #<?= $order_id ?> | AESTHETIQUE</title>
    <!-- Tailwind CSS Engine -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Premium Google Fonts -->
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

    <!-- PLATFORM HEADER NAVIGATION -->
    <?php include("includes/navbar.php"); ?>

    <!-- INVOICE WRAPPER ARCHITECTURE -->
    <main class="flex-grow max-w-4xl w-full mx-auto px-4 sm:px-6 py-12">
        
        <!-- Action Back Utility Link -->
        <div class="mb-8">
            <a href="my_orders.php" class="text-[10px] uppercase tracking-widest font-semibold text-neutral-400 hover:text-black transition-colors inline-flex items-center gap-2">
                <i class="fa-solid fa-arrow-left-long text-[9px]"></i> Return to Ledger
            </a>
        </div>

        <!-- ORDER META OVERVIEW PANEL -->
        <div class="bg-white border border-neutral-200/60 p-6 sm:p-8 shadow-2xs space-y-6 mb-6">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 pb-6 border-b border-neutral-100">
                <div>
                    <span class="text-[10px] uppercase tracking-[0.2em] text-neutral-400 block font-medium">Manifest Identification</span>
                    <h1 class="serif-font text-2xl font-normal text-neutral-900 mt-0.5">Order Vault #<?= $order_id ?></h1>
                    <p class="text-[11px] text-neutral-400 font-light mt-1">
                        Placed on: <span class="font-mono text-neutral-600"><?= date('F d, Y', strtotime($order['created_at'])) ?></span>
                    </p>
                </div>
                
                <!-- Explicit Luxury Status Pill Configuration -->
                <div>
                    <?php if($current_status === 'delivered' || $current_status === 'completed'): ?>
                        <span class="px-3 py-1 bg-emerald-50 border border-emerald-200 text-emerald-700 text-[10px] font-semibold tracking-widest uppercase">Fulfilled</span>
                    <?php elseif($current_status === 'cancelled' || $current_status === 'rejected'): ?>
                        <span class="px-3 py-1 bg-red-50 border border-red-200 text-red-600 text-[10px] font-semibold tracking-widest uppercase">Void</span>
                    <?php else: ?>
                        <span class="px-3 py-1 bg-neutral-900 text-white text-[10px] font-semibold tracking-widest uppercase animate-pulse">Processing</span>
                    <?php endif; ?>
                </div>
            </div>

            <!-- VISUAL FULFILLMENT TRACKER STEPPER -->
            <?php if($current_status !== 'cancelled' && $current_status !== 'rejected'): ?>
                <div class="py-4">
                    <div class="relative w-full bg-neutral-100 h-[2px] rounded-full flex justify-between items-center">
                        <!-- Progress Indicator Bar line shifts based on active string match states -->
                        <?php 
                            $width = 'w-1/3'; 
                            if($current_status === 'shipped') $width = 'w-2/3';
                            if($current_status === 'delivered' || $current_status === 'completed') $width = 'w-full';
                        ?>
                        <div class="absolute top-0 left-0 bg-neutral-900 h-full <?= $width ?> transition-all duration-500"></div>

                        <!-- Step 1: Placed -->
                        <div class="z-10 flex flex-col items-center">
                            <div class="w-5 h-5 rounded-full bg-neutral-900 text-white flex items-center justify-center text-[8px]"><i class="fa-solid fa-check"></i></div>
                            <span class="text-[9px] uppercase tracking-wider font-semibold text-neutral-900 mt-2 bg-[#FAF9F6] px-1">Placed</span>
                        </div>
                        <!-- Step 2: Shipped -->
                        <div class="z-10 flex flex-col items-center">
                            <div class="w-5 h-5 rounded-full border flex items-center justify-center text-[8px] transition-colors <?= ($current_status === 'shipped' || $current_status === 'delivered' || $current_status === 'completed') ? 'bg-neutral-900 border-neutral-900 text-white' : 'bg-white border-neutral-200 text-neutral-300' ?>">
                                <?php if($current_status === 'shipped' || $current_status === 'delivered' || $current_status === 'completed') echo '<i class="fa-solid fa-check"></i>'; ?>
                            </div>
                            <span class="text-[9px] uppercase tracking-wider font-semibold mt-2 bg-[#FAF9F6] px-1 <?= ($current_status === 'shipped' || $current_status === 'delivered' || $current_status === 'completed') ? 'text-neutral-900' : 'text-neutral-400' ?>">Shipped</span>
                        </div>
                        <!-- Step 3: Delivered -->
                        <div class="z-10 flex flex-col items-center">
                            <div class="w-5 h-5 rounded-full border flex items-center justify-center text-[8px] transition-colors <?= ($current_status === 'delivered' || $current_status === 'completed') ? 'bg-neutral-900 border-neutral-900 text-white' : 'bg-white border-neutral-200 text-neutral-300' ?>">
                                <?php if($current_status === 'delivered' || $current_status === 'completed') echo '<i class="fa-solid fa-check"></i>'; ?>
                            </div>
                            <span class="text-[9px] uppercase tracking-wider font-semibold mt-2 bg-[#FAF9F6] px-1 <?= ($current_status === 'delivered' || $current_status === 'completed') ? 'text-neutral-900' : 'text-neutral-400' ?>">Delivered</span>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- PRIMARY SPLIT DETAILS GRID -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
            
            <!-- COLUMN 1: LINE PIECE LEDGER ITEMS (Wider Framework) -->
            <div class="lg:col-span-2 bg-white border border-neutral-200/60 p-6 shadow-2xs space-y-4">
                <h3 class="text-[11px] uppercase tracking-widest font-semibold text-neutral-400 pb-3 border-b border-neutral-100">
                    Curation Breakdown
                </h3>
                
                <div class="divide-y divide-neutral-100">
                    <?php while($item = mysqli_fetch_assoc($items_query)): ?>
                        <div class="flex items-center py-4 first:pt-0 last:pb-0 gap-4">
                            <!-- Piece Image Display Wrapper -->
                            <div class="w-16 aspect-[3/4] bg-neutral-50 border border-neutral-200/60 overflow-hidden shrink-0">
                                <img src="uploads/<?= htmlspecialchars($item['image']) ?>" 
                                     alt="<?= htmlspecialchars($item['product_name']) ?>" 
                                     class="w-full h-full object-cover">
                            </div>
                            <!-- Structural Item Metadata Columns -->
                            <div class="flex-grow min-w-0">
                                <h4 class="text-xs font-medium text-neutral-900 line-clamp-1">
                                    <?= htmlspecialchars($item['product_name']) ?>
                                </h4>
                                <p class="text-[10px] text-neutral-400 mt-0.5 font-light">
                                    Qty: <span class="font-mono text-neutral-600 font-medium"><?= (int)$item['quantity'] ?></span>
                                </p>
                            </div>
                            <!-- Final Value Alignments -->
                            <div class="text-right shrink-0">
                                <span class="text-xs font-semibold text-neutral-900 font-mono">
                                    Rs. <?= number_format($item['price'] * $item['quantity']) ?>
                                </span>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>

            <!-- COLUMN 2: FINANCIAL SUMMARY AND ROUTING DATA (Narrower Framework) -->
            <div class="space-y-6">
                
                <!-- Financial Ledger Box -->
                <div class="bg-white border border-neutral-200/60 p-6 shadow-2xs space-y-4">
                    <h3 class="text-[11px] uppercase tracking-widest font-semibold text-neutral-400 pb-2 border-b border-neutral-100">
                        Financial Statement
                    </h3>
                    
                    <div class="space-y-2 text-xs">
                        <div class="flex justify-between text-neutral-500 font-light">
                            <span>Subtotal</span>
                            <span class="font-mono">Rs. <?= number_format($order['total_amount']) ?></span>
                        </div>
                        <div class="flex justify-between text-neutral-500 font-light">
                            <span>Shipping Costs</span>
                            <span class="font-mono text-[11px] italic text-neutral-400">Complimentary</span>
                        </div>
                        <div class="pt-3 border-t border-neutral-100 flex justify-between text-neutral-900 font-semibold items-baseline">
                            <span class="text-[10px] uppercase tracking-wider font-medium">Grand Aggregate</span>
                            <span class="text-sm font-mono">Rs. <?= number_format($order['total_amount']) ?></span>
                        </div>
                    </div>
                </div>

                <!-- Client Logistics Mapping Box -->
                <div class="bg-white border border-neutral-200/60 p-6 shadow-2xs space-y-3">
                    <h3 class="text-[11px] uppercase tracking-widest font-semibold text-neutral-400 pb-2 border-b border-neutral-100">
                        Shipping Logistics
                    </h3>
                    <div class="text-xs space-y-1.5 text-neutral-600 font-light">
                        <p class="font-medium text-neutral-900"><?= htmlspecialchars($_SESSION['user_fullname'] ?? 'Verified Patron') ?></p>
                        <!-- Dynamic address mapping safe fallback block -->
                        <p class="leading-relaxed">
                            <?= !empty($order['address']) ? htmlspecialchars($order['address']) : 'Registered Delivery Address on File' ?>
                        </p>
                    </div>
                </div>

            </div>
        </div>

    </main>

    <!-- SYSTEM FOOTER SIGNATURE -->
    <footer class="w-full py-8 px-4 border-t border-neutral-200/40 text-center text-neutral-400 text-[10px] font-light tracking-wider bg-white mt-20">
        <p>&copy; 2026 AESTHETIQUE Atelier. Invoice files tracked globally under automated cryptographic ledger sequences.</p>
    </footer>

</body>
</html>