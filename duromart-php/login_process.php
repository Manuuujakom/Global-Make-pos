<?php
/**
 * Updated login_process.php
 * This file now connects to the database and validates user credentials.
 */

// Start a new session or resume the existing one.
session_start();

// Include the database connection file.
// The "db.php" file must be in the same directory.
require_once 'db.php';

// Check if the form was submitted using the POST method.
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Retrieve the data from the form.
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $department = $_POST['department'] ?? '';

    // Prepare a SQL query to prevent SQL injection.
    // The '?' is a placeholder for the actual data.
    // This query looks for a matching username, password, and branch in the 'users' table.
    $sql = "SELECT username, branch FROM users WHERE username = ? AND password = ? AND branch = ?";

    if ($stmt = $conn->prepare($sql)) {
        // Bind parameters to the statement. 'sss' indicates three string parameters.
        $stmt->bind_param("sss", $param_username, $param_password, $param_department);

        // Set the parameters.
        $param_username = $username;
        $param_password = $password; 
        $param_department = $department;

        // Execute the prepared statement.
        if ($stmt->execute()) {
            // Store the result.
            $stmt->store_result();

            // Check if a row was returned. A row count of 1 means a valid user was found.
            if ($stmt->num_rows == 1) {
                // If credentials are correct, set a session variable to indicate the user is logged in.
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $username;
                $_SESSION['department'] = $department;

                // Redirect the user to the welcome page.
                header('Location: welcome.php');
                exit;
            } else {
                // If no matching user was found, redirect back to the login page with an error.
                header('Location: index.php?error=invalid_credentials');
                exit;
            }
        } else {
            // Handle execution error.
            echo "Oops! Something went wrong. Please try again later.";
        }

        // Close statement.
        $stmt->close();
    }
} else {
    // If someone tries to access this page directly without submitting the form,
    // redirect them to the login page.
    header('Location: index.php');
    exit;
}

// Close the database connection.
$conn->close();

?>
