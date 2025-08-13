<?php
/**
 * db.php
 *
 * This file establishes a connection to the MySQL database.
 * It is intended to be included at the beginning of any script
 * that needs to interact with the database.
 */

// Define database connection constants.
// You may need to change these values based on your local environment setup.
define('DB_SERVER', '127.0.0.1');
define('DB_USERNAME', 'root');   // Default username for local servers like XAMPP, WAMP, MAMP
define('DB_PASSWORD', '');      // Default password is often empty
define('DB_NAME', 'duromart_database');    // The database name you specified

// Attempt to connect to the database.
$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check the connection.
// If the connection fails, terminate the script and display an error message.
if ($conn->connect_error) {
    die("ERROR: Could not connect. " . $conn->connect_error);
}

// Set character set to UTF-8. This is good practice.
$conn->set_charset("utf8mb4");

?>
