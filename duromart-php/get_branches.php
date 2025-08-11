<?php
/**
 * get_branches.php
 *
 * This script connects to the database, fetches all branch names
 * from the 'branches' table, and returns them as a JSON array.
 */

// Include the database connection file.
// Ensure 'db.php' is configured to connect to your database.
require_once 'db.php';

// Set the content type header to application/json.
header('Content-Type: application/json');

$branches = [];

try {
    // Prepare a SQL query to select all branch names.
    $sql = "SELECT name FROM branches ORDER BY name";

    if ($stmt = $conn->prepare($sql)) {
        // Execute the prepared statement.
        $stmt->execute();
        
        // Bind the result variables.
        $stmt->bind_result($branch_name);
        
        // Fetch all results and store them in the branches array.
        while ($stmt->fetch()) {
            $branches[] = ['name' => $branch_name];
        }

        // Close statement.
        $stmt->close();
    }
} catch (mysqli_sql_exception $e) {
    // In case of a database error, log it and return an empty array.
    error_log("Database error: " . $e->getMessage());
    // Optionally, you could return an error message to the client, but for a simple
    // dropdown list, an empty array is sufficient.
    $branches = [];
} finally {
    // Close the database connection.
    if ($conn) {
        $conn->close();
    }
}

// Encode the branches array to JSON and output it.
echo json_encode($branches);
?>
