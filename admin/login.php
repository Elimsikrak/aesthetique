<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include("includes/db.php");

/** @var mysqli $conn */
global $conn;

$message = "";
$message_type = "";

if (isset($_POST['login'])) {
    $email    = mysqli_real_escape_string($conn, trim($_POST['email']));
    $password = $_POST['password'];

    $result = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");

    if ($result && mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);
        
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id']       = $user['id'];
            $_SESSION['user_email']    = $user['email'];
            $_SESSION['user_fullname'] = $user['fullname'];
            $_SESSION['is_admin']      = $user['is_admin'] ?? 0; // Standard fallback check if column is mapped

            header("Location: shop.php");
            exit();
        } else {
            $message = "Invalid identity credentials specified.";
            $message_type = "error";
        }
    } else {
        $message = "No matching registry found for this client identity.";
        $message_type = "error";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Identity Authentication | AESTHETIQUE</title>
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

    <header class="w-full py-6 px-4 border-b border-neutral-200/60 bg-[#FAF9F6]/80 backdrop-blur-md">
        <div class="max-w-7xl mx-auto flex justify-center">
            <a href="shop.php" class="serif-font text-xl tracking-[0.25em] uppercase font-semibold text-neutral-900">AESTHETIQUE</a>
        </div>
    </header>

    <main class="flex-grow flex items-center justify-center px-4 py-16">
        <div class="max-w-md w-full bg-white border border-neutral-200/60 p-8 sm:p-10 shadow-2xs space-y-6">
            <div class="text-center space-y-1.5">
                <span class="text-[9px] uppercase tracking-[0.35em] text-neutral-400 font-semibold block">Secure Client Access</span>
                <h1 class="serif-font text-2xl font-normal text-neutral-900">Sign In</h1>
            </div>

            <?php if (!empty($message)): ?>
                <div class="p-3 bg-red-50 border border-red-200/60 text-red-600 text-xs flex items-start space-x-2">
                    <i class="fa-solid fa-circle-exclamation mt-0.5 text-[11px]"></i>
                    <span><?= htmlspecialchars($message) ?></span>
                </div>
            <?php endif; ?>

            <form method="POST" class="space-y-4">
                <div class="space-y-1">
                    <label class="text-[10px] uppercase tracking-wider font-semibold text-neutral-400">Email Address</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-neutral-400 text-xs"><i class="fa-regular fa-envelope"></i></span>
                        <input type="email" name="email" placeholder="name@domain.com" required
                               class="w-full pl-9 pr-3 py-2.5 bg-white border border-neutral-200 text-xs focus:outline-hidden focus:border-neutral-900 transition-all">
                    </div>
                </div>

                <div class="space-y-1">
                    <label class="text-[10px] uppercase tracking-wider font-semibold text-neutral-400">Password</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-neutral-400 text-xs"><i class="fa-solid fa-lock text-[11px]"></i></span>
                        <input type="password" name="password" placeholder="••••••••" required
                               class="w-full pl-9 pr-3 py-2.5 bg-white border border-neutral-200 text-xs focus:outline-hidden focus:border-neutral-900 transition-all">
                    </div>
                </div>

                <button type="submit" name="login" class="w-full bg-neutral-900 text-white text-xs uppercase tracking-widest py-3 font-medium hover:bg-neutral-800 transition-colors cursor-pointer">
                    Authenticate Identity
                </button>
            </form>

            <div class="pt-4 border-t border-neutral-100 text-center">
                <p class="text-[11px] text-neutral-400">
                    New to the Atelier? <a href="register.php" class="text-neutral-900 font-semibold underline underline-offset-4 hover:text-neutral-600 transition-colors">Create Account</a>
                </p>
            </div>
        </div>
    </main>

    <footer class="w-full py-6 border-t border-neutral-200/40 text-center text-neutral-400 text-[10px] tracking-wider bg-white">
        <p>&copy; 2026 AESTHETIQUE Atelier. Cryptographic credentials verified.</p>
    </footer>
</body>
</html>