<?php
session_start();

// Comprehensive Luxury Product Repository (22 Curation Elements)
$products = [
    [
        "id" => 1,
        "name" => "Premium Silk Daura Suruwal Set",
        "category" => "Heritage",
        "brand" => "Aesthetique Heritage",
        "price" => 12500,
        "badge" => "Signature",
        "image" => "https://images.unsplash.com/photo-1609141071271-e94db9756b19?auto=format&fit=crop&w=600&q=80",
        "description" => "Hand-tailored mulberry silk blending ancient Nepalese patterns with sharp, tailored structural aesthetics."
    ],
    [
        "id" => 2,
        "name" => "Oversized Streetwear Heavyweight Hoodie",
        "category" => "Modern",
        "brand" => "Aesthetique Lab",
        "price" => 6200,
        "badge" => "New",
        "image" => "https://images.unsplash.com/photo-1556821840-3a63f95609a7?auto=format&fit=crop&w=600&q=80",
        "description" => "450GSM loopback organic cotton dropped-shoulder loungewear optimized for urban comfort."
    ],
    [
        "id" => 3,
        "name" => "Minimalist Tailored Camel Trench",
        "category" => "Outerwear",
        "brand" => "Studio Blanc",
        "price" => 16500,
        "badge" => "Essential",
        "image" => "https://images.unsplash.com/photo-1525507119028-ed4c629a60a3?auto=format&fit=crop&w=600&q=80",
        "description" => "Double-breasted heavyweight wool-blend trench coat offering structural security and elegant drapes."
    ],
    [
        "id" => 4,
        "name" => "Authentic Newari Haku Patasi",
        "category" => "Heritage",
        "brand" => "Kwon Heritage",
        "price" => 9800,
        "badge" => "Heritage Edition",
        "image" => "https://images.unsplash.com/photo-1583391733956-3750e0ff4e8b?auto=format&fit=crop&w=600&q=80",
        "description" => "Indigenously woven black cotton sari characterized by its distinctive hand-dyed crimson borders."
    ],
    [
        "id" => 5,
        "name" => "Pure Chyangra Pashmina Shawl",
        "category" => "Heritage",
        "brand" => "Aesthetique Heritage",
        "price" => 24500,
        "badge" => "Rare Fine",
        "image" => "https://images.unsplash.com/photo-1606760227091-3dd870d97f1d?auto=format&fit=crop&w=600&q=80",
        "description" => "Ultra-fine Himalayan mountain cashmere combed exclusively in high-altitude Nepalese cordilleras."
    ],
    [
        "id" => 6,
        "name" => "Raw Silk Kurta Layering Set",
        "category" => "Heritage",
        "brand" => "Aesthetique Heritage",
        "price" => 11000,
        "badge" => null,
        "image" => "https://images.unsplash.com/photo-1617627143750-d86bc21e42bb?auto=format&fit=crop&w=600&q=80",
        "description" => "Breathable raw silk foundational mid-layer cut designed specifically for celebratory luxury."
    ],
    [
        "id" => 7,
        "name" => "Heavy Cotton Drop-Shoulder Tee",
        "category" => "Modern",
        "brand" => "Aesthetique Lab",
        "price" => 2800,
        "badge" => "Core Basic",
        "image" => "https://images.unsplash.com/photo-1521572267360-ee0c2909d518?auto=format&fit=crop&w=600&q=80",
        "description" => "Robust knit modular t-shirt featuring boxy cuts, thick rib collars, and reinforced flat-lock seams."
    ],
    [
        "id" => 8,
        "name" => "Deconstructed Denim Trucker Jacket",
        "category" => "Modern",
        "brand" => "Aesthetique Lab",
        "price" => 8900,
        "badge" => "Limited Cut",
        "image" => "https://images.unsplash.com/photo-1576995853123-5a10305d93c0?auto=format&fit=crop&w=600&q=80",
        "description" => "14oz raw selvedge denim displaying asymmetric wash patterns and intentional industrial distressing."
    ],
    [
        "id" => 9,
        "name" => "Linen Relaxed Lounge Trousers",
        "category" => "Loungewear",
        "brand" => "Studio Blanc",
        "price" => 5400,
        "badge" => null,
        "image" => "https://images.unsplash.com/photo-1594633312681-425c7b97ccd1?auto=format&fit=crop&w=600&q=80",
        "description" => "French flax linen tailored flat-front pants incorporating flexible drawstrings for summer ease."
    ],
    [
        "id" => 10,
        "name" => "Structured Charcoal Wool Blazer",
        "category" => "Outerwear",
        "brand" => "Studio Blanc",
        "price" => 14800,
        "badge" => "Tailored",
        "image" => "https://images.unsplash.com/photo-1507679799987-c73779587ccf?auto=format&fit=crop&w=600&q=80",
        "description" => "Neapolitan shoulder tailoring featuring premium interior satin lining and authentic horn buttons."
    ],
    [
        "id" => 11,
        "name" => "Fine Cashmere Mockneck Sweater",
        "category" => "Loungewear",
        "brand" => "Studio Blanc",
        "price" => 19200,
        "badge" => "Premium Blend",
        "image" => "https://images.unsplash.com/photo-1578587018452-892bacefd3f2?auto=format&fit=crop&w=600&q=80",
        "description" => "Featherweight knit layering insulation built with a premium minimalist silhouette."
    ],
    [
        "id" => 12,
        "name" => "Asymmetric Pleated Midi Skirt",
        "category" => "Modern",
        "brand" => "Atelier Minimal",
        "price" => 7300,
        "badge" => null,
        "image" => "https://images.unsplash.com/photo-1583496661160-fb488653f5d4?auto=format&fit=crop&w=600&q=80",
        "description" => "Sharp structural geometry folds featuring fluid motion retention parameters and deep pockets."
    ],
    [
        "id" => 13,
        "name" => "Cultural Palpali Dhaka Vest",
        "category" => "Heritage",
        "brand" => "Kwon Heritage",
        "price" => 4900,
        "badge" => "Local Craft",
        "image" => "https://images.unsplash.com/photo-1624378439575-d8705ad7ae80?auto=format&fit=crop&w=600&q=80",
        "description" => "Traditional geometric motifs woven natively on handlooms in Palpa, perfect for ceremonial accents."
    ],
    [
        "id" => 14,
        "name" => "Matte Waterproof Urban Puffer",
        "category" => "Outerwear",
        "brand" => "Aesthetique Lab",
        "price" => 13500,
        "badge" => "Technical",
        "image" => "https://images.unsplash.com/photo-1544923246-77307dd654cb?auto=format&fit=crop&w=600&q=80",
        "description" => "Down-filled ripstop shell jacket incorporating fully taped seam channels for rain protection."
    ],
    [
        "id" => 15,
        "name" => "Modular Technical Cargo Pants",
        "category" => "Modern",
        "brand" => "Aesthetique Lab",
        "price" => 6800,
        "badge" => null,
        "image" => "https://images.unsplash.com/photo-1517423568366-8b83523034fd?auto=format&fit=crop&w=600&q=80",
        "description" => "Articulated knee construction offering deep storage modules and water-repellent hardware."
    ],
    [
        "id" => 16,
        "name" => "Premium Heavy Knit Sweatpants",
        "category" => "Loungewear",
        "brand" => "Atelier Minimal",
        "price" => 5900,
        "badge" => "Core Basic",
        "image" => "https://images.unsplash.com/photo-1551854838-212c50b4c184?auto=format&fit=crop&w=600&q=80",
        "description" => "Relaxed fit luxury fleece trousers engineered with dense elastic bounds and concealed zipper guards."
    ],
    [
        "id" => 17,
        "name" => "Structured Pima Poplin Shirt",
        "category" => "Modern",
        "brand" => "Studio Blanc",
        "price" => 4500,
        "badge" => "Essential",
        "image" => "https://images.unsplash.com/photo-1603252109303-2751441dd157?auto=format&fit=crop&w=600&q=80",
        "description" => "Crisp, lightweight long-staple Egyptian cotton broadcloth woven for crisp office luxury profiles."
    ],
    [
        "id" => 18,
        "name" => "Velvet Royal Sherwani Jacket",
        "category" => "Heritage",
        "brand" => "Aesthetique Heritage",
        "price" => 32000,
        "badge" => "Elite Tier",
        "image" => "https://images.unsplash.com/photo-1593032465175-481da7fbb7fd?auto=format&fit=crop&w=600&q=80",
        "description" => "Deep pile midnight velvet adorned with hand-stitched zardozi embroidery across high collars."
    ],
    [
        "id" => 19,
        "name" => "Brushed Mohair Knit Cardigan",
        "category" => "Outerwear",
        "brand" => "Atelier Minimal",
        "price" => 9400,
        "badge" => "New Arrival",
        "image" => "https://images.unsplash.com/photo-1539571696357-5a69c17a67c6?auto=format&fit=crop&w=600&q=80",
        "description" => "Softly brushed loose-gauge mohair wool profile incorporating custom marbled buttons."
    ],
    [
        "id" => 20,
        "name" => "Bias-Cut Fluid Silk Slip Dress",
        "category" => "Modern",
        "brand" => "Atelier Minimal",
        "price" => 11500,
        "badge" => null,
        "image" => "https://images.unsplash.com/photo-1496747611176-843222e1e57c?auto=format&fit=crop&w=600&q=80",
        "description" => "Premium heavy satin cut perfectly on the bias to trace a flowing silhouette."
    ],
    [
        "id" => 21,
        "name" => "Ribbed Knit Organic Midi Dress",
        "category" => "Loungewear",
        "brand" => "Studio Blanc",
        "price" => 8200,
        "badge" => "Essential",
        "image" => "https://images.unsplash.com/photo-1595777457583-95e059d581b8?auto=format&fit=crop&w=600&q=80",
        "description" => "Elasticized vertical ribbing structures providing supreme insulation flexibility and daytime wearability."
    ],
    [
        "id" => 22,
        "name" => "Vintage Washed Japanese Denim Pants",
        "category" => "Modern",
        "brand" => "Aesthetique Lab",
        "price" => 10500,
        "badge" => "Rare Fine",
        "image" => "https://images.unsplash.com/photo-1541099649105-f69ad21f3246?auto=format&fit=crop&w=600&q=80",
        "description" => "Premium Kojima-sourced shuttle loom denim featuring nuance whiskers and historic metal alloy rivets."
    ]
];

