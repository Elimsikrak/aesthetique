<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("includes/db.php");

$page_title = "Discover Collection";


/* Secure Search Architecture */
$search_value = "";
if(isset($_GET['search']) && trim($_GET['search']) != ""){
    $search = mysqli_real_escape_string($conn, trim($_GET['search']));
    $search_value = $_GET['search']; // Saved for safe rendering in input value

    $sql = "SELECT * FROM products 
            WHERE product_name LIKE '%$search%' 
            OR category LIKE '%$search%'";
}else{
    $sql = "SELECT * FROM products";
}

$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="ne">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>संग्रह | AESTHETIQUE Atelier</title>
    <!-- Tailwind CSS Engine -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Premium Google Font Typography -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Playfair+Display:ital,wght@0,400;0,600;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body { font-family: 'Inter', sans-serif; background-color: #FAF9F6; }
        .serif-font { font-family: 'Playfair Display', serif; }
        .product-card:hover .product-img { transform: scale(1.02); }
    </style>
</head>
<body class="text-neutral-800 antialiased min-h-screen flex flex-col justify-between">

    <!-- GLOBAL FRAMEWORK NAVIGATION -->
    <?php include("includes/navbar.php"); ?>

    <!-- MAIN COLLECTION FRAMEWORK -->
    <main class="flex-grow max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-12">
        
        <!-- Editorial Section Headline -->
        <div class="text-center max-w-xl mx-auto mb-12 space-y-2">
            <span class="text-[9px] uppercase tracking-[0.35em] text-neutral-400 font-semibold block">Aesthetique Curations</span>
            <h1 class="serif-font text-3xl font-normal tracking-wide text-neutral-900">किनमेल</h1>
            <p class="text-neutral-400 text-[11px] font-light tracking-wide">
                Explore handcrafted heritage structures and clean modern tailoring profiles.
            </p>
        </div>

        <!-- MINIMAL LUXURY SEARCH ENGINE BAR -->
        <form method="GET" class="max-w-md mx-auto mb-16 px-4">
            <div class="relative border-b border-neutral-200 focus-within:border-neutral-900 transition-colors duration-300 pb-1.5 flex items-center">
                <span class="text-neutral-400 text-xs mr-2.5">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </span>
                <input type="text" name="search" placeholder="उत्पादन खोज्नुहोस्..." 
                       value="<?= htmlspecialchars($search_value) ?>"
                       class="w-full bg-transparent text-xs tracking-wide placeholder-neutral-300 focus:outline-hidden text-neutral-800 font-light py-1">
                
                <?php if(!empty($search_value)): ?>
                    <a href="shop.php" class="text-neutral-300 hover:text-neutral-900 text-xs mr-3 transition-colors">
                        <i class="fa-solid fa-xmark"></i>
                    </a>
                <?php endif; ?>

                <button type="submit" class="text-[10px] uppercase tracking-widest font-semibold text-neutral-500 hover:text-neutral-900 transition-colors shrink-0 cursor-pointer">
                    खोज्नुहोस्
                </button>
            </div>
        </form>

        <!-- PRODUCT LEDGER DISPLAY GRID -->
        <?php if(mysqli_num_rows($result) === 0): ?>
            <!-- Dynamic Empty State Presentation -->
            <div class="text-center py-20 bg-white border border-neutral-200/50 max-w-xl mx-auto p-8 shadow-2xs">
                <i class="fa-solid fa-receipt text-neutral-200 text-xl mb-3 block"></i>
                <p class="serif-font italic text-neutral-500 text-sm">कुनै पनि उत्पादनहरू फेला परेनन्।</p>
                <p class="text-neutral-400 text-[11px] mt-1">Please verify your query parameter or view our alternative collections.</p>
                <a href="shop.php" class="inline-block mt-5 text-[10px] uppercase tracking-widest font-medium bg-neutral-900 text-white px-4 py-2 hover:bg-neutral-800 transition-colors">
                    Reset Index
                </a>
            </div>
        <?php else: ?>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-x-4 gap-y-10 sm:gap-x-6 sm:gap-y-14">
                <?php while($row = mysqli_fetch_assoc($result)){ ?>
                    <article class="product-card group flex flex-col justify-between space-y-4 bg-white border border-neutral-200/40 p-3 shadow-2xs hover:border-neutral-300 transition-all duration-300">
                        
                        <!-- Premium Aspect Ratio Image Box -->
                        <div class="w-full aspect-[3/4] bg-neutral-50 overflow-hidden relative">
                            <?php if(isset($row['category'])): ?>
                                <span class="absolute top-3 left-3 bg-neutral-50/90 backdrop-blur-xs text-neutral-500 text-[8px] font-medium tracking-widest uppercase px-1.5 py-0.5 border border-neutral-200 z-10">
                                    <?= htmlspecialchars($row['category']) ?>
                                </span>
                            <?php endif; ?>
                            <img src="uploads/<?= htmlspecialchars($row['image']) ?>" 
                                 alt="<?= htmlspecialchars($row['product_name']) ?>" 
                                 class="product-img w-full h-full object-cover transition-transform duration-500 ease-out">
                        </div>

                        <!-- Product Descriptive Block Metadata -->
                        <div class="space-y-2 flex-grow flex flex-col justify-between">
                            <div>
                                <h3 class="text-xs text-neutral-900 font-medium line-clamp-1 group-hover:text-neutral-600 transition-colors">
                                    <?= htmlspecialchars($row['product_name']) ?>
                                </h3>
                            </div>
                            
                            <div class="pt-2 flex items-center justify-between border-t border-neutral-100">
                                <span class="text-xs font-semibold text-neutral-900 font-mono">
                                    Rs. <?= number_format($row['price']) ?>
                                </span>
                                <a href="product.php?id=<?= (int)$row['id'] ?>" 
                                   class="text-[10px] uppercase tracking-wider font-semibold border-b border-black pb-0.5 text-neutral-900 hover:text-neutral-400 hover:border-neutral-400 transition-colors">
                                    हेर्नुहोस्
                                </a>
                            </div>
                        </div>

                    </article>
                <?php } ?>
            </div>
        <?php endif; ?>

    </main>

    <!-- SECURE LUXURY FOOTER METRICS -->
    <footer class="w-full py-8 px-4 border-t border-neutral-200/40 text-center text-neutral-400 text-[10px] font-light tracking-wider bg-white mt-20">
        <p>&copy; 2026 AESTHETIQUE Atelier. Architectural product parameters mapped under structural catalog parameters.</p>
    </footer>

</body>
</html>