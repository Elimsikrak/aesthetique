<?php
session_start();

// Build cart items from session cart + product catalog (minimal changes)
// $_SESSION['cart'] format is: [ product_id => quantity ]
if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Use the same lightweight catalog already present in index.php (structure unchanged)
$products = [
    ["id" => 1, "name" => "Premium Silk Daura Suruwal Set", "category" => "nepali", "brand" => "Aesthetique Heritage", "price" => 12500, "image" => "images/images.jpg"],
    ["id" => 2, "name" => "Classic Velvet Gunyou Cholo", "category" => "nepali", "brand" => "Aesthetique Heritage", "price" => 14200, "image" => "images/2png.webp"],
    ["id" => 3, "name" => "Authentic Newari Haku Patasi", "category" => "nepali", "brand" => "Kwon Heritage", "price" => 9800, "image" => "https://images.unsplash.com/photo-1583391733956-3750e0ff4e8b?auto=format&fit=crop&w=600&q=80"],
    ["id" => 4, "name" => "Traditional Gurung Ghalek & Chholo", "category" => "nepali", "brand" => "Himalayan Loom", "price" => 8500, "image" => "https://images.unsplash.com/photo-1561414927-6d86591d0c4f?auto=format&fit=crop&w=600&q=80"],
    ["id" => 5, "name" => "Hand-woven Palpali Dhaka Kurti", "category" => "nepali", "brand" => "Aesthetique Heritage", "price" => 5500, "image" => "https://images.unsplash.com/photo-1617627143750-d86bc21e42bb?auto=format&fit=crop&w=600&q=80"],
    ["id" => 6, "name" => "Premium Sherpa Bakhu (Chhuba)", "category" => "nepali", "brand" => "Himalayan Loom", "price" => 18000, "image" => "https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&w=600&q=80"],
    ["id" => 7, "name" => "Tamang Selo Cultural Attire Set", "category" => "nepali", "brand" => "Kwon Heritage", "price" => 9200, "image" => "https://images.unsplash.com/photo-1621184455862-c163dfb30e0f?auto=format&fit=crop&w=600&q=80"],
    ["id" => 8, "name" => "Mithila Art Infused Organza Saree", "category" => "nepali", "brand" => "Janakpur Crafts", "price" => 11000, "image" => "https://images.unsplash.com/photo-1610030470298-4058fbb6f331?auto=format&fit=crop&w=600&q=80"],
    ["id" => 9, "name" => "Royal Brocade Dhaka Sherwani", "category" => "nepali", "brand" => "Aesthetique Premium", "price" => 24500, "image" => "https://images.unsplash.com/photo-1611957159355-012978424a5f?auto=format&fit=crop&w=600&q=80"],
    ["id" => 10, "name" => "Rai Sakela Traditional Attire", "category" => "nepali", "brand" => "Himalayan Loom", "price" => 8900, "image" => "https://images.unsplash.com/photo-1596755094514-f87e34085b2c?auto=format&fit=crop&w=600&q=80"],
    ["id" => 11, "name" => "Bhojpuri Cultural Lehanga-Choli", "category" => "nepali", "brand" => "Janakpur Crafts", "price" => 13500, "image" => "https://images.unsplash.com/photo-1583391265517-35bbadd01209?auto=format&fit=crop&w=600&q=80"],
    ["id" => 12, "name" => "Minimalist Tailored Camel Trench", "category" => "modern", "brand" => "Studio Blanc", "price" => 16500, "image" => "https://images.unsplash.com/photo-1525507119028-ed4c629a60a3?auto=format&fit=crop&w=600&q=80"],
    ["id" => 13, "name" => "Oversized Streetwear Heavyweight Hoodie", "category" => "modern", "brand" => "Aesthetique Lab", "price" => 6200, "image" => "https://images.unsplash.com/photo-1556821840-3a63f95609a7?auto=format&fit=crop&w=600&q=80"],
    ["id" => 14, "name" => "Slim-Fit Charcoal Deconstructed Blazer", "category" => "modern", "brand" => "Studio Blanc", "price" => 11500, "image" => "https://images.unsplash.com/photo-1507679799987-c73779587ccf?auto=format&fit=crop&w=600&q=80"],
    ["id" => 15, "name" => "Ethereal Linen Summer Maxi Dress", "category" => "modern", "brand" => "Nordic Vibe", "price" => 7800, "image" => "https://images.unsplash.com/photo-1595777457583-95e059d581b8?auto=format&fit=crop&w=600&q=80"],
    ["id" => 16, "name" => "Vintage Wash Raw Denim Jacket", "category" => "modern", "brand" => "Aesthetique Lab", "price" => 6800, "image" => "https://images.unsplash.com/photo-1576995853123-5a10305d93c0?auto=format&fit=crop&w=600&q=80"],
    ["id" => 17, "name" => "High-Waisted Pleated Trousers", "category" => "modern", "brand" => "Studio Blanc", "price" => 5900, "image" => "https://images.unsplash.com/photo-1624378439575-d8705ad7ae80?auto=format&fit=crop&w=600&q=80"],
    ["id" => 18, "name" => "Premium Pima Cotton Core Tee", "category" => "modern", "brand" => "Aesthetique Lab", "price" => 2500, "image" => "https://images.unsplash.com/photo-1521572267360-ee0c2909d518?auto=format&fit=crop&w=600&q=80"],
    ["id" => 19, "name" => "Asymmetric Ribbed Knit Turtleneck", "category" => "modern", "brand" => "Nordic Vibe", "price" => 7200, "image" => "https://images.unsplash.com/photo-1512436991641-6745cdb1723f?auto=format&fit=crop&w=600&q=80"],
    ["id" => 20, "name" => "Urban Technical Cargo Pants", "category" => "modern", "brand" => "Aesthetique Lab", "price" => 6900, "image" => "https://images.unsplash.com/photo-1517423738875-5ce310acd3da?auto=format&fit=crop&w=600&q=80"],
    ["id" => 21, "name" => "Bohemian Midnight Floral Midi Skirt", "category" => "modern", "brand" => "Nordic Vibe", "price" => 4800, "image" => "https://images.unsplash.com/photo-1583496661160-fb5886a0aaaa?auto=format&fit=crop&w=600&q=80"],
    ["id" => 22, "name" => "Vegan Leather Asymmetric Moto Jacket", "category" => "modern", "brand" => "Studio Blanc", "price" => 14000, "image" => "https://images.unsplash.com/photo-1551028719-00167b16eac5?auto=format&fit=crop&w=600&q=80"],
];

