<?php
session_start();
include("includes/db.php");

$page_title = "Profile";

if(!isset($_SESSION['user_id'])){

    header("Location: login.php");
    exit();
}

// Secure casting to guarantee numeric safety
$user_id = (int)$_SESSION['user_id'];

$result = mysqli_query($conn, "
    SELECT *
    FROM users
    WHERE id='$user_id'
");

$user = mysqli_fetch_assoc($result);

if(!$user){
    die("User context not found in database records.");
}

// Generate structural avatar initials from client name string
$name_parts = explode(' ', trim($user['fullname']));
$initials = strtoupper(substr($name_parts[0], 0, 1) . (isset($name_parts[1]) ? substr($name_parts[1], 0, 1) : ''));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Ledger | AESTHETIQUE</title>
    <!-- Tailwind CSS Engine -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Premium Google Font Vaults -->
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

    <!-- PLATFORM NAVIGATION ANCHOR -->
    <?php include("includes/navbar.php"); ?>

    <!-- MAIN INTERFACE CONTAINER -->
    <main class="flex-grow max-w-3xl w-full mx-auto px-4 sm:px-6 py-16">
        
        <!-- Section Header -->
        <div class="text-center mb-12 space-y-2">
            <span class="text-[10px] uppercase tracking-[0.35em] text-neutral-400 font-semibold block">Account Overview</span>
            <h1 class="serif-font text-3xl font-normal tracking-wide text-neutral-900">Client Profile</h1>
        </div>

        <!-- PROFILE ARCHITECTURE CARD -->
        <div class="bg-white border border-neutral-200/60 p-6 sm:p-10 shadow-2xs space-y-8">
            
            <!-- User Avatar & Identity Cluster -->
            <div class="flex flex-col sm:flex-row items-center space-y-4 sm:space-y-0 sm:space-x-6 pb-6 border-b border-neutral-100">
                <div class="w-16 h-16 bg-neutral-900 text-white rounded-full flex items-center justify-center font-mono text-lg font-light tracking-wider">
                    <?= $initials ?: '<i class="fa-regular fa-user text-sm"></i>' ?>
                </div>
                <div class="text-center sm:text-left">
                    <h2 class="serif-font text-xl text-neutral-900 font-medium">
                        <?= htmlspecialchars($user['fullname']) ?>
                    </h2>
                    <p class="text-[11px] uppercase tracking-widest text-neutral-400 font-medium mt-0.5">
                        Verified Patron Ledger
                    </p>
                </div>
            </div>

            <!-- Structured Metadata List -->
            <div class="space-y-4">
                
                <!-- Full Name Data Field -->
                <div class="grid grid-cols-3 py-3 border-b border-neutral-100 items-center">
                    <span class="text-[11px] uppercase tracking-wider font-semibold text-neutral-400">Full Name</span>
                    <span class="text-xs font-medium text-neutral-800 col-span-2">
                        <?= htmlspecialchars($user['fullname']) ?>
                    </span>
                </div>

                <!-- Email Data Field -->
                <div class="grid grid-cols-3 py-3 border-b border-neutral-100 items-center">
                    <span class="text-[11px] uppercase tracking-wider font-semibold text-neutral-400">Email Address</span>
                    <span class="text-xs font-medium text-neutral-800 col-span-2 break-all">
                        <?= htmlspecialchars($user['email']) ?>
                    </span>
                </div>

                <!-- Phone Data Field -->
                <div class="grid grid-cols-3 py-3 border-b border-neutral-100 items-center">
                    <span class="text-[11px] uppercase tracking-wider font-semibold text-neutral-400">Phone Network</span>
                    <span class="text-xs font-mono text-neutral-800 col-span-2">
                        <?= !empty($user['phone']) ? htmlspecialchars($user['phone']) : '<span class="italic text-neutral-300">Unspecified</span>' ?>
                    </span>
                </div>

            </div>

            <!-- DYNAMIC INTERACTION ROUTING ROUTER -->
            <div class="pt-6 flex flex-col sm:flex-row gap-3 pt-4">
                <a href="my_orders.php" class="flex-1 text-center bg-neutral-900 text-white text-xs uppercase tracking-widest py-3 font-medium transition-colors hover:bg-neutral-800 rounded-none">
                    <i class="fa-solid fa-receipt mr-2 text-[10px]"></i> My Purchase History
                </a>
                <a href="shop.php" class="flex-1 text-center bg-white border border-neutral-200 text-neutral-600 text-xs uppercase tracking-widest py-3 font-medium transition-colors hover:border-neutral-400 hover:text-black rounded-none">
                    Discover Collection
                </a>
            </div>

        </div>

    </main>

    <!-- SECURE FOOTER RUNTIME SIGNATURE -->
    <footer class="w-full py-6 px-4 border-t border-neutral-200/40 text-center text-neutral-400 text-[10px] font-light tracking-wider bg-white">
        <p>&copy; 2026 AESTHETIQUE Atelier. Account parameters structured under verified data safety configurations.</p>
    </footer>
<script src="js/script.js"></script>
</body>
</html>