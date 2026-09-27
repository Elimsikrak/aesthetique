<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Compute aggregate cart item quantities for display metrics
$cart_count = 0;
if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        // Handle array configurations or scalar integer tallies smoothly
        $cart_count += is_array($item) ? ($item['quantity'] ?? 1) : 1;
    }
}
?>
<header class="w-full py-5 px-4 sm:px-8 border-b border-neutral-200/60 bg-[#FAF9F6]/80 backdrop-blur-md sticky top-0 z-50">
    <div class="max-w-7xl mx-auto flex justify-between items-center">
        
        <!-- Brand Identity Core Anchor -->
        <a href="shop.php" class="serif-font text-xl tracking-[0.25em] uppercase font-semibold text-neutral-900 transition-opacity hover:opacity-80">
            AESTHETIQUE
        </a>


        <!-- Middle Curation Navigation links -->
        <nav class="hidden md:flex items-center space-x-8 text-[10px] uppercase tracking-widest font-medium text-neutral-500">
            <a href="shop.php" class="relative nav-link hover:text-black transition-colors">Collections</a>
            <a href="product.php?category=Heritage" class="relative nav-link hover:text-black transition-colors">Heritage</a>
            <a href="product.php?category=Modern" class="relative nav-link hover:text-black transition-colors">Modern Streetwear</a>
        </nav>

        <!-- Dynamic User Interface Actions Ledger -->
        <div class="flex items-center space-x-6 text-[10px] uppercase tracking-widest font-medium text-neutral-500">
            
            <?php if (isset($_SESSION['user_id'])): ?>
                <!-- Client Access Options Matrix when Authenticated -->
                <a href="profile.php" class="hover:text-black transition-colors hidden sm:inline-flex items-center gap-1.5">
                    <i class="fa-regular fa-user text-xs"></i> Ledger
                </a>
                <a href="my_orders.php" class="hover:text-black transition-colors">Orders</a>
                <a href="logout.php" class="text-[#8b1d1d]/80 hover:text-[#8b1d1d] transition-colors">Exit</a>
            <?php else: ?>
                <!-- Unauthenticated Entry Parameters -->
                <a href="login.php" class="hover:text-black transition-colors">Sign In</a>
                <a href="register.php" class="hover:text-black transition-colors hidden sm:inline">Register</a>
            <?php endif; ?>

            <?php if (isset($_SESSION['is_admin']) && (int)$_SESSION['is_admin'] === 1): ?>
                <!-- Admin-only controls: show Ledger as people/people sticker -->
                <a href="admin/dashboard.php" class="hover:text-black transition-colors"> <i class="fa-solid fa-user-shield"></i> Admin</a>
            <?php endif; ?>

            <!-- Interactive Shopping Bag Component Counter -->
            <a href="cart.php" class="relative text-neutral-900 hover:text-neutral-600 transition-colors pt-0.5">
                <i class="fa-solid fa-bag-shopping text-[13px]"></i>
                <?php if ($cart_count > 0): ?>
                    <span class="absolute -top-1.5 -right-2 bg-neutral-900 text-white font-mono text-[8px] w-3.5 h-3.5 rounded-full flex items-center justify-center font-bold">
                        <?= $cart_count ?>
                    </span>
                <?php endif; ?>
            </a>
        </div>
    </div>
</header>