$productsById = [];
foreach ($products as $p) {
    $productsById[(int)$p['id']] = $p;
}

$cart_items = [];
foreach ($_SESSION['cart'] as $pid => $qty) {
    $pid = (int)$pid;
    $qty = max(1, (int)$qty);
    if (!isset($productsById[$pid])) continue;

    $p = $productsById[$pid];
    $cart_items[] = [
        'id' => $pid,
        'name' => $p['name'],
        'category' => $p['category'],
        'brand' => $p['brand'],
        'price' => (int)$p['price'],
        'quantity' => $qty,
        'size' => 'M',
        'image' => $p['image'],
    ];
}

// Calculation Infrastructure
$subtotal = 0;
foreach ($cart_items as $item) {
    $subtotal += $item['price'] * $item['quantity'];
}

// Global Luxury Ticker Message
$free_shipping_threshold = 20000;
$shipping_cost = ($subtotal >= $free_shipping_threshold) ? 0 : 150;
$total_payable = $subtotal + $shipping_cost;

// Cart count for header badge (session-driven)
$cart_count = 0;
foreach ($_SESSION['cart'] as $item) {
    $cart_count += is_array($item) ? ($item['quantity'] ?? 1) : 1;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Atelier Cart | AESTHETIQUE</title>
    <!-- Tailwind CSS Engine CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Typography & Icons -->
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

    <!-- NAVIGATION PLATFORM HUB -->
    <header class="w-full py-6 px-4 sm:px-8 border-b border-neutral-200/60 bg-[#FAF9F6]/80 backdrop-blur-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <a href="index.php" class="serif-font text-xl tracking-[0.25em] uppercase font-semibold text-neutral-900">
                AESTHETIQUE
            </a>
            <a href="index.php" class="text-xs uppercase tracking-widest text-neutral-500 hover:text-black transition-colors duration-200 flex items-center space-x-2">
                <span>Continue Shopping</span>
                <i class="fa-solid fa-arrow-right-long text-[10px]"></i>
            </a>
        </div>
    </header>

    <!-- MAIN INTERACTIVE SECTION -->
    <main class="flex-grow max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16">
        
        <h1 class="serif-font text-3xl sm:text-4xl font-normal tracking-wide text-neutral-900 mb-10">
            Shopping Cart <span class="text-sm font-light text-neutral-400 italic"> (<?= count($cart_items) ?> Selections)</span>
        </h1>

        <?php if (empty($cart_items)): ?>
            <!-- EMPTY STATE DESIGN PARADIGM -->
            <div class="text-center py-24 border border-dashed border-neutral-200 bg-white">
                <i class="fa-solid fa-bag-shopping text-4xl text-neutral-200 mb-4"></i>
                <p class="serif-font italic text-lg text-neutral-500 mb-6">Your collection manifest is currently unpopulated.</p>
                <a href="index.php" class="inline-block bg-neutral-900 text-white px-8 py-3.5 text-xs tracking-widest uppercase font-medium hover:bg-neutral-800 transition-colors duration-200">
                    Discover Masterpieces
                </a>
            </div>
        <?php else: ?>
            
            <!-- SPLIT-ROW DESIGN FRAMEWORK -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
                
                <!-- LEFT SIDE: DIGITAL MANIFEST LIST -->
                <div class="lg:col-span-8 space-y-6">
                    
                    <!-- Free Delivery Progress Bar Indicator -->
                    <div class="bg-white border border-neutral-200/60 p-4 text-xs tracking-wide">
                        <?php if ($subtotal < $free_shipping_threshold): ?>
                            <p class="text-neutral-600 font-light flex items-center gap-2">
                                <i class="fa-solid fa-truck-fast text-neutral-400"></i>
                                Add <span class="font-medium text-black">Rs. <?= number_format($free_shipping_threshold - $subtotal) ?></span> more to unlock complimentary premium delivery.
                            </p>
                        <?php else: ?>
                            <p class="text-emerald-700 font-medium flex items-center gap-2">
                                <i class="fa-solid fa-circle-check text-emerald-600"></i>
                                Your selection qualifies for complimentary premium delivery across Nepal.
                            </p>
                        <?php endif; ?>
                    </div>

                    <!-- Cart Items Processing Node -->
                    <div class="bg-white border border-neutral-200/60 divide-y divide-neutral-100">
                        <?php foreach ($cart_items as $item): ?>
                            <article class="p-6 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6">
                                
                                <!-- Product Basic Footprint -->
                                <div class="flex items-center space-x-5 w-full sm:w-2/5">
                                    <div class="w-20 aspect-[3/4] bg-neutral-50 border border-neutral-100 flex-shrink-0 overflow-hidden">
                                        <img src="<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>" class="w-full h-full object-cover">
                                    </div>
                                    <div>
                                        <span class="text-[10px] uppercase text-neutral-400 tracking-wider font-medium block mb-0.5"><?= htmlspecialchars($item['brand']) ?></span>
                                        <h3 class="serif-font text-sm text-neutral-900 font-normal leading-snug hover:text-neutral-500 transition-colors"><a href="#"><?= htmlspecialchars($item['name']) ?></a></h3>
                                        <p class="text-[11px] text-neutral-500 font-light mt-1 flex items-center gap-2">
                                            <span>Size: <strong class="font-medium text-neutral-800"><?= $item['size'] ?></strong></span>
                                            <span class="text-neutral-300">|</span>
                                            <span class="capitalize"><?= $item['category'] === 'nepali' ? 'Cultural Wear' : 'Contemporary' ?></span>
                                        </p>
                                    </div>
                                </div>

                                <!-- Quantity Alteration Interface -->
                                <div class="flex items-center border border-neutral-200 bg-neutral-50/50">
                                    <button class="px-3 py-1.5 text-xs text-neutral-500 hover:text-black transition-colors focus:outline-none" aria-label="Decrease quantity">
                                        <i class="fa-solid fa-minus text-[9px]"></i>
                                    </button>
                                    <span class="px-3 text-xs font-medium text-neutral-800 w-8 text-center bg-white border-x border-neutral-200 py-1.5">
                                        <?= $item['quantity'] ?>
                                    </span>
                                    <button class="px-3 py-1.5 text-xs text-neutral-500 hover:text-black transition-colors focus:outline-none" aria-label="Increase quantity">
                                        <i class="fa-solid fa-plus text-[9px]"></i>
                                    </button>
                                </div>

                                <!-- Absolute Financial Outpost -->
                                <div class="flex sm:flex-col items-baseline sm:items-end justify-between sm:justify-center w-full sm:w-auto pt-4 sm:pt-0 border-t sm:border-t-0 border-neutral-100">
                                    <span class="text-xs sm:hidden uppercase tracking-widest text-neutral-400">Total</span>
                                    <div class="text-right">
                                        <span class="text-sm font-semibold text-neutral-900 block">Rs. <?= number_format($item['price'] * $item['quantity']) ?></span>
                                        <?php if($item['quantity'] > 1): ?>
                                            <span class="text-[10px] text-neutral-400 block font-light">Rs. <?= number_format($item['price']) ?> each</span>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <!-- Structural Eviction Trigger -->
                                <button class="text-neutral-300 hover:text-red-700 text-xs transition-colors self-start sm:self-center absolute sm:relative top-6 right-6 sm:top-auto sm:right-auto" aria-label="Remove item">
                                    <i class="fa-regular fa-trash-can text-sm"></i>
                                </button>

                            </article>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- RIGHT SIDE: LEDGER SUMMARY COMPONENT -->
                <div class="lg:col-span-4 space-y-6 lg:sticky lg:top-28">
                    
                    <div class="bg-white border border-neutral-200/60 p-6 sm:p-8 shadow-xs">
                        <h2 class="serif-font text-lg text-neutral-900 tracking-wide mb-6 pb-2 border-b border-neutral-100">
                            Order Overview
                        </h2>

                        <!-- Financial Ledger Architecture -->
                        <div class="space-y-4 text-xs font-light">
                            <div class="flex justify-between text-neutral-500">
                                <span>Subtotal Value</span>
                                <span class="font-medium text-neutral-900">Rs. <?= number_format($subtotal) ?></span>
                            </div>
                            
                            <div class="flex justify-between text-neutral-500">
                                <span>Curated Courier Distribution</span>
                                <span class="font-medium text-neutral-900">
                                    <?= ($shipping_cost === 0) ? 'Complimentary' : 'Rs. ' . number_format($shipping_cost) ?>
                                </span>
                            </div>

                            <div class="h-[1px] bg-neutral-200 my-4"></div>

                            <div class="flex justify-between text-sm text-neutral-900 font-medium">
                                <span class="serif-font tracking-wide">Total Estimated Capital</span>
                                <span class="text-base">Rs. <?= number_format($total_payable) ?></span>
                            </div>
                        </div>

                        <!-- Forward Checkout Trajectory -->
                        <a href="checkout.php" class="block w-full text-center bg-neutral-900 text-white mt-8 py-4 text-xs tracking-widest uppercase font-medium hover:bg-neutral-800 transition-colors duration-200 shadow-sm">
                            Proceed to Checkout Manifest
                        </a>

                        <div class="mt-4 flex items-center justify-center gap-2 text-[10px] uppercase text-neutral-400 tracking-wider">
                            <i class="fa-solid fa-shield-halved text-neutral-500"></i> Value Added Protection Guarantee
                        </div>
                    </div>

                    <!-- PROMOTIONAL VOUCHER PORTAL -->
                    <div class="bg-white border border-neutral-200/60 p-6">
                        <label for="promo" class="block text-[11px] uppercase tracking-widest text-neutral-500 font-medium mb-2">Promotional Access Code</label>
                        <form class="flex gap-2" onclick="event.preventDefault();">
                            <input type="text" id="promo" placeholder="ATELIER-FALL26" class="w-full bg-neutral-50 border border-neutral-200 px-3 py-2 text-xs focus:outline-none focus:border-neutral-900 transition-colors uppercase font-mono">
                            <button class="bg-neutral-900 text-white px-4 text-xs uppercase font-medium tracking-wider hover:bg-neutral-800 transition-colors">Apply</button>
                        </form>
                    </div>

                </div>

            </div>
        <?php endif; ?>
    </main>

    <!-- COMPLIANCE SIGNATURE LAYER FOOTER -->
    <footer class="w-full py-6 px-4 border-t border-neutral-200/40 text-center text-neutral-400 text-[11px] font-light tracking-wider bg-white">
        <p>&copy; <?= date('Y'); ?> AESTHETIQUE Atelier. Protected via Layered Cryptography Protocols.</p>
    </footer>

</body>
</html>