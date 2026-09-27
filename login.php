<?php
// Start secure session management
session_start();

// Redirect user if they are already authenticated
if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

$error_message = "";

// Handle authentication request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize user inputs
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $password = trim($_POST['password']);

    if (empty($email) || empty($password)) {
        $error_message = "Please fill in all architectural credentials.";
    } else {
        /* 
           PRODUCTION DATABASE INTEGRATION POINT:
           --------------------------------------------------
           $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?');
           $stmt->execute([$email]);
           $user = $stmt->fetch();
           if ($user && password_verify($password, $user['password_hash'])) { ... }
        */

        // Professional Mock Authentication for immediate testing
        if ($email === "client@aesthetique.com" && $password === "luxury2026") {
            // Regenerate session ID for security (prevents session fixation)
            session_regenerate_id(true);
            
            $_SESSION['user_id'] = 1;
            $_SESSION['user_name'] = "Valued Client";
            
            header("Location: index.php");
            exit;
        } else {
            $error_message = "The credentials provided do not align with our archive.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Authentication | AESTHETIQUE</title>
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

    <!-- MINIMALIST UTILITY HEADER -->
    <header class="w-full py-6 px-4 sm:px-8 border-b border-neutral-200/40 bg-[#FAF9F6]/80 backdrop-blur-md">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <a href="index.php" class="serif-font text-xl tracking-[0.25em] uppercase font-semibold text-neutral-900">
                AESTHETIQUE
            </a>
            <a href="index.php" class="text-xs uppercase tracking-widest text-neutral-500 hover:text-black transition-colors duration-200 flex items-center space-x-2">
                <i class="fa-solid fa-arrow-left text-[10px]"></i>
                <span>Return to Atelier</span>
            </a>
        </div>
    </header>

    <!-- CENTERED LUXURY LOGIN BLOCK -->
    <main class="flex-grow flex items-center justify-center px-4 py-12">
        <div class="w-full max-w-md bg-white border border-neutral-200/60 p-8 sm:p-10 shadow-sm transition-all duration-300 hover:shadow-md">
            
            <!-- Context Header -->
            <div class="text-center mb-8">
                <h1 class="serif-font text-3xl font-normal tracking-wide text-neutral-900 mb-2">Welcome Back</h1>
                <p class="text-neutral-400 text-xs font-light tracking-wide uppercase">Access your private curated account</p>
            </div>

            <!-- Error Notification Alert Box -->
            <?php if (!empty($error_message)): ?>
                <div class="mb-6 p-4 bg-red-50/60 border border-red-200/80 text-red-800 text-xs font-light tracking-wide flex items-center space-x-3 rounded-none">
                    <i class="fa-solid fa-circle-exclamation text-sm text-red-600"></i>
                    <span><?= htmlspecialchars($error_message) ?></span>
                </div>
            <?php endif; ?>

            <!-- Interactive Authentication Form -->
            <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="space-y-6">
                
                <!-- Email Address Input Field -->
                <div>
                    <label for="email" class="block text-[11px] uppercase tracking-widest text-neutral-500 font-medium mb-2">Email Address</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-neutral-400">
                            <i class="fa-regular fa-envelope text-sm"></i>
                        </span>
                        <input 
                            type="email" 
                            name="email" 
                            id="email" 
                            required 
                            placeholder="name@example.com" 
                            value="<?= isset($email) ? htmlspecialchars($email) : '' ?>"
                            class="w-full bg-neutral-50/50 border border-neutral-200 pl-10 pr-4 py-3 text-xs tracking-wide text-neutral-900 placeholder-neutral-400 focus:outline-none focus:bg-white focus:border-neutral-900 transition-all duration-200 rounded-none"
                        >
                    </div>
                </div>

                <!-- Password Input Field -->
                <div>
                    <div class="flex justify-between items-center mb-2">
                        <label for="password" class="text-[11px] uppercase tracking-widest text-neutral-500 font-medium">Password</label>
                        <a href="#" class="text-[11px] text-neutral-400 hover:text-neutral-900 tracking-wide transition-colors duration-200">Forgot Password?</a>
                    </div>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-neutral-400">
                            <i class="fa-solid fa-lock text-sm"></i>
                        </span>
                        <input 
                            type="password" 
                            name="password" 
                            id="password" 
                            required 
                            placeholder="••••••••••••"
                            class="w-full bg-neutral-50/50 border border-neutral-200 pl-10 pr-4 py-3 text-xs tracking-wide text-neutral-900 placeholder-neutral-400 focus:outline-none focus:bg-white focus:border-neutral-900 transition-all duration-200 rounded-none"
                        >
                    </div>
                </div>

                <!-- Remember Session Checkbox State -->
                <div class="flex items-center">
                    <input 
                        type="checkbox" 
                        id="remember" 
                        name="remember"
                        class="h-3.5 w-3.5 text-neutral-900 focus:ring-neutral-900 border-neutral-300 rounded-none accent-neutral-900 cursor-pointer"
                    >
                    <label for="remember" class="ml-2 block text-xs font-light text-neutral-500 tracking-wide select-none cursor-pointer">
                        Remember this interface device
                    </label>
                </div>

                <!-- Action Button Matrix -->
                <button 
                    type="submit" 
                    class="w-full bg-neutral-900 text-white py-3.5 text-xs tracking-widest uppercase font-medium hover:bg-neutral-800 active:bg-black transition-colors duration-200 shadow-xs focus:outline-none"
                >
                    Authenticate Account
                </button>
            </form>

            <!-- Registration Call-to-Action Segment -->
            <div class="mt-8 pt-6 border-t border-neutral-100 text-center">
                <p class="text-xs text-neutral-400 font-light tracking-wide">
                    New to the House of Aesthetique? 
                    <a href="#" class="text-neutral-900 font-medium hover:underline underline-offset-4 ml-1">Create Account</a>
                </p>
            </div>

            <!-- Testing Directives Badge -->
            <div class="mt-6 p-3 bg-neutral-50 border border-neutral-200/40 rounded-none text-left">
                <p class="text-[10px] uppercase text-neutral-400 tracking-widest font-semibold mb-1"><i class="fa-solid fa-circle-info mr-1"></i> Demo Credentials</p>
                <p class="text-[11px] text-neutral-500 font-light">Email: <span class="font-mono text-neutral-800 select-all">client@aesthetique.com</span></p>
                <p class="text-[11px] text-neutral-500 font-light">Password: <span class="font-mono text-neutral-800 select-all">luxury2026</span></p>
            </div>

        </div>
    </main>

    <!-- SECURE COMPLIANCE FOOTER SIGNATURE -->
    <footer class="w-full py-6 px-4 border-t border-neutral-200/40 text-center text-neutral-400 text-[11px] font-light tracking-wider">
        <p>&copy; <?= date('Y'); ?> AESTHETIQUE Atelier. Protected via Layered Cryptography Protocols.</p>
    </footer>
<script src="js/script.js"></script>
</body>
</html>