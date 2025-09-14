# PHP Project Catalog - Key Concepts

This project demonstrates several important PHP concepts:

## 1. Arrays

Arrays are used extensively in this application:

```php
// Indexed array of products
$products = [
    [
        'id' => 1,
        'name' => 'Laptop Pro',
        'description' => 'High-performance laptop for professionals',
        'price' => 1299.99,
        'category' => 'Electronics'
    ],
    // ... more products
];

// Using array functions
$filteredProducts = array_filter($products, function($product) use ($searchTerm) {
    return stripos($product['name'], $searchTerm) !== false;
});

$productsToShow = array_slice($filteredProducts, $offset, $itemsPerPage);
```

## 2. Forms and GET Requests

The search form uses the GET method to pass parameters:

```html
<form method="GET" class="search-form">
    <input type="text" name="search" placeholder="Search products..." value="<?php echo htmlspecialchars($searchTerm); ?>">
    <input type="submit" value="Search">
</form>
```

PHP accesses these values using the $_GET superglobal:

```php
$searchTerm = isset($_GET['search']) ? trim($_GET['search']) : '';
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
```

## 3. Pagination Implementation

Pagination is implemented using array functions:

```php
// Calculate pagination values
$totalItems = count($filteredProducts);
$totalPages = ceil($totalItems / $itemsPerPage);
$offset = ($currentPage - 1) * $itemsPerPage;

// Get products for current page
$productsToShow = array_slice($filteredProducts, $offset, $itemsPerPage);
```

## 4. Security Considerations

The application uses `htmlspecialchars()` to prevent XSS attacks:

```php
value="<?php echo htmlspecialchars($searchTerm); ?>"

<?php echo htmlspecialchars($product['name']); ?>
```

## 5. Functions for Code Organization

Custom functions help organize the code:

```php
function getProducts() { ... }
function filterProducts($products, $searchTerm) { ... }
function getProductsForPage($products, $page, $itemsPerPage) { ... }
```

## 6. Conditional Display

PHP conditional statements control what is displayed:

```php
<?php if (count($productsToShow) > 0): ?>
    <div class="product-grid">
        <!-- Products here -->
    </div>
<?php else: ?>
    <div class="no-results">
        <p>No products found matching your search criteria.</p>
    </div>
<?php endif; ?>
```

## 7. URL Parameter Management

The pagination links maintain search parameters:

```php
<a href="?page=<?php echo $currentPage - 1; ?><?php if (!empty($searchTerm)) echo '&search=' . urlencode($searchTerm); ?>">
```

This ensures that when navigating between pages, the search query is preserved.

## Key PHP Functions Used

1. `array_filter()` - Filter products based on search criteria
2. `array_slice()` - Extract products for current page
3. `count()` - Count number of products
4. `ceil()` - Calculate total pages
5. `htmlspecialchars()` - Prevent XSS attacks
6. `stripos()` - Case-insensitive string search
7. `urlencode()` - Encode URL parameters
8. `number_format()` - Format prices
9. `isset()` - Check if variables are set
10. `trim()` - Remove whitespace from search term

This project provides a complete example of how to build a dynamic web application using core PHP concepts without requiring a database.