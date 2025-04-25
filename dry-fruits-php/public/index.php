<?php
// Bootstrap application
require_once __DIR__ . '/../config/autoload.php';

// Start session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Get environment variables
$env = require_once __DIR__ . '/../config/env.php';

// Record site visit
$analytics = new App\Analytics();
$analytics->recordVisit();

// Parse URL
$request_uri = $_SERVER['REQUEST_URI'];
$path = parse_url($request_uri, PHP_URL_PATH);
$path = trim($path, '/');

// Default route
if (empty($path)) {
    $path = 'home';
}

// Check if file exists
$templateFile = __DIR__ . '/../templates/' . $path . '.php';

// If template doesn't exist, try handling as product or category
if (!file_exists($templateFile)) {
    // Check if it's a product page
    if (preg_match('/^product\/([a-zA-Z0-9]+)$/', $path, $matches)) {
        $productId = $matches[1];
        $_GET['id'] = $productId;
        $templateFile = __DIR__ . '/../templates/product.php';
        
        // Record product view
        $analytics->recordProductView($productId);
    } 
    // Check if it's a category page
    elseif (preg_match('/^category\/([a-zA-Z0-9-]+)$/', $path, $matches)) {
        $category = $matches[1];
        $_GET['category'] = $category;
        $templateFile = __DIR__ . '/../templates/category.php';
    }
    // Otherwise, it's a 404
    else {
        http_response_code(404);
        $templateFile = __DIR__ . '/../templates/404.php';
    }
}

// Include template file
include __DIR__ . '/../templates/header.php';
include $templateFile;
include __DIR__ . '/../templates/footer.php'; 