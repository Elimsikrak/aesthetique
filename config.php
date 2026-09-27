<?php
// Database configuration
define('DB_HOST', '127.0.0.1');
define('DB_PORT', '3306');
define('DB_DATABASE', 'aesthetique');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', ''); // Empty password based on your setup

try {
    // Create the PDO connection string
    $dsn = "mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_DATABASE . ";charset=utf8mb4";
    
    // Set options for safety and error handling
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    // Establish the connection
    $pdo = new PDO($dsn, DB_USERNAME, DB_PASSWORD, $options);
    
    // Un-comment the line below just to test if it works, then delete/comment it out!
    // echo "Connected successfully to aesthetique!"; 

} catch (PDOException $e) {
    // If something goes wrong, stop execution and show the error
    die("Database connection failed: " . $e->getMessage());
}