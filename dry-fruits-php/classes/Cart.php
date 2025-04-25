<?php
namespace App;

class Cart {
    private $db;
    
    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        // Initialize cart if it doesn't exist
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
    }
    
    public function getItems() {
        return $_SESSION['cart'];
    }
    
    public function addItem($productId, $quantity = 1, $productData = null) {
        $productId = (string) $productId;
        
        // If product data is not provided, fetch it
        if ($productData === null) {
            $product = (new Product())->getProductById($productId);
            
            if (!$product) {
                return false;
            }
            
            $productData = [
                'id' => (string) $product->_id,
                'name' => $product->name,
                'price' => $product->price,
                'image' => $product->image
            ];
        }
        
        // Check if product already exists in cart
        $found = false;
        
        foreach ($_SESSION['cart'] as &$item) {
            if ($item['id'] === $productId) {
                $item['quantity'] += $quantity;
                $found = true;
                break;
            }
        }
        
        // Add new item if not found
        if (!$found) {
            $_SESSION['cart'][] = [
                'id' => $productId,
                'name' => $productData['name'],
                'price' => $productData['price'],
                'image' => $productData['image'],
                'quantity' => $quantity
            ];
        }
        
        return true;
    }
    
    public function updateItem($productId, $quantity) {
        $productId = (string) $productId;
        
        foreach ($_SESSION['cart'] as &$item) {
            if ($item['id'] === $productId) {
                if ($quantity <= 0) {
                    return $this->removeItem($productId);
                }
                
                $item['quantity'] = $quantity;
                return true;
            }
        }
        
        return false;
    }
    
    public function removeItem($productId) {
        $productId = (string) $productId;
        
        foreach ($_SESSION['cart'] as $key => $item) {
            if ($item['id'] === $productId) {
                unset($_SESSION['cart'][$key]);
                $_SESSION['cart'] = array_values($_SESSION['cart']); // Re-index array
                return true;
            }
        }
        
        return false;
    }
    
    public function clear() {
        $_SESSION['cart'] = [];
        return true;
    }
    
    public function getTotal() {
        $total = 0;
        
        foreach ($_SESSION['cart'] as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        
        return $total;
    }
    
    public function getTotalItems() {
        $count = 0;
        
        foreach ($_SESSION['cart'] as $item) {
            $count += $item['quantity'];
        }
        
        return $count;
    }
    
    public function hasItems() {
        return count($_SESSION['cart']) > 0;
    }
} 