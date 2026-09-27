<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include("../includes/db.php");

/** @var mysqli $conn */
global $conn;

$message = "";
$message_type = "";

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$product_query = mysqli_query($conn, "SELECT * FROM products WHERE id=$id");
$product = mysqli_fetch_assoc($product_query);

if (!$product) {
    die("Target specification record not found within database array maps.");
}

if (isset($_POST['update_product'])) {
    $product_name = mysqli_real_escape_string($conn, trim($_POST['product_name']));
    $category     = mysqli_real_escape_string($conn, trim($_POST['category']));
    $brand        = mysqli_real_escape_string($conn, trim($_POST['brand']));
    $price        = (float)$_POST['price'];
    $description  = mysqli_real_escape_string($conn, trim($_POST['description']));
    $image_filename = $product['image']; // Default asset value if unchanged

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $file_tmp  = $_FILES['image']['tmp_name'];
        $file_ext  = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        
        if (in_array($file_ext, ['jpg', 'jpeg', 'png', 'webp'])) {
            $new_filename = time() . '_' . uniqid() . '.' . $file_ext;
            if (move_uploaded_file($file_tmp, "../uploads/" . $new_filename)) {
                if (file_exists("../uploads/" . $product['image']) && !empty($product['image'])) {
                    @unlink("../uploads/" . $product['image']); // Clean up old asset
                }
                $image_filename = $new_filename;
            }
        }
    }

    $sql = "UPDATE products SET product_name='$product_name', category='$category', brand='$brand', price=$price, description='$description', image='$image_filename' WHERE id=$id";
    
    if (mysqli_query($conn, $sql)) {
        header("Location: view_products.php");
        exit();
    } else {
        $message = "Modification compilation runtime exception: " . mysqli_error($conn);
        $message_type = "error";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Manifest Profile | AESTHETIQUE</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Playfair+Display:ital,wght@0,400;0,600;1,400&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #FAF9F6; }
        .serif-font { font-family: 'Playfair Display', serif; }
    </style>
</head>
<body class="text-neutral-800 antialiased min-h-screen flex flex-col justify-between">

    <header class="w-full py-5 px-6 border-b border-neutral-200/60 bg-white">
        <div class="max-w-3xl mx-auto"><a href="view_products.php" class="text-[10px] font-semibold tracking-widest text-neutral-400 uppercase hover:text-black">Cancel Matrix Edit</a></div>
    </header>

    <main class="flex-grow flex items-center justify-center px-4 py-12">
        <div class="max-w-xl w-full bg-white border border-neutral-200/60 p-6 sm:p-10 shadow-2xs space-y-6">
            <h2 class="serif-font text-xl font-normal text-neutral-900 border-b border-neutral-100 pb-3">Refine Piece Settings</h2>

            <form method="POST" enctype="multipart/form-data" class="space-y-4 text-xs">
                <div class="space-y-1">
                    <label class="text-[10px] uppercase font-semibold text-neutral-400">Product Designation</label>
                    <input type="text" name="product_name" value="<?= htmlspecialchars($product['product_name']) ?>" required class="w-full p-2.5 bg-white border border-neutral-200 focus:outline-hidden focus:border-neutral-900">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-1">
                        <label class="text-[10px] uppercase font-semibold text-neutral-400">Category</label>
                        <input type="text" name="category" value="<?= htmlspecialchars($product['category']) ?>" required class="w-full p-2.5 bg-white border border-neutral-200 focus:outline-hidden focus:border-neutral-900">
                    </div>
                    <div class="space-y-1">
                        <label class="text-[10px] uppercase font-semibold text-neutral-400">Brand Label</label>
                        <input type="text" name="brand" value="<?= htmlspecialchars($product['brand']) ?>" required class="w-full p-2.5 bg-white border border-neutral-200 focus:outline-hidden focus:border-neutral-900">
                    </div>
                </div>

                <div class="space-y-1">
                    <label class="text-[10px] uppercase font-semibold text-neutral-400">Price Configuration (NPR)</label>
                    <input type="number" step="0.01" name="price" value="<?= $product['price'] ?>" required class="w-full p-2.5 font-mono bg-white border border-neutral-200 focus:outline-hidden focus:border-neutral-900">
                </div>

                <div class="space-y-1">
                    <label class="text-[10px] uppercase font-semibold text-neutral-400">Product Profile Description</label>
                    <textarea name="description" rows="4" required class="w-full p-2.5 bg-white border border-neutral-200 focus:outline-hidden focus:border-neutral-900 resize-none leading-relaxed"><?= htmlspecialchars($product['description']) ?></textarea>
                </div>

                <div class="space-y-1">
                    <label class="text-[10px] uppercase font-semibold text-neutral-400">Replace Image Asset (Optional)</label>
                    <input type="file" name="image" accept=".jpg,.jpeg,.png,.webp" class="w-full p-2 bg-neutral-50 border border-neutral-200">
                </div>

                <button type="submit" name="update_product" class="w-full bg-neutral-900 text-white text-[10px] uppercase tracking-widest py-3 font-semibold hover:bg-neutral-800 cursor-pointer">Commit Structural Revisions</button>
            </form>
        </div>
    </main>

    <footer class="w-full py-6 text-center text-neutral-400 text-[10px] bg-white border-t border-neutral-200/40">
        <p>&copy; 2026 AESTHETIQUE Matrix Suite. Edits tracked dynamically.</p>
    </footer>
    <script src="../js/script.js"></script>
</body>
</html>