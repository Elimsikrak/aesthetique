<?php
session_start();

// Build cart items from session cart (keep structure; remove mock items)
if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

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

// Financial Computations (mirror cart.php)
$subtotal = 0;
foreach ($cart_items as $item) {
    $subtotal += $item['price'] * $item['quantity'];
}
$free_shipping_threshold = 20000;
$delivery_fee = ($subtotal >= $free_shipping_threshold) ? 0 : 150;
$total_payable = $subtotal + $delivery_fee;

$success_order = false;
$error_message = "";
$prefill_fullname = '';
$prefill_phone = '';
$prefill_address = '';
$prefill_city = '';
$prefill_postal = '';

// Pre-fill from $_SESSION['user_profile'] if available
if (!empty($_SESSION['user_profile']) && is_array($_SESSION['user_profile'])) {
    $prefill_fullname = isset($_SESSION['user_profile']['fullname']) ? (string)$_SESSION['user_profile']['fullname'] : $prefill_fullname;
    $prefill_phone = isset($_SESSION['user_profile']['phone']) ? (string)$_SESSION['user_profile']['phone'] : $prefill_phone;
    $prefill_address = isset($_SESSION['user_profile']['address']) ? (string)$_SESSION['user_profile']['address'] : $prefill_address;
    $prefill_city = isset($_SESSION['user_profile']['city']) ? (string)$_SESSION['user_profile']['city'] : $prefill_city;
    $prefill_postal = isset($_SESSION['user_profile']['postal_code']) ? (string)$_SESSION['user_profile']['postal_code'] : $prefill_postal;
}

if (!empty($_SESSION['customer_prefill']) && is_array($_SESSION['customer_prefill'])) {
    $prefill_fullname = isset($_SESSION['customer_prefill']['fullname']) ? (string)$_SESSION['customer_prefill']['fullname'] : '';
    $prefill_phone = isset($_SESSION['customer_prefill']['phone']) ? (string)$_SESSION['customer_prefill']['phone'] : '';
}


