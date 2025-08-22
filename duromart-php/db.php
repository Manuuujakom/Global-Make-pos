<?php
/**
 * db.php
 *
 * This file establishes a connection to the Supabase PostgreSQL database.
 * It is intended to be included at the beginning of any script
 * that needs to interact with the database.
 */

// Database connection URL from Supabase
$DATABASE_URL = "postgresql://postgres:[Tx*#ep?kt89pNbu]@db.sgurgsblrlridrowcypr.supabase.co:5432/postgres";

// Parse DATABASE_URL into components
$parsed_url = parse_url($DATABASE_URL);

$host = $parsed_url["host"];
$port = $parsed_url["port"];
$user = $parsed_url["user"];
$pass = $parsed_url["pass"];
$dbname = ltrim($parsed_url["path"], "/");

try {
    // Create a PDO connection
    $conn = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $pass);

    // Set error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Set character encoding
    $conn->exec("SET NAMES 'utf8'");

    // echo "✅ Connected to Supabase successfully!"; // Uncomment for debugging
} catch (PDOException $e) {
    die("❌ ERROR: Could not connect. " . $e->getMessage());
}
?>
