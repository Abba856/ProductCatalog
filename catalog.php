<?php
/**
 * Product Catalog Application
 * Demonstrates PHP arrays, forms, GET requests, and pagination
 */

// Product data - array of products with details
function getProducts() {
    return [
        [
            'id' => 1,
            'name' => 'Laptop Pro',
            'description' => 'High-performance laptop for professionals',
            'price' => 1299.99,
            'category' => 'Electronics'
        ],
        [
            'id' => 2,
            'name' => 'Wireless Headphones',
            'description' => 'Noise-cancelling wireless headphones with premium sound',
            'price' => 199.99,
            'category' => 'Electronics'
        ],
        [
            'id' => 3,
            'name' => 'Coffee Maker',
            'description' => 'Automatic coffee maker with programmable features',
            'price' => 89.99,
            'category' => 'Home Appliances'
        ],
        [
            'id' => 4,
            'name' => 'Desk Lamp',
            'description' => 'LED desk lamp with adjustable brightness',
            'price' => 39.99,
            'category' => 'Home'
        ],
        [
            'id' => 5,
            'name' => 'Fitness Tracker',
            'description' => 'Water-resistant fitness tracker with heart rate monitor',
            'price' => 79.99,
            'category' => 'Wearables'
        ],
        [
            'id' => 6,
            'name' => 'Bluetooth Speaker',
            'description' => 'Portable speaker with 360-degree sound',
            'price' => 129.99,
            'category' => 'Electronics'
        ],
        [
            'id' => 7,
            'name' => 'Book Shelf',
            'description' => '5-tier wooden bookshelf for home or office',
            'price' => 149.99,
            'category' => 'Furniture'
        ],
        [
            'id' => 8,
            'name' => 'Gaming Mouse',
            'description' => 'Ergonomic gaming mouse with customizable buttons',
            'price' => 59.99,
            'category' => 'Electronics'
        ],
        [
            'id' => 9,
            'name' => 'Yoga Mat',
            'description' => 'Non-slip eco-friendly yoga mat',
            'price' => 29.99,
            'category' => 'Fitness'
        ],
        [
            'id' => 10,
            'name' => 'Backpack',
            'description' => 'Water-resistant backpack with laptop compartment',
            'price' => 49.99,
            'category' => 'Accessories'
        ],
        [
            'id' => 11,
            'name' => 'Smart Watch',
            'description' => 'Feature-rich smartwatch with health monitoring',
            'price' => 249.99,
            'category' => 'Wearables'
        ],
        [
            'id' => 12,
            'name' => 'Tablet',
            'description' => 'Slim tablet with high-resolution display',
            'price' => 399.99,
            'category' => 'Electronics'
        ],
        [
            'id' => 13,
            'name' => 'Desk Chair',
            'description' => 'Ergonomic office chair with lumbar support',
            'price' => 199.99,
            'category' => 'Furniture'
        ],
        [
            'id' => 14,
            'name' => 'Water Bottle',
            'description' => 'Insulated stainless steel water bottle',
            'price' => 24.99,
            'category' => 'Accessories'
        ],
        [
            'id' => 15,
            'name' => 'Digital Camera',
            'description' => 'Compact digital camera with 4K video recording',
            'price' => 599.99,
            'category' => 'Electronics'
        ]
    ];
}

// Filter products based on search term
function filterProducts($products, $searchTerm) {
    if (empty($searchTerm)) {
        return $products;
    }
    
    return array_filter($products, function($product) use ($searchTerm) {
        return stripos($product['name'], $searchTerm) !== false || 
               stripos($product['description'], $searchTerm) !== false ||
               stripos($product['category'], $searchTerm) !== false;
    });
}

// Get products for a specific page
function getProductsForPage($products, $page, $itemsPerPage) {
    $totalItems = count($products);
    $totalPages = ceil($totalItems / $itemsPerPage);
    
    // Validate page number
    if ($page < 1) $page = 1;
    if ($page > $totalPages) $page = $totalPages;
    
    $offset = ($page - 1) * $itemsPerPage;
    return array_slice($products, $offset, $itemsPerPage);
}

// Main application logic
$products = getProducts();
$itemsPerPage = 5;

// Get search term and current page from GET parameters
$searchTerm = isset($_GET['search']) ? trim($_GET['search']) : '';
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Filter products based on search
$filteredProducts = filterProducts($products, $searchTerm);

// Paginate the results
$totalItems = count($filteredProducts);
$totalPages = ceil($totalItems / $itemsPerPage);
$productsToShow = getProductsForPage($filteredProducts, $currentPage, $itemsPerPage);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Catalog</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Product Catalog</h1>
            <p>Browse our collection of quality products</p>
        </div>

        <!-- Search Form -->
        <form method="GET" class="search-form">
            <input type="text" name="search" placeholder="Search products..." value="<?php echo htmlspecialchars($searchTerm); ?>">
            <input type="submit" value="Search">
        </form>

        <!-- Results Info -->
        <div class="results-info">
            <?php if (!empty($searchTerm)): ?>
                <p>Found <?php echo $totalItems; ?> result(s) for "<?php echo htmlspecialchars($searchTerm); ?>"</p>
            <?php else: ?>
                <p>Showing all <?php echo $totalItems; ?> products</p>
            <?php endif; ?>
        </div>

        <!-- Product Grid -->
        <?php if (count($productsToShow) > 0): ?>
            <div class="product-grid">
                <?php foreach ($productsToShow as $product): ?>
                    <div class="product-card">
                        <div class="product-name"><?php echo htmlspecialchars($product['name']); ?></div>
                        <div class="product-description"><?php echo htmlspecialchars($product['description']); ?></div>
                        <div class="product-category"><?php echo htmlspecialchars($product['category']); ?></div>
                        <div class="product-price">N<?php echo number_format($product['price'], 2); ?></div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="no-results">
                <p>No products found matching your search criteria.</p>
            </div>
        <?php endif; ?>

        <!-- Pagination -->
        <?php if ($totalPages > 1): ?>
            <div class="pagination">
                <!-- Previous button -->
                <?php if ($currentPage > 1): ?>
                    <a href="?page=<?php echo $currentPage - 1; ?><?php if (!empty($searchTerm)) echo '&search=' . urlencode($searchTerm); ?>">&laquo; Previous</a>
                <?php else: ?>
                    <span class="disabled">&laquo; Previous</span>
                <?php endif; ?>

                <!-- Page numbers -->
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <?php if ($i == $currentPage): ?>
                        <span class="current"><?php echo $i; ?></span>
                    <?php else: ?>
                        <a href="?page=<?php echo $i; ?><?php if (!empty($searchTerm)) echo '&search=' . urlencode($searchTerm); ?>"><?php echo $i; ?></a>
                    <?php endif; ?>
                <?php endfor; ?>

                <!-- Next button -->
                <?php if ($currentPage < $totalPages): ?>
                    <a href="?page=<?php echo $currentPage + 1; ?><?php if (!empty($searchTerm)) echo '&search=' . urlencode($searchTerm); ?>">Next &raquo;</a>
                <?php else: ?>
                    <span class="disabled">Next &raquo;</span>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>