// Contextual Category Filter Controller
$active_category = isset($_GET['category']) ? trim($_GET['category']) : 'All';

$filtered_products = $products;
if ($active_category !== 'All') {
    $filtered_products = array_filter($products, function ($item) use ($active_category) {
        return strcasecmp($item['category'], $active_category) === 0;
    });
}

// Extract distinct structural categories for UI filter pills
$categories_nav = ['All', 'Heritage', 'Modern', 'Outerwear', 'Loungewear'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Complete Archive Collection | AESTHETIQUE</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Typography & Icon Vaults -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Playfair+Display:ital,wght@0,400;0,600;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body { font-family: 'Inter', sans-serif; background-color: #FAF9F6; }
        .serif-font { font-family: 'Playfair Display', serif; }
        .product-card:hover .product-img { transform: scale(1.03); }
    </style>
</head>
<body class="text-neutral-800 antialiased min-h-screen flex flex-col justify-between">

    <!-- PLATFORM HEADER NAVBAR -->
    <header class="w-full py-6 px-4 sm:px-8 border-b border-neutral-200/60 bg-[#FAF9F6]/80 backdrop-blur-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <a href="product.php" class="serif-font text-xl tracking-[0.25em] uppercase font-semibold text-neutral-900">
                AESTHETIQUE
            </a>
            <div class="flex items-center space-x-6 text-xs uppercase tracking-widest font-medium text-neutral-500">
                <a href="my_orders.php" class="hover:text-black transition-colors">Client Ledger</a>
                <a href="#" class="relative hover:text-black transition-colors">
                    <i class="fa-solid fa-bag-shopping text-sm"></i>
                    <span class="absolute -top-1.5 -right-2 bg-neutral-900 text-white font-mono text-[8px] w-3.5 h-3.5 rounded-full flex items-center justify-center">0</span>
                </a>
            </div>
        </div>
    </header>

    <!-- ARCHIVE MASTER PLATFORM -->
    <main class="flex-grow max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-12">
        
        <!-- Editorial Headline Section -->
        <div class="text-center max-w-xl mx-auto mb-16 space-y-3">
            <span class="text-[10px] uppercase tracking-[0.35em] text-neutral-400 font-semibold block">Volume Complete Archive</span>
            <h1 class="serif-font text-4xl font-normal tracking-wide text-neutral-900">Curated Curation Index</h1>
            <p class="text-neutral-500 text-xs font-light leading-relaxed">
                Explore our full digital lookbook spanning historic Himalayan cultural frameworks and contemporary technical silhouettes.
            </p>
        </div>

        <!-- DYNAMIC ROUTING NAVIGATION PILLS -->
        <nav class="flex flex-wrap justify-center items-center gap-2 mb-12 border-b border-neutral-200/50 pb-6">
            <?php foreach ($categories_nav as $cat): ?>
                <a href="product.php?category=<?= urlencode($cat) ?>" 
                   class="px-5 py-2 text-xs uppercase tracking-widest transition-all duration-200 rounded-none font-medium border <?= border_color_fn($cat, $active_category) ?>">
                    <?= $cat ?>
                </a>
            <?php endforeach; ?>
        </nav>

        <!-- PRODUCT LEDGER DISPLAY GRID -->
        <?php if (empty($filtered_products)): ?>
            <div class="text-center py-24 bg-white border border-neutral-200/60">
                <i class="fa-solid fa-magnifying-glass text-2xl text-neutral-200 mb-3"></i>
                <p class="serif-font italic text-neutral-500 text-base">No selection indexes correspond to your filters.</p>
            </div>
        <?php else: ?>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-x-4 gap-y-10 sm:gap-x-6 sm:gap-y-14">
                <?php foreach ($filtered_products as $item): ?>
                    <article class="product-card group flex flex-col justify-between space-y-4 bg-white border border-neutral-200/40 p-3 shadow-2xs hover:border-neutral-300 transition-all duration-300">
                        
                        <!-- Image Layout Frame -->
                        <div class="w-full aspect-[3/4] bg-neutral-100 overflow-hidden relative">
                            <?php if (!empty($item['badge'])): ?>
                                <span class="absolute top-3 left-3 bg-neutral-900 text-white text-[9px] font-medium tracking-widest uppercase px-2 py-0.5 z-10">
                                    <?= htmlspecialchars($item['badge']) ?>
                                </span>
                            <?php endif; ?>
                            <img src="<?= htmlspecialchars($item['image']) ?>" 
                                 alt="<?= htmlspecialchars($item['name']) ?>" 
                                 class="product-img w-full h-full object-cover transition-transform duration-500 ease-out">
                        </div>

                        <!-- Product Content Details Metadata -->
                        <div class="space-y-1.5 flex-grow flex flex-col justify-between">
                            <div>
                                <div class="flex items-center justify-between text-[10px] text-neutral-400 font-medium tracking-wide uppercase">
                                    <span><?= htmlspecialchars($item['brand']) ?></span>
                                    <span class="px-1.5 py-0.5 bg-neutral-50 border border-neutral-200 text-neutral-500 text-[9px]"><?= htmlspecialchars($item['category']) ?></span>
                                </div>
                                <h3 class="text-xs text-neutral-900 font-medium line-clamp-1 mt-1 group-hover:text-neutral-600 transition-colors">
                                    <?= htmlspecialchars($item['name']) ?>
                                </h3>
                                <p class="text-[11px] text-neutral-400 font-light line-clamp-2 mt-1 leading-relaxed">
                                    <?= htmlspecialchars($item['description']) ?>
                                </p>
                            </div>
                            
                            <div class="pt-3 flex items-center justify-between border-t border-neutral-100 mt-2">
                                <span class="text-xs font-semibold text-neutral-900">Rs. <?= number_format($item['price']) ?></span>
                                <button class="text-[10px] uppercase tracking-wider font-semibold border-b border-black hover:text-neutral-400 hover:border-neutral-400 pb-0.5 transition-colors">
                                    View Piece
                                </button>
                            </div>
                        </div>

                    </article>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

    </main>

    <!-- FOOTER -->
    <footer class="w-full py-8 px-4 border-t border-neutral-200/40 text-center text-neutral-400 text-[11px] font-light tracking-wider bg-white mt-20">
        <p>&copy; 2026 AESTHETIQUE Atelier. All Inventory Vaults Regulated under Cryptographic Architecture Protocols.</p>
    </footer>

</body>
</html>

<?php
/**
 * Custom Utility styling function to calculate navigation border classes based on GET states
 * Explicitly type-hinted to completely resolve Intelephense strict P1132 requirements.
 */
function border_color_fn(string $current_loop_cat, string $active_state_cat): string {
    if (strcasecmp($current_loop_cat, $active_state_cat) === 0) {
        return "bg-neutral-900 text-white border-neutral-900";
    }
    return "bg-white text-neutral-500 border-neutral-200 hover:border-neutral-400 hover:text-black";
}