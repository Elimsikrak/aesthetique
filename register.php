<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("includes/db.php");

$message = "";
$message_type = ""; // Track status type ('error' or 'success') for refined UI states

if(isset($_POST['register'])){

    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    if($password != $confirmPassword){
        $message = "The specified passwords do not match.";
        $message_type = "error";
    }
    else{
        $checkEmail = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");

        if(mysqli_num_rows($checkEmail) > 0){
            $message = "This email address is already registered.";
            $message_type = "error";
        }else{
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $insert = mysqli_query($conn,
            "INSERT INTO users(fullname,email,phone,password)
            VALUES('$fullname','$email','$phone','$hashedPassword')");

            if($insert){
                $message = "Registration successful! You may now proceed to log in.";
                $message_type = "success";
            }else{
                $message = "Critical registration failure. Please verify structural parameters.";
                $message_type = "error";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Registry | AESTHETIQUE</title>
    <!-- Tailwind CSS Engine -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Premium Typography Frameworks -->
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

    <!-- STICKY MINIMAL BRAND HEADER -->
    <header class="w-full py-6 px-4 sm:px-8 border-b border-neutral-200/60 bg-[#FAF9F6]/80 backdrop-blur-md z-50">
        <div class="max-w-7xl mx-auto flex justify-center items-center">
            <a href="shop.php" class="serif-font text-xl tracking-[0.25em] uppercase font-semibold text-neutral-900">
                AESTHETIQUE
            </a>
        </div>
    </header>

    <!-- CORE AUTHENTICATION HUB -->
    <main class="flex-grow flex items-center justify-center px-4 py-12">
        <div class="max-w-md w-full bg-white border border-neutral-200/60 p-6 sm:p-10 shadow-2xs space-y-6">
            
            <!-- Context Headers -->
            <div class="text-center space-y-1.5">
                <span class="text-[9px] uppercase tracking-[0.35em] text-neutral-400 font-semibold block">Volume Client Registry</span>
                <h1 class="serif-font text-2xl font-normal tracking-wide text-neutral-900">Create Account</h1>
            </div>

            <!-- SYSTEM RESPONSE BANNERS -->
            <?php if(!empty($message)): ?>
                <?php if($message_type === 'error'): ?>
                    <div class="p-3 bg-red-50 border border-red-200/60 text-red-600 text-xs flex items-start space-x-2">
                        <i class="fa-solid fa-circle-exclamation mt-0.5 text-[11px]"></i>
                        <span><?= htmlspecialchars($message) ?></span>
                    </div>
                <?php else: ?>
                    <div class="p-3 bg-emerald-50 border border-emerald-200/60 text-emerald-700 text-xs flex items-start space-x-2">
                        <i class="fa-solid fa-circle-check mt-0.5 text-[11px]"></i>
                        <span><?= htmlspecialchars($message) ?></span>
                    </div>
                <?php endif; ?>
            <?php endif; ?>

            <!-- REGISTRATION SECURE FORM -->
            <form method="POST" class="space-y-4">
                
                <!-- Full Name Field -->
                <div class="space-y-1">
                    <label class="text-[10px] uppercase tracking-wider font-semibold text-neutral-400">Full Name</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-neutral-400 text-xs">
                            <i class="fa-regular fa-user"></i>
                        </span>
                        <input type="text" name="fullname" placeholder="John Doe" required
                               class="w-full pl-9 pr-3 py-2.5 bg-white border border-neutral-200 text-xs font-medium placeholder-neutral-300 focus:outline-hidden focus:border-neutral-900 focus:ring-1 focus:ring-neutral-900/10 transition-all duration-200">
                    </div>
                </div>

                <!-- Email Address Field -->
                <div class="space-y-1">
                    <label class="text-[10px] uppercase tracking-wider font-semibold text-neutral-400">Email Address</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-neutral-400 text-xs">
                            <i class="fa-regular fa-envelope"></i>
                        </span>
                        <input type="email" name="email" placeholder="name@domain.com" required
                               class="w-full pl-9 pr-3 py-2.5 bg-white border border-neutral-200 text-xs font-medium placeholder-neutral-300 focus:outline-hidden focus:border-neutral-900 focus:ring-1 focus:ring-neutral-900/10 transition-all duration-200">
                    </div>
                </div>

                <!-- Phone Network Field -->
                <div class="space-y-1">
                    <label class="text-[10px] uppercase tracking-wider font-semibold text-neutral-400">Phone Number</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-neutral-400 text-xs">
                            <i class="fa-solid fa-phone-flip text-[11px]"></i>
                        </span>
                        <input type="text" name="phone" placeholder="+977 98XXXXXXXX" required
                               class="w-full pl-9 pr-3 py-2.5 bg-white border border-neutral-200 text-xs font-medium placeholder-neutral-300 focus:outline-hidden focus:border-neutral-900 focus:ring-1 focus:ring-neutral-900/10 transition-all duration-200">
                    </div>
                </div>

                <!-- Password Field -->
                <div class="space-y-1">
                    <label class="text-[10px] uppercase tracking-wider font-semibold text-neutral-400">Password</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-neutral-400 text-xs">
                            <i class="fa-solid fa-lock text-[11px]"></i>
                        </span>
                        <input type="password" name="password" placeholder="••••••••" required
                               class="w-full pl-9 pr-3 py-2.5 bg-white border border-neutral-200 text-xs font-medium placeholder-neutral-300 focus:outline-hidden focus:border-neutral-900 focus:ring-1 focus:ring-neutral-900/10 transition-all duration-200">
                    </div>
                </div>

                <!-- Confirm Password Field -->
                <div class="space-y-1">
                    <label class="text-[10px] uppercase tracking-wider font-semibold text-neutral-400">Confirm Password</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-neutral-400 text-xs">
                            <i class="fa-solid fa-shield-halved text-[11px]"></i>
                        </span>
                        <input type="password" name="confirm_password" placeholder="••••••••" required
                               class="w-full pl-9 pr-3 py-2.5 bg-white border border-neutral-200 text-xs font-medium placeholder-neutral-300 focus:outline-hidden focus:border-neutral-900 focus:ring-1 focus:ring-neutral-900/10 transition-all duration-200">
                    </div>
                </div>

                <!-- Action Button Assembly -->
                <div class="pt-2">
                    <button type="submit" name="register" 
                            class="w-full bg-neutral-900 text-white text-xs uppercase tracking-widest py-3 font-medium transition-colors hover:bg-neutral-800 rounded-none cursor-pointer">
                        Establish Registry
                    </button>
                </div>

            </form>

            <!-- Secondary Routing Anchors -->
            <div class="pt-4 border-t border-neutral-100 text-center">
                <p class="text-[11px] text-neutral-400">
                    Already have an account? 
                    <a href="login.php" class="text-neutral-900 font-semibold underline underline-offset-4 hover:text-neutral-600 transition-colors">
                        Login Here
                    </a>
                </p>
            </div>

        </div>
    </main>

    <!-- SECURE PROTOCOL FOOTER -->
    <footer class="w-full py-6 px-4 border-t border-neutral-200/40 text-center text-neutral-400 text-[10px] font-light tracking-wider bg-white">
        <p>&copy; 2026 AESTHETIQUE Atelier. Authentication registries encrypted under strict modern standard hash patterns.</p>
    </footer>

</body>
</html>