<?php
// Database configuration for XAMPP default setup
define('DB_HOST', '127.0.0.1'); // Using IP instead of 'localhost' for better reliability
define('DB_USER', 'root');      // Default XAMPP username
define('DB_PASS', '');         // Default XAMPP password (empty)
define('DB_NAME', 'fileuploads'); // Your database name

// Create database connection with error handling
function getDBConnection() {
    try {
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        
        if ($conn->connect_error) {
            throw new Exception("Connection failed: " . $conn->connect_error . 
                              " [Error No: " . $conn->connect_errno . "]");
        }
        
        // Set charset to utf8mb4 for proper encoding
        $conn->set_charset("utf8mb4");
        
        return $conn;
    } catch (Exception $e) {
        // Log error to file for debugging
        error_log("[" . date('Y-m-d H:i:s') . "] Database Error: " . $e->getMessage() . "\n", 3, "db_errors.log");
        die("Database connection error. Please try again later.");
    }
}
?>