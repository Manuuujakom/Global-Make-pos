<?php
// Include the database connection file
require_once 'db.php';

// Prepare and execute the SQL query to fetch branch names
$sql = "SELECT name FROM branch";
$result = $conn->query($sql);

$branches = [];
if ($result->num_rows > 0) {
    // Fetch each row and add it to the branches array
    while($row = $result->fetch_assoc()) {
        $branches[] = $row;
    }
}

// Set the header to indicate a JSON response
header('Content-Type: application/json');

// Return the branches array as a JSON object
echo json_encode($branches);

// Close the database connection
$conn->close();
?>