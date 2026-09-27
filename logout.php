<?php
// Initialize the active session lifecycle
session_start();

// 01. Clear all session memory variables
$_SESSION = array();

// 02. Obliterate the session cookie completely from the user's browser storage
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(), 
        '', 
        time() - 42000,
        $params["path"], 
        $params["domain"],
        $params["secure"], 
        $params["httponly"]
    );
}

// 03. Destruct the server-side session registry
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Automated architectural redirect to the main collection after 2 seconds -->
    <meta http-equiv="refresh" content="2;url=index.php">
    <title>Secure Disconnection | AESTHETIQUE</title>
    <!-- Tailwind CSS Engine CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Typography Engine & Icon Registers -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500&family=Playfair+Display:ital,wght@0,400;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body { font-family: 'Inter', sans-serif; background-color: #FAF9F6; }
        .serif-font { font-family: 'Playfair Display', serif; }
    </style>
</head>
<body class="text-neutral-800 antialiased min-h-screen flex flex-col justify-between">

    <!-- MINIMAL HEADER SHIELD -->
    <header class="w-full py-6 px-4 sm:px-8 border-b border-neutral-200/40 bg-[#FAF9F6]/80 backdrop-blur-md">
        <div class="max-w-7xl mx-auto text-center">
            <span class="serif-font text-xl tracking-[0.25em] uppercase font-semibold text-neutral-900">
                AESTHETIQUE
            </span>
        </div>
    </header>

    <!-- VISUAL DISCONNECTION NODE -->
    <main class="flex-grow flex items-center justify-center px-4">
        <div class="w-full max-w-sm text-center space-y-6">
            
            <!-- Animated Subtle Pulse Ring -->
            <div class="relative w-12 h-12 mx-auto flex items-center justify-center text-neutral-400">
                <i class="fa-solid fa-arrow-right-from-bracket text-lg animate-pulse"></i>
            </div>

            <!-- Disconnection Manifest Text -->
            <div class="space-y-2">
                <h1 class="serif-font text-2xl font-normal text-neutral-900 tracking-wide">Securely Signed Out</h1>
                <p class="text-neutral-400 text-xs font-light tracking-wide leading-relaxed">
                    Your luxury session parameters have been safely purged from our active archive.
                </p>
            </div>

            <!-- Dynamic UI Visual Loader Bar -->
            <div class="w-24 h-[1px] bg-neutral-200 mx-auto overflow-hidden relative">
                <div class="absolute inset-y-0 left-0 bg-neutral-900 w-1/2 animate-[minus_2s_ease-in-out_infinite] rounded-full" style="animation: loading-bar 1.8s infinite ease-in-out;"></div>
            </div>

            <p class="text-[10px] uppercase tracking-widest text-neutral-400 font-medium">
                Returning to the Main Atelier shortly
            </p>

            <!-- Manual Bypass Link -->
            <div>
                <a href="index.php" class="text-xs font-medium text-neutral-900 underline underline-offset-4 hover:text-neutral-500 transition-colors">
                    Click here to bypass wait
                </a>
            </div>

        </div>
    </main>

    <!-- SECURE PROTOCOL SIGNATURE FOOTER -->
    <footer class="w-full py-6 px-4 border-t border-neutral-200/40 text-center text-neutral-400 text-[11px] font-light tracking-wider bg-white">
        <p>&copy; <?= date('Y'); ?> AESTHETIQUE Atelier. Session Terminated In Line With Cryptographic Principles.</p>
    </footer>

    <!-- Custom Micro-Animation Script Stylesheet for Loader -->
    <style>
        @keyframes loading-bar {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(200%); }
        }
    </style>

</body>
</html>