// Form Post Matrix Processor
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = filter_var(trim($_POST['fullname']), FILTER_SANITIZE_SPECIAL_CHARS);
    $phone = filter_var(trim($_POST['phone']), FILTER_SANITIZE_SPECIAL_CHARS);
    $address = filter_var(trim($_POST['address']), FILTER_SANITIZE_SPECIAL_CHARS);
    $city = filter_var(trim($_POST['city']), FILTER_SANITIZE_SPECIAL_CHARS);
    $payment_method = filter_var(trim($_POST['payment_method']), FILTER_SANITIZE_SPECIAL_CHARS);

    if (empty($fullname) || empty($phone) || empty($address) || empty($city) || empty($payment_method)) {
        $error_message = "All critical delivery registers must be populated.";
    } else {
        /*
          PRODUCTION DB INGESTION HOOK:
          --------------------------------------------------
          Insert into orders, order_items table arrays.
          Reduce stock count configurations.
        */
        $success_order = true;

        // Update prefill + clear cart after successful order
        $_SESSION['customer_prefill'] = [
            'user_id' => $_SESSION['customer_prefill']['user_id'] ?? null,
            'fullname' => $fullname,
            'phone' => $phone,
            'email' => $_SESSION['customer_prefill']['email'] ?? null,
        ];

        unset($_SESSION['cart']);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secure Checkout | AESTHETIQUE</title>
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

    <!-- NAVIGATION ANCHOR BAR -->
    <header class="w-full py-6 px-4 sm:px-8 border-b border-neutral-200/40 bg-[#FAF9F6]/80 backdrop-blur-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <a href="index.php" class="serif-font text-xl tracking-[0.25em] uppercase font-semibold text-neutral-900">
                AESTHETIQUE
            </a>
            <span class="text-[10px] uppercase tracking-[0.2em] text-neutral-400 flex items-center gap-2">
                <i class="fa-solid fa-lock text-neutral-600"></i> Encrypted Transaction Engine
            </span>
        </div>
    </header>

    <!-- SYSTEM CORE CONTENT FRAME -->
    <main class="flex-grow max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-12">
        
        <?php if ($success_order): ?>
            <!-- ORDER TRIUMPH COMPONENT -->
            <div class="max-w-xl mx-auto text-center py-16 px-6 bg-white border border-neutral-200/60 shadow-xs">
                <div class="w-16 h-16 bg-neutral-900 text-[#FAF9F6] rounded-full flex items-center justify-center mx-auto mb-6 text-xl">
                    <i class="fa-solid fa-check"></i>
                </div>
                <h2 class="serif-font text-3xl font-normal text-neutral-900 mb-3">Order Registered Successfully</h2>
                <p class="text-neutral-500 text-xs tracking-wide uppercase mb-6">Manifest ID: #AE-<?= rand(10000, 99999) ?></p>
                <p class="text-neutral-600 text-sm font-light leading-relaxed mb-8 max-w-md mx-auto">
                    Thank you for your patronage, <?= htmlspecialchars($fullname) ?>. An aesthetic design representative will contact you at <span class="font-medium text-black"><?= htmlspecialchars($phone) ?></span> shortly to finalize dispatch routes.
                </p>
                <a href="index.php" class="inline-block bg-neutral-900 text-white px-8 py-3.5 text-xs tracking-widest uppercase font-medium hover:bg-neutral-800 transition-colors duration-200">
                    Continue Curating Wear
                </a>
            </div>
        <?php else: ?>

            <!-- DUAL ROW CHECKOUT MATRIX -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
                
                <!-- LEFT PANEL: REGISTRATION & MANIFEST FORMS -->
                <div class="lg:col-span-7 space-y-8">
                    
                    <?php if (!empty($error_message)): ?>
                        <div class="p-4 bg-red-50/60 border border-red-200 text-red-800 text-xs font-light flex items-center space-x-2">
                            <i class="fa-solid fa-circle-exclamation"></i>
                            <span><?= $error_message ?></span>
                        </div>
                    <?php endif; ?>

                    <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="space-y-8">
                        
                        <!-- Shipping Information Block -->
                        <div>
                            <h2 class="serif-font text-xl text-neutral-900 tracking-wide pb-3 border-b border-neutral-200 mb-6">
                                01. Shipping Details
                            </h2>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div class="sm:col-span-2">
                                    <label class="block text-[11px] uppercase tracking-widest text-neutral-500 font-medium mb-2">Recipient Legal Name</label>
                                    <input type="text" name="fullname" required placeholder="e.g., Aarav Sharma" value="<?= htmlspecialchars($prefill_fullname) ?>" class="w-full bg-white border border-neutral-200 px-4 py-3 text-xs focus:outline-none focus:border-neutral-900 transition-colors duration-150">
                                </div>
                                <div>
                                    <label class="block text-[11px] uppercase tracking-widest text-neutral-500 font-medium mb-2">Mobile Contact Number</label>
                                    <input type="tel" name="phone" required placeholder="e.g., 98XXXXXXXX" value="<?= htmlspecialchars($prefill_phone) ?>" class="w-full bg-white border border-neutral-200 px-4 py-3 text-xs focus:outline-none focus:border-neutral-900 transition-colors duration-150">
                                </div>
                                <div>
                                    <label class="block text-[11px] uppercase tracking-widest text-neutral-500 font-medium mb-2">City / Location Hub</label>
                                    <select name="city" required class="w-full bg-white border border-neutral-200 px-4 py-3 text-xs focus:outline-none focus:border-neutral-900 transition-colors duration-150 rounded-none">
                                        <option value="">Select Destination Hub</option>
                                        <option value="Kathmandu">Kathmandu Valley</option>
                                        <option value="Lalitpur">Lalitpur Metro</option>
                                        <option value="Bhaktapur">Bhaktapur Metro</option>
                                        <option value="Pokhara">Pokhara Core</option>
                                        <option value="Butwal">Butwal Junction</option>
                                        <option value="Dharan">Dharan Hub</option>
                                        <option value="Biratnagar">Ramechhap Hub</option>
                                    </select>
                                </div>
                                <div class="sm:col-span-2">
                                    <label class="block text-[11px] uppercase tracking-widest text-neutral-500 font-medium mb-2">Street Address Architecture</label>
                                    <input type="text" name="address" required placeholder="e.g., House 42, Ward 3, Jhamsikhel" class="w-full bg-white border border-neutral-200 px-4 py-3 text-xs focus:outline-none focus:border-neutral-900 transition-colors duration-150">
                                </div>
                            </div>
                        </div>

                        <!-- Payment Settlement Gateways Block -->
                        <div>
                            <h2 class="serif-font text-xl text-neutral-900 tracking-wide pb-3 border-b border-neutral-200 mb-6">
                                02. Settlement Gateway
                            </h2>
                            <div class="space-y-3">
                                <label class="border border-neutral-200 hover:border-neutral-400 p-4 flex items-center justify-between cursor-pointer transition-colors duration-150 bg-white">
                                    <div class="flex items-center space-x-3">
                                        <input type="radio" name="payment_method" value="COD" checked class="h-3.5 w-3.5 accent-neutral-900">
                                        <div>
                                            <span class="text-xs font-medium block">Cash on Delivery (COD)</span>
                                            <span class="text-[11px] text-neutral-400 font-light">Settle via paper currency or mobile scan upon product handoff.</span>
                                        </div>
                                    </div>
                                    <i class="fa-solid fa-money-bill-wave text-neutral-400 text-lg"></i>
                                </label>

                                <label class="border border-neutral-200 hover:border-neutral-400 p-4 flex items-center justify-between cursor-pointer transition-colors duration-150 bg-white">
                                    <div class="flex items-center space-x-3">
                                        <input type="radio" name="payment_method" value="eSewa" class="h-3.5 w-3.5 accent-neutral-900">
                                        <div>
                                            <span class="text-xs font-medium block">Digital Wallet (eSewa / Khalti)</span>
                                            <span class="text-[11px] text-neutral-400 font-light">Instant dynamic redirection protocol for mobile walling settlements.</span>
                                        </div>
                                    </div>
                                    <i class="fa-solid fa-wallet text-neutral-400 text-lg"></i>
                                </label>

                                <label class="border border-neutral-200 hover:border-neutral-400 p-4 flex items-center justify-between cursor-pointer transition-colors duration-150 bg-white">
                                    <div class="flex items-center space-x-3">
                                        <input type="radio" name="payment_method" value="Bank" class="h-3.5 w-3.5 accent-neutral-900">
                                        <div>
                                            <span class="text-xs font-medium block">Direct Corporate Bank Transfer</span>
                                            <span class="text-[11px] text-neutral-400 font-light">Requires verification receipt upload to processing staff channels.</span>
                                        </div>
                                    </div>
                                    <i class="fa-solid fa-building-columns text-neutral-400 text-lg"></i>
                                </label>
                            </div>
                        </div>

                        <!-- Executable Submission Trigger -->
                        <button type="submit" class="w-full bg-neutral-900 text-white py-4 text-xs tracking-widest uppercase font-medium hover:bg-neutral-800 transition-colors duration-200 shadow-sm">
                            Authorize & Complete Manifest Order
                        </button>
                    </form>
                </div>

                <!-- RIGHT PANEL: STICKY ATELIER MANIFEST SUMMARY -->
                <div class="lg:col-span-5 bg-white border border-neutral-200/60 p-6 sm:p-8 sticky top-28 shadow-xs">
                    <h3 class="serif-font text-lg text-neutral-900 tracking-wide mb-6 pb-2 border-b border-neutral-100">
                        Atelier Manifest
                    </h3>
                    
                    <!-- Mapping Cart Matrix -->
                    <div class="divide-y divide-neutral-100 max-h-64 overflow-y-auto mb-6 pr-2">
                        <?php foreach ($cart_items as $item): ?>
                            <div class="py-4 flex space-x-4 first:pt-0 last:pb-0">
                                <div class="w-16 aspect-[3/4] bg-neutral-100 flex-shrink-0 overflow-hidden">
                                    <img src="<?= htmlspecialchars($item['image']) ?>" alt="" class="w-full h-full object-cover">
                                </div>
                                <div class="flex-grow flex flex-col justify-between">
                                    <div>
                                        <span class="text-[10px] uppercase text-neutral-400 tracking-wider block font-medium"><?= htmlspecialchars($item['brand']) ?></span>
                                        <h4 class="text-xs text-neutral-800 font-medium line-clamp-1 mt-0.5"><?= htmlspecialchars($item['name']) ?></h4>
                                    </div>
                                    <div class="flex justify-between items-center text-xs">
                                        <span class="text-neutral-400 font-light">Qty: <?= $item['quantity'] ?></span>
                                        <span class="font-medium text-neutral-900">Rs. <?= number_format($item['price']) ?></span>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Financial Ledger Ticker -->
                    <div class="space-y-3 pt-4 border-t border-neutral-100 text-xs font-light">
                        <div class="flex justify-between text-neutral-500">
                            <span>Cart Subtotal</span>
                            <span>Rs. <?= number_format($subtotal) ?></span>
                        </div>
                        <div class="flex justify-between text-neutral-500">
                            <span>Premium Curated Delivery</span>
                            <span>Rs. <?= number_format($delivery_fee) ?></span>
                        </div>
                        <div class="h-[1px] bg-neutral-200 my-2"></div>
                        <div class="flex justify-between text-sm text-neutral-900 font-medium">
                            <span class="serif-font tracking-wide">Total Order Cost</span>
                            <span>Rs. <?= number_format($total_payable) ?></span>
                        </div>
                    </div>
                </div>

            </div>
        <?php endif; ?>
    </main>

    <!-- SYSTEM FOOTER LEGAL SIGNATURE -->
    <footer class="w-full py-6 px-4 border-t border-neutral-200/40 text-center text-neutral-400 text-[11px] font-light tracking-wider bg-white">
        <p>&copy; <?= date('Y'); ?> AESTHETIQUE Atelier. Protected via Layered Cryptography Protocols.</p>
    </footer>

</body>
</html>