# PHP Product Catalog with Search and Pagination

This is a simple PHP application that demonstrates a product catalog with search functionality and pagination.

## Features

1. **Product Storage**: Products are stored in a PHP array with details like name, description, price, and category.
2. **Search Functionality**: Users can search for products by name, description, or category using the search bar.
3. **Dynamic Results Display**: Search results are displayed dynamically based on user input.
4. **Pagination**: For better user experience, results are paginated (5 items per page).

## How It Works

- The application uses a PHP array to store product information.
- When a user submits a search query via GET request, the application filters the products array.
- The filtered results are then paginated using PHP's array functions.
- The front-end uses HTML and CSS for presentation with a responsive grid layout.

## Concepts Demonstrated

- **Arrays**: Product data is stored and manipulated using PHP arrays.
- **Forms**: A search form is used to capture user input.
- **GET Requests**: Search parameters are passed via URL query parameters.
- **Pagination**: Custom pagination implementation to handle large datasets.

## How to Run

1. Place the `index.php` file in your web server directory.
2. Start your web server (Apache, Nginx, etc.).
3. Access the application through your browser (e.g., `http://localhost/index.php`).

## File Structure

- `index.php`: Main application file containing all functionality.
- `README.md`: This documentation file.

## Implementation Details

### Search Functionality
The search feature uses PHP's `array_filter()` function to filter products based on the search term. The search checks the product name, description, and category using case-insensitive matching.

### Pagination
Pagination is implemented by:
1. Calculating the total number of items and pages
2. Determining the current page from the URL parameter
3. Using `array_slice()` to extract only the items for the current page

### Security
The application uses `htmlspecialchars()` to prevent XSS attacks when displaying user input and search results.

## Customization

You can customize the application by:
1. Adding more products to the `$products` array
2. Modifying the styling in the CSS section
3. Changing the number of items per page by modifying the `$itemsPerPage` variable