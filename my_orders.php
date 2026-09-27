<?php
session_start();

// Mock Authentication Guard
// In production, unauthenticated requests should be immediately routed back to login.php
if (!isset($_SESSION['user_id'])) {
    // Simulating active session fallback parameters for direct file previewing
    $_SESSION['user_id'] = 1;
    $_SESSION['user_name'] = "Valued Client";
}

// Comprehensive Mock Order Database Array matching previous repository catalogs
$orders = [
    [
        "order_id" => "AE-98241",
        "date" => "2026-07-14",
        "status" => "Processing", // Processing | In Transit | Delivered
        "status_color" => "text-amber-700 bg-amber-50/60 border-amber-200",
        "payment_method" => "Digital Wallet (eSewa)",
        "delivery_city" => "Jhamsikhel, Lalitpur",
        "subtotal" => 18700,
        "delivery_fee" => 0, // Free delivery tier unlocked via subtotal threshold
        "items" => [
            [
                "name" => "Premium Silk Daura Suruwal Set",
                "brand" => "Aesthetique Heritage",
                "price" => 12500,
                "quantity" => 1,
                "size" => "L",
                "image" => "https://images.unsplash.com/photo-1609141071271-e94db9756b19?auto=format&fit=crop&w=300&q=80"
            ],
            [
                "name" => "Oversized Streetwear Heavyweight Hoodie",
                "brand" => "Aesthetique Lab",
                "price" => 6200,
                "quantity" => 1,
                "size" => "XL",
                "image" => "https://images.unsplash.com/photo-1556821840-3a63f95609a7?auto=format&fit=crop&w=300&q=80"
            ]
        ]
    ],
    [
        "order_id" => "AE-94112",
        "date" => "2026-05-28",
        "status" => "In Transit",
        "status_color" => "text-blue-700 bg-blue-50/60 border-blue-200",
        "payment_method" => "Cash on Delivery (COD)",
        "delivery_city" => "Pokhara Core",
        "subtotal" => 16500,
        "delivery_fee" => 150,
        "items" => [
            [
                "name" => "Minimalist Tailored Camel Trench",
                "brand" => "Studio Blanc",
                "price" => 16500,
                "quantity" => 1,
                "size" => "M",
                "image" => "https://images.unsplash.com/photo-1525507119028-ed4c629a60a3?auto=format&fit=crop&w=300&q=80"
            ]
        ]
    ],
    [
        "order_id" => "AE-81094",
        "date" => "2026-04-10",
        "status" => "Delivered",
        "status_color" => "text-emerald-700 bg-emerald-50/60 border-emerald-200",
        "payment_method" => "Direct Bank Transfer",
        "delivery_city" => "Dharan Hub",
        "subtotal" => 9800,
        "delivery_fee" => 150,
        "items" => [
            [
                "name" => "Authentic Newari Haku Patasi",
                "brand" => "Kwon Heritage",
                "price" => 9800,
                "quantity" => 1,
                "size" => "Free Size",
                "image" => "https://images.unsplash.com/photo-1583391733956-3750e0ff4e8b?auto=format&fit=crop&w=300&q=80"
            ]
        ]
    ]
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase Manifests | AESTHETIQUE</title>
    <!-- Tailwind CSS Engine CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Typography Engine & Icon Registers -->
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

    <!-- NAVIGATION PLATFORM BAR -->
    <header class="w-full py-6 px-4 sm:px-8 border-b border-neutral-200/60 bg-[#FAF9F6]/80 backdrop-blur-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <a href="index.php" class="serif-font text-xl tracking-[0.25em] uppercase font-semibold text-neutral-900">
                AESTHETIQUE
            </a>
            <div class="flex items-center space-x-6 text-xs uppercase tracking-widest font-medium text-neutral-500">
                <span class="text-neutral-900 border-b border-black pb-1 hidden sm:inline-block">Order Ledger</span>
                <a href="cart.php" class="hover:text-black transition-colors"><i class="fa-solid fa-bag-shopping text-base sm:text-xs"></i></a>
                <a href="logout.php" class="hover:text-black transition-colors text-red-700/80"><i class="fa-solid fa-arrow-right-from-bracket text-base sm:text-xs"></i></a>
            </div>
        </div>
    </header>

    <!-- CORE USER ARCHIVE MATRIX -->
    <main class="flex-grow max-w-5xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16">
        
        <!-- Welcome Hub Panel Header -->
        <div class="border-b border-neutral-200 pb-6 mb-10 flex flex-col sm:flex-row justify-between items-start sm:items-end gap-4">
            <div>
                <p class="text-[11px] uppercase tracking-[0.3em] text-neutral-400 font-medium mb-1">Client Dashboard</p>
                <h1 class="serif-font text-3xl font-normal tracking-wide text-neutral-900">
                    Salutations, <span class="italic font-normal"><?= htmlspecialchars($_SESSION['user_name']) ?></span>
                </h1>
            </div>
            <a href="index.php" class="text-xs uppercase tracking-widest bg-neutral-900 text-white px-5 py-2.5 hover:bg-neutral-800 transition-colors duration-200">
                Browse New Collections
            </a>
        </div>

        <?php if (empty($orders)): ?>
            <!-- EMPTY PROFILE LEDGER ARCHITECTURE -->
            <div class="text-center py-20 bg-white border border-neutral-200/60 shadow-xs">
                <i class="fa-solid fa-receipt text-3xl text-neutral-200 mb-4"></i>
                <p class="serif-font italic text-lg text-neutral-500 mb-2">No transaction manifests detected.</p>
                <p class="text-neutral-400 text-xs font-light max-w-xs mx-auto mb-6">Your personal account has not processed any collection sequences inside this terminal session yet.</p>
            </div>
        <?php else: ?>
            
            <!-- LISTED TRANSACTION NODES -->
            <div class="space-y-8">
                <?php foreach ($orders as $order): ?>
                    <section class="bg-white border border-neutral-200/60 shadow-xs overflow-hidden transition-all duration-300 hover:border-neutral-300">
                        
                        <!-- Order Node Meta Wrapper -->
                        <div class="bg-neutral-50/80 border-b border-neutral-100 p-4 sm:p-6 flex flex-wrap items-center justify-between gap-4 text-xs">
                            <div class="flex flex-wrap items-center gap-x-6 gap-y-2">
                                <div>
                                    <span class="text-[10px] uppercase text-neutral-400 tracking-wider font-medium block">Manifest Identifier</span>
                                    <span class="font-mono font-medium text-neutral-900 text-sm"><?= htmlspecialchars($order['order_id']) ?></span>
                                </div>
                                <div>
                                    <span class="text-[10px] uppercase text-neutral-400 tracking-wider font-medium block">Placement Date</span>
                                    <span class="text-neutral-700 font-light"><?= date("F d, Y", strtotime($order['date'])) ?></span>
                                </div>
                                <div>
                                    <span class="text-[10px] uppercase text-neutral-400 tracking-wider font-medium block">Distribution Hub</span>
                                    <span class="text-neutral-700 font-light"><?= htmlspecialchars($order['delivery_city']) ?></span>
                                </div>
                                <div>
                                    <span class="text-[10px] uppercase text-neutral-400 tracking-wider font-medium block">Capital Transacted</span>
                                    <span class="font-semibold text-neutral-900">Rs. <?= number_format($order['subtotal'] + $order['delivery_fee']) ?></span>
                                </div>
                            </div>

                            <!-- Dynamic Logistics Pill Tag Badge -->
                            <span class="px-3 py-1 text-[11px] tracking-widest font-medium uppercase border <?= $order['status_color'] ?>">
                                <?= htmlspecialchars($order['status']) ?>
                            </span>
                        </div>

                        <!-- Inner Packaged Items Matrix Loop -->
                        <div class="divide-y divide-neutral-100 px-4 sm:px-6">
                            <?php foreach ($order['items'] as $item): ?>
                                <div class="py-5 flex items-center justify-between gap-4">
                                    <div class="flex items-center space-x-4">
                                        <!-- Image Framing Core -->
                                        <div class="w-14 aspect-[3/4] bg-neutral-50 border border-neutral-100 overflow-hidden flex-shrink-0">
                                            <img src="<?= htmlspecialchars($item['image']) ?>" alt="" class="w-full h-full object-cover">
                                        </div>
                                        <div>
                                            <span class="text-[9px] uppercase tracking-wider text-neutral-400 block font-medium"><?= htmlspecialchars($item['brand']) ?></span>
                                            <h4 class="text-xs text-neutral-900 font-medium line-clamp-1 mt-0.5"><?= htmlspecialchars($item['name']) ?></h4>
                                            <p class="text-[10px] text-neutral-400 font-light mt-1">
                                                Size: <span class="font-medium text-neutral-700"><?= $item['size'] ?></span> &middot; Qty: <span class="font-medium text-neutral-700"><?= $item['quantity'] ?></span>
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Price Matrix -->
                                    <div class="text-right text-xs">
                                        <span class="font-medium text-neutral-900 block">Rs. <?= number_format($item['price'] * $item['quantity']) ?></span>
                                        <?php if($item['quantity'] > 1): ?>
                                            <span class="text-[9px] text-neutral-400 font-light block">Rs. <?= number_format($item['price']) ?> each</span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <!-- Structural Context Operational Actions Bar -->
                        <div class="bg-neutral-50/30 border-t border-neutral-100 p-4 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 text-xs font-light text-neutral-500">
                            <div>
                                <i class="fa-solid fa-credit-card text-neutral-400 mr-1"></i> Settlement Gateway: <span class="font-medium text-neutral-700"><?= htmlspecialchars($order['payment_method']) ?></span>
                            </div>
                            
                            <!-- Tactical Dynamic Inquiries Redirect Buttons -->
                            <div class="flex space-x-3 w-full sm:w-auto">
                                <button class="flex-grow sm:flex-grow-0 border border-neutral-200 hover:border-neutral-400 bg-white text-neutral-800 px-4 py-2 font-medium uppercase tracking-wider text-[10px] transition-colors duration-150">
                                    Track Consignment
                                </button>
                                <button class="flex-grow sm:flex-grow-0 bg-neutral-900 hover:bg-neutral-800 text-white px-4 py-2 font-medium uppercase tracking-wider text-[10px] transition-colors duration-150">
                                    Digital Invoice
                                </button>
                            </div>
                        </div>

                    </section>
                <?php endforeach; ?>
            </div>

        <?php endif; ?>

    </main>

    <!-- SECURE COMPLIANCE LAYER FOOTER SIGNATURE -->
    <footer class="w-full py-6 px-4 border-t border-neutral-200/40 text-center text-neutral-400 text-[11px] font-light tracking-wider bg-white">
        <p>&copy; <?= date('Y'); ?> AESTHETIQUE Atelier. Protected via Layered Cryptography Protocols.</p>
    </footer>

</body>
</html>