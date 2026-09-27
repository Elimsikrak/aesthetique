<?php
session_start();

// Redirect to orders directory if no specific manifest identifier is passed
if (!isset($_GET['id'])) {
    header("Location: my_orders.php");
    exit;
}

$target_order_id = filter_var(trim($_GET['id']), FILTER_SANITIZE_SPECIAL_CHARS);

// Comprehensive mock repository for the target order manifest
// In production, this data structure will be fetched directly via: SELECT * FROM orders WHERE order_id = :id
$order_exists = true;

$order_details = [
    "order_id" => "AE-98241",
    "date" => "2026-07-14 14:32:00",
    "status" => "Processing", // Placed | Processing | Shipped | Delivered
    "payment_method" => "Digital Wallet (eSewa)",
    "payment_status" => "Verified & Settled",
    "transaction_reference" => "TXN-ES-8973210X",
    
    // Shipping Records
    "shipping_name" => "Aarav Sharma",
    "shipping_phone" => "+977 9851012345",
    "shipping_email" => "aarav.sharma@domain.com",
    "shipping_address" => "House 42, Ward 3, Jhamsikhel",
    "shipping_city" => "Jhamsikhel, Lalitpur",
    "carrier" => "Aesthetique Premium Logistics",
    "tracking_number" => "TRK-HIMAL-77491",

    // Financial Ledger Matrix
    "subtotal" => 18700,
    "delivery_fee" => 0, 
    "tax_amount" => 0, // Inclusive of custom cultural duties
    
    // Manifest Line-Items Inventory
    "items" => [
        [
            "name" => "Premium Silk Daura Suruwal Set",
            "brand" => "Aesthetique Heritage",
            "price" => 12500,
            "quantity" => 1,
            "size" => "L",
            "sku" => "AE-CUL-DSS-09",
            "image" => "https://images.unsplash.com/photo-1609141071271-e94db9756b19?auto=format&fit=crop&w=300&q=80"
        ],
        [
            "name" => "Oversized Streetwear Heavyweight Hoodie",
            "brand" => "Aesthetique Lab",
            "price" => 6200,
            "quantity" => 1,
            "size" => "XL",
            "sku" => "AE-MOD-HD-13",
            "image" => "https://images.unsplash.com/photo-1556821840-3a63f95609a7?auto=format&fit=crop&w=300&q=80"
        ]
    ]
];

// Fallback logic for demo verification if parameter doesn't match mock tracking sequence
if ($target_order_id !== $order_details['order_id']) {
    // Override ID dynamically for seamless local presentation/testing flow
    $order_details['order_id'] = $target_order_id;
}

$total_payable = $order_details['subtotal'] + $order_details['delivery_fee'] + $order_details['tax_amount'];

