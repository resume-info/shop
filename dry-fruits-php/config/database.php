<?php
// Get environment configurations
$env = require_once __DIR__ . '/env.php';

// MongoDB Atlas configuration
$mongoDBConfig = [
    'uri' => $env['mongodb_uri'],
    'database' => $env['mongodb_database'],
    'options' => [
        'connectTimeoutMS' => 10000,
        'retryWrites' => true
    ]
];

// Function to get MongoDB connection
function getMongoDBConnection() {
    global $mongoDBConfig;
    
    try {
        // Create a MongoDB client
        $client = new MongoDB\Client($mongoDBConfig['uri'], $mongoDBConfig['options']);
        
        // Select the database
        $db = $client->selectDatabase($mongoDBConfig['database']);
        
        return $db;
    } catch (Exception $e) {
        error_log('MongoDB Connection Error: ' . $e->getMessage());
        die("Database connection failed: " . $e->getMessage());
    }
} 