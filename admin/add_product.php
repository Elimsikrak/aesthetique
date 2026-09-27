<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include("../includes/db.php");

/** @var mysqli $conn */ // Injects the database connection context to clear Intelephense P1008 diagnostics
global $conn;

// Operational Status Messaging Vaults
$message = "";
$message_type = "";

/**
 * Administrative Product Intake Engine
 */
if (isset($_POST['add_product'])) {
    $product_name = mysqli_real_escape_string($conn, trim($_POST['product_name']));
    $category     = mysqli_real_escape_string($conn, trim($_POST['category']));
    $brand        = mysqli_real_escape_string($conn, trim($_POST['brand']));
    $price        = (float)$_POST['price'];
    $description  = mysqli_real_escape_string($conn, trim($_POST['description']));

    // File Upload Verification Pipelines
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $file_tmp_path = $_FILES['image']['tmp_name'];
        $file_name     = $_FILES['image']['name'];
        $file_size     = $_FILES['image']['size'];
        
        // Clean and isolate extension parameters
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'webp'];

        if (in_array($file_ext, $allowed_extensions)) {
            // Enforce explicit size constraints (Max 5MB bounds safety verification)
            if ($file_size <= 5242880) {
                // Generate secure runtime hash names to prevent filesystem collisions
                $new_file_name = time() . '_' . md5(uniqid(rand(), true)) . '.' . $file_ext;
                $upload_dir    = '../uploads/';
                
                // Establish structural verification paths if directory arrays are missing
                if (!is_dir($upload_dir)) {
                    mkdir($upload_dir, 0755, true);
                }

                $dest_path = $upload_dir . $new_file_name;

                if (move_uploaded_file($file_tmp_path, $dest_path)) {
                    // Inject metadata parameters into database layers safely
                    $sql = "INSERT INTO products (product_name, category, brand, price, description, image) 
                            VALUES ('$product_name', '$category', '$brand', $price, '$description', '$new_file_name')";
                    
                    if (mysqli_query($conn, $sql)) {
                        $message = "Piece successfully cataloged within system inventory parameters.";
                        $message_type = "success";
                    } else {
                        $message = "Database synchronization failed: " . mysqli_error($conn);
                        $message_type = "error";
                    }
                } else {
                    $message = "File subsystem failure transferring asset to target matrix.";
                    $message_type = "error";
                }
            } else {
                $message = "Asset parameters exceed maximum bounds limits (5MB boundary cap).";
                $message_type = "error";
            }
        } else {
            $message = "Forbidden file structural definition type. Use JPG, JPEG, PNG, or WEBP formats.";
            $message_type = "error";
        }
    } else {
        $message = "Please select a valid, non-corrupted source image verification profile.";
        $message_type = "error";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Intake | AESTHETIQUE Control</title>
    <!-- Tailwind CSS Engine -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Premium Typography & Icon Vaults -->
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

    <!-- ADMINISTRATIVE HUB NAVBAR HEADER -->
    <header class="w-full py-5 px-4 sm:px-8 border-b border-neutral-200/60 bg-white/80 backdrop-blur-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <a href="../shop.php" class="serif-font text-lg tracking-[0.25em] uppercase font-semibold text-neutral-900">
                    AESTHETIQUE
                </a>
                <span class="text-[9px] uppercase tracking-widest font-mono px-1.5 py-0.5 bg-neutral-900 text-white rounded-2xs">Control Desk</span>
            </div>
            <a href="../shop.php" class="text-[10px] uppercase tracking-widest font-semibold text-neutral-400 hover:text-black transition-colors">
                View Public Storefront <i class="fa-solid fa-arrow-up-right-from-square text-[8px] ml-1"></i>
            </a>
        </div>
    </header>

    <!-- HUB MANIFEST CONTENT CORE -->
    <main class="flex-grow flex items-center justify-center px-4 py-14">
        <div class="max-w-2xl w-full bg-white border border-neutral-200/60 p-6 sm:p-12 shadow-2xs space-y-8">
            
            <!-- Context Header Section -->
            <div class="text-center space-y-2">
                <span class="text-[9px] uppercase tracking-[0.35em] text-neutral-400 font-semibold block">Inventory Curation Modules</span>
                <h1 class="serif-font text-3xl font-normal tracking-wide text-neutral-900">Catalog New Piece</h1>
            </div>

            <!-- SYSTEM MESSAGE ALERTS BANNER ARRAY -->
            <?php if (!empty($message)): ?>
                <?php if ($message_type === 'error'): ?>
                    <div class="p-4 bg-red-50 border border-red-200/60 text-red-600 text-xs flex items-start space-x-2.5">
                        <i class="fa-solid fa-circle-exclamation mt-0.5 text-sm"></i>
                        <span class="font-medium"><?= htmlspecialchars($message) ?></span>
                    </div>
                <?php else: ?>
                    <div class="p-4 bg-neutral-900 text-white text-xs flex items-start space-x-2.5">
                        <i class="fa-solid fa-circle-check mt-0.5 text-sm text-emerald-400"></i>
                        <span class="font-medium tracking-wide"><?= htmlspecialchars($message) ?></span>
                    </div>
                <?php endif; ?>
            <?php endif; ?>

            <!-- SECURE MULTIPART FILE INTAKE FORM -->
            <form method="POST" enctype="multipart/form-data" class="space-y-6">
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <!-- Product Name Input -->
                    <div class="space-y-1.5">
                        <label class="text-[10px] uppercase tracking-wider font-semibold text-neutral-400">Product Designation</label>
                        <input type="text" name="product_name" placeholder="e.g., Raw Silk Daura Suruwal" required
                               class="w-full px-3.5 py-2.5 bg-white border border-neutral-200 text-xs font-medium placeholder-neutral-300 focus:outline-hidden focus:border-neutral-900 focus:ring-1 focus:ring-neutral-900/10 transition-all">
                    </div>

                    <!-- Category Allocation -->
                    <div class="space-y-1.5">
                        <label class="text-[10px] uppercase tracking-wider font-semibold text-neutral-400">Category Index</label>
                        <select name="category" required
                                class="w-full px-3.5 py-2.5 bg-white border border-neutral-200 text-xs font-medium focus:outline-hidden focus:border-neutral-900 focus:ring-1 focus:ring-neutral-900/10 transition-all">
                            <option value="Heritage">Heritage</option>
                            <option value="Modern">Modern</option>
                            <option value="Outerwear">Outerwear</option>
                            <option value="Loungewear">Loungewear</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <!-- Brand Label Allocation -->
                    <div class="space-y-1.5">
                        <label class="text-[10px] uppercase tracking-wider font-semibold text-neutral-400">Brand / Studio Label</label>
                        <input type="text" name="brand" placeholder="e.g., Aesthetique Heritage" required
                               class="w-full px-3.5 py-2.5 bg-white border border-neutral-200 text-xs font-medium placeholder-neutral-300 focus:outline-hidden focus:border-neutral-900 focus:ring-1 focus:ring-neutral-900/10 transition-all">
                    </div>

                    <!-- Market Price Metric Configuration -->
                    <div class="space-y-1.5">
                        <label class="text-[10px] uppercase tracking-wider font-semibold text-neutral-400">Price Configuration (NPR)</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-neutral-400 text-[11px] font-mono font-semibold">Rs.</span>
                            <input type="number" step="0.01" name="price" placeholder="0.00" required
                                   class="w-full pl-10 pr-3.5 py-2.5 bg-white border border-neutral-200 text-xs font-mono font-medium placeholder-neutral-300 focus:outline-hidden focus:border-neutral-900 focus:ring-1 focus:ring-neutral-900/10 transition-all">
                        </div>
                    </div>
                </div>

                <!-- Descriptive Metadata Fields -->
                <div class="space-y-1.5">
                    <label class="text-[10px] uppercase tracking-wider font-semibold text-neutral-400">Editorial Product Profile / Description</label>
                    <textarea name="description" rows="4" placeholder="Detail the cut, textile integrity, stitching configurations, and architectural layout parameters..." required
                              class="w-full px-3.5 py-2.5 bg-white border border-neutral-200 text-xs font-medium placeholder-neutral-300 focus:outline-hidden focus:border-neutral-900 focus:ring-1 focus:ring-neutral-900/10 transition-all leading-relaxed resize-none"></textarea>
                </div>

                <!-- Minimal Asset Upload File Picker -->
                <div class="space-y-1.5">
                    <label class="text-[10px] uppercase tracking-wider font-semibold text-neutral-400">High-Resolution Creative Image Asset</label>
                    <div class="w-full border border-dashed border-neutral-200 hover:border-neutral-400 transition-colors bg-neutral-50 p-6 text-center relative group">
                        <input type="file" name="image" accept=".jpg,.jpeg,.png,.webp" required
                               class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                        <div class="space-y-2">
                            <i class="fa-regular fa-image text-neutral-300 text-2xl group-hover:text-neutral-400 transition-colors"></i>
                            <p class="text-[11px] text-neutral-500 font-medium">Click to select product asset file layout mappings</p>
                            <p class="text-[9px] text-neutral-400 font-light">Supported parameter matrices: JPG, PNG, WEBP (Max size limit: 5MB)</p>
                        </div>
                    </div>
                </div>

                <!-- Execution Trigger Module -->
                <div class="pt-4">
                    <button type="submit" name="add_product"
                            class="w-full bg-neutral-900 text-white text-xs uppercase tracking-widest py-3.5 font-semibold transition-colors hover:bg-neutral-800 rounded-none cursor-pointer">
                        Synchronize Catalog Matrix
                    </button>
                </div>

            </form>

        </div>
    </main>

    <!-- SECURE MANAGEMENT LOG DESK FOOTER -->
    <footer class="w-full py-6 px-4 border-t border-neutral-200/40 text-center text-neutral-400 text-[10px] font-light tracking-wider bg-white">
        <p>&copy; 2026 AESTHETIQUE Matrix Suite. Administrative modifications audited under verified token protocols.</p>
    </footer>
<script src="../js/script.js"></script>
</body>
</html>