// Timeline tracker execution indices based on current backend statuses
$status_steps = ["Placed" => 1, "Processing" => 2, "Shipped" => 3, "Delivered" => 4];
$current_step_index = isset($status_steps[$order_details['status']]) ? $status_steps[$order_details['status']] : 1;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manifest Deep-Dive: <?= htmlspecialchars($order_details['order_id']) ?> | AESTHETIQUE</title>
    <!-- Tailwind CSS Engine CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Typography & Icon Repositories -->
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

    <!-- NAVIGATION ANCHOR INTERFACE -->
    <header class="w-full py-6 px-4 sm:px-8 border-b border-neutral-200/60 bg-[#FAF9F6]/80 backdrop-blur-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <a href="index.php" class="serif-font text-xl tracking-[0.25em] uppercase font-semibold text-neutral-900">
                AESTHETIQUE
            </a>
            <a href="my_orders.php" class="text-xs uppercase tracking-widest text-neutral-500 hover:text-black transition-colors flex items-center space-x-2">
                <i class="fa-solid fa-arrow-left text-[10px]"></i>
                <span>Return to Manifest Registry</span>
            </a>
        </div>
    </header>

    <!-- SYSTEM FILE LAYER PLATFORM -->
    <main class="flex-grow max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-12">
        
        <!-- Header Metadata Block -->
        <div class="flex flex-col md:flex-row md:items-center justify-between border-b border-neutral-200 pb-6 mb-8 gap-4">
            <div>
                <div class="flex items-center gap-3">
                    <h1 class="serif-font text-2xl sm:text-3xl font-normal tracking-wide text-neutral-900">
                        Order <span class="font-mono text-xl sm:text-2xl font-medium"><?= htmlspecialchars($order_details['order_id']) ?></span>
                    </h1>
                </div>
                <p class="text-neutral-500 text-xs mt-1.5 font-light">
                    Registered to processing nodes on <?= date("F d, Y &bull; g:i A", strtotime($order_details['date'])) ?>
                </p>
            </div>
            
            <div class="flex items-center gap-3">
                <button onclick="window.print();" class="border border-neutral-200 hover:border-neutral-400 bg-white text-neutral-800 px-4 py-2.5 text-xs font-medium uppercase tracking-wider transition-colors">
                    <i class="fa-solid fa-print mr-2 text-neutral-400"></i> Print Receipt Document
                </button>
            </div>
        </div>

        <!-- HIGH-END INTERACTIVE TIMELINE LOGISTICS TRACKER -->
        <div class="bg-white border border-neutral-200/60 p-6 sm:p-10 shadow-xs mb-8">
            <div class="relative flex flex-col sm:flex-row justify-between items-center gap-8 sm:gap-0">
                
                <!-- Background Line Path Connectors -->
                <div class="hidden sm:block absolute top-5 left-0 w-full h-[2px] bg-neutral-100 -z-0">
                    <div class="h-full bg-neutral-900 transition-all duration-500" style="width: <?= (($current_step_index - 1) / 3) * 100 ?>%;"></div>
                </div>

                <!-- Step 01: Placed -->
                <div class="flex sm:flex-col items-center gap-4 sm:gap-2 z-10 w-full sm:w-auto">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center text-xs font-semibold transition-all duration-300 border <?= $current_step_index >= 1 ? 'bg-neutral-900 text-white border-neutral-900' : 'bg-white text-neutral-400 border-neutral-200' ?>">
                        <?php if($current_step_index > 1): ?><i class="fa-solid fa-check"></i><?php else: ?>01<?php endif; ?>
                    </div>
                    <div class="text-left sm:text-center">
                        <span class="text-xs font-medium block text-neutral-900">Manifest Placed</span>
                        <span class="text-[10px] text-neutral-400 block font-light">Verification completed</span>
                    </div>
                </div>

                <!-- Step 02: Processing -->
                <div class="flex sm:flex-col items-center gap-4 sm:gap-2 z-10 w-full sm:w-auto">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center text-xs font-semibold transition-all duration-300 border <?= $current_step_index >= 2 ? 'bg-neutral-900 text-white border-neutral-900' : 'bg-white text-neutral-400 border-neutral-200' ?>">
                        <?php if($current_step_index > 2): ?><i class="fa-solid fa-check"></i><?php else: ?>02<?php endif; ?>
                    </div>
                    <div class="text-left sm:text-center">
                        <span class="text-xs font-medium block text-neutral-900">Atelier Processing</span>
                        <span class="text-[10px] text-neutral-400 block font-light">Garment curation active</span>
                    </div>
                </div>

                <!-- Step 03: Shipped -->
                <div class="flex sm:flex-col items-center gap-4 sm:gap-2 z-10 w-full sm:w-auto">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center text-xs font-semibold transition-all duration-300 border <?= $current_step_index >= 3 ? 'bg-neutral-900 text-white border-neutral-900' : 'bg-white text-neutral-400 border-neutral-200' ?>">
                        <?php if($current_step_index > 3): ?><i class="fa-solid fa-check"></i><?php else: ?>03<?php endif; ?>
                    </div>
                    <div class="text-left sm:text-center">
                        <span class="text-xs font-medium block text-neutral-900">Consignment Shipped</span>
                        <span class="text-[10px] text-neutral-400 block font-light">In transit to regional hub</span>
                    </div>
                </div>

                <!-- Step 04: Delivered -->
                <div class="flex sm:flex-col items-center gap-4 sm:gap-2 z-10 w-full sm:w-auto">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center text-xs font-semibold transition-all duration-300 border <?= $current_step_index >= 4 ? 'bg-neutral-900 text-white border-neutral-900' : 'bg-white text-neutral-400 border-neutral-200' ?>">
                        04
                    </div>
                    <div class="text-left sm:text-center">
                        <span class="text-xs font-medium block text-neutral-400 <?= $current_step_index == 4 ? 'text-neutral-900' : '' ?>">Delivered</span>
                        <span class="text-[10px] text-neutral-400 block font-light">Handoff signature verified</span>
                    </div>
                </div>

            </div>
        </div>

        <!-- SPLIT GRID TWO-COLUMN CORE ARCHITECTURE -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            <!-- LEFT AREA: APPAREL INVENTORY & SYSTEM META REGISTERS -->
            <div class="lg:col-span-8 space-y-8">
                
                <!-- Package Content Ledger Card -->
                <div class="bg-white border border-neutral-200/60 shadow-xs overflow-hidden">
                    <div class="px-6 py-4 border-b border-neutral-100 bg-neutral-50/40">
                        <h3 class="serif-font text-base text-neutral-900 tracking-wide font-normal">Packaged Manifest Selections</h3>
                    </div>
                    <div class="divide-y divide-neutral-100 px-6">
                        <?php foreach ($order_details['items'] as $item): ?>
                            <article class="py-6 flex gap-6 items-center justify-between">
                                <div class="flex items-center space-x-4">
                                    <div class="w-16 aspect-[3/4] bg-neutral-50 border border-neutral-100 flex-shrink-0 overflow-hidden">
                                        <img src="<?= htmlspecialchars($item['image']) ?>" alt="" class="w-full h-full object-cover">
                                    </div>
                                    <div>
                                        <span class="text-[9px] uppercase tracking-widest text-neutral-400 block font-medium"><?= htmlspecialchars($item['brand']) ?></span>
                                        <h4 class="text-xs sm:text-sm text-neutral-900 font-medium mt-0.5 line-clamp-1"><?= htmlspecialchars($item['name']) ?></h4>
                                        <p class="text-[11px] text-neutral-500 font-light mt-1.5 flex flex-wrap gap-x-3 gap-y-0.5">
                                            <span>SKU: <strong class="font-mono text-neutral-700"><?= $item['sku'] ?></strong></span>
                                            <span class="text-neutral-200">|</span>
                                            <span>Size: <strong class="text-neutral-700 font-medium"><?= $item['size'] ?></strong></span>
                                            <span class="text-neutral-200">|</span>
                                            <span>Quantity: <strong class="text-neutral-700 font-medium"><?= $item['quantity'] ?></strong></span>
                                        </p>
                                    </div>
                                </div>
                                <div class="text-right text-xs">
                                    <span class="font-semibold text-neutral-900 block">Rs. <?= number_format($item['price'] * $item['quantity']) ?></span>
                                    <?php if($item['quantity'] > 1): ?>
                                        <span class="text-[10px] text-neutral-400 font-light block">Rs. <?= number_format($item['price']) ?> each</span>
                                    <?php endif; ?>
                                </div>
                            </article>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Regional Logistical & Consignment Addresses Matrix Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    
                    <!-- Logistic Shipping Node Card -->
                    <div class="bg-white border border-neutral-200/60 p-6 shadow-xs">
                        <h4 class="text-[11px] uppercase tracking-widest text-neutral-400 font-semibold mb-4 border-b border-neutral-100 pb-2">
                            <i class="fa-solid fa-truck text-neutral-500 mr-1"></i> Distribution Address
                        </h4>
                        <div class="text-xs space-y-2 font-light text-neutral-600">
                            <p class="font-medium text-neutral-900 text-sm"><?= htmlspecialchars($order_details['shipping_name']) ?></p>
                            <p><?= htmlspecialchars($order_details['shipping_address']) ?></p>
                            <p><?= htmlspecialchars($order_details['shipping_city']) ?></p>
                            <p class="pt-2 flex items-center gap-2"><i class="fa-solid fa-phone text-neutral-400 text-[10px]"></i> <?= htmlspecialchars($order_details['shipping_phone']) ?></p>
                            <p class="flex items-center gap-2"><i class="fa-solid fa-envelope text-neutral-400 text-[10px]"></i> <?= htmlspecialchars($order_details['shipping_email']) ?></p>
                        </div>
                    </div>

                    <!-- Gateway Financial Settlement Card -->
                    <div class="bg-white border border-neutral-200/60 p-6 shadow-xs">
                        <h4 class="text-[11px] uppercase tracking-widest text-neutral-400 font-semibold mb-4 border-b border-neutral-100 pb-2">
                            <i class="fa-solid fa-credit-card text-neutral-500 mr-1"></i> Settlement Authentication
                        </h4>
                        <div class="text-xs space-y-2 font-light text-neutral-600">
                            <p class="text-neutral-900 font-medium"><?= htmlspecialchars($order_details['payment_method']) ?></p>
                            <p class="flex items-center gap-2">
                                Status: <span class="text-emerald-700 font-semibold uppercase tracking-wider text-[10px] px-1.5 py-0.5 bg-emerald-50 border border-emerald-100"><?= htmlspecialchars($order_details['payment_status']) ?></span>
                            </p>
                            <div class="pt-2">
                                <span class="text-[10px] uppercase text-neutral-400 tracking-wider font-medium block mb-0.5">Gateway Reference Protocol</span>
                                <span class="font-mono text-neutral-800 text-[11px] bg-neutral-50 px-1.5 py-1 border border-neutral-200/50 block w-full overflow-x-auto select-all"><?= htmlspecialchars($order_details['transaction_reference']) ?></span>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

            <!-- RIGHT AREA: STICKY CAPITALIZATION TOTAL LEDGER -->
            <div class="lg:col-span-4 space-y-6 lg:sticky lg:top-28">
                
                <div class="bg-white border border-neutral-200/60 p-6 sm:p-8 shadow-xs">
                    <h3 class="serif-font text-lg text-neutral-900 tracking-wide mb-6 pb-2 border-b border-neutral-100">
                        Transactional Ledger
                    </h3>
                    
                    <div class="space-y-4 text-xs font-light">
                        <div class="flex justify-between text-neutral-500">
                            <span>Subtotal Base Count</span>
                            <span class="font-medium text-neutral-900">Rs. <?= number_format($order_details['subtotal']) ?></span>
                        </div>
                        <div class="flex justify-between text-neutral-500">
                            <span>Premium Curated Logistics</span>
                            <span class="font-medium text-neutral-900"><?= $order_details['delivery_fee'] == 0 ? 'Complimentary' : 'Rs. ' . number_format($order_details['delivery_fee']) ?></span>
                        </div>
                        <div class="flex justify-between text-neutral-500">
                            <span>Custom Duties / Internal Tax</span>
                            <span class="font-medium text-neutral-900">Rs. <?= number_format($order_details['tax_amount']) ?></span>
                        </div>
                        
                        <div class="h-[1px] bg-neutral-200 my-4"></div>
                        
                        <div class="flex justify-between text-sm text-neutral-900 font-medium">
                            <span class="serif-font tracking-wide">Final Capital Settled</span>
                            <span class="text-base text-neutral-900 font-semibold">Rs. <?= number_format($total_payable) ?></span>
                        </div>
                    </div>
                </div>

                <!-- CARRIER CONSIGNMENT TRACKING EXTRACTION CARD -->
                <?php if(!empty($order_details['tracking_number'])): ?>
                    <div class="bg-white border border-neutral-200/60 p-6 shadow-xs">
                        <h4 class="text-[11px] uppercase tracking-widest text-neutral-400 font-semibold mb-3">
                            <i class="fa-solid fa-box-open text-neutral-500 mr-1"></i> Consignment Dispatch Tracking
                        </h4>
                        <div class="text-xs space-y-2 font-light">
                            <p class="text-neutral-500">Logistics Carrier: <strong class="font-medium text-neutral-800"><?= htmlspecialchars($order_details['carrier']) ?></strong></p>
                            <div>
                                <span class="text-[10px] text-neutral-400 uppercase font-medium block mb-1">Waybill Air Tracking Index</span>
                                <span class="font-mono text-neutral-800 bg-neutral-50 px-2 py-1.5 border border-neutral-200/60 block font-medium tracking-wide"><?= htmlspecialchars($order_details['tracking_number']) ?></span>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

            </div>

        </div>

    </main>

    <!-- LAYER COMPLIANCE FOOTER CAPTION -->
    <footer class="w-full py-6 px-4 border-t border-neutral-200/40 text-center text-neutral-400 text-[11px] font-light tracking-wider bg-white">
        <p>&copy; <?= date('Y'); ?> AESTHETIQUE Atelier. Receipts Automatically Generated by Encrypted Transacting Channels.</p>
    </footer>

</body>
</html>