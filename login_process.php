<?php
// Start a session
session_start();

// Include the database connection file
require_once 'duromart-php/db.php';

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Sanitize and get form data
    $username = $_POST['username'];
    $password = $_POST['password']; 
    $department = $_POST['department'];

    // Check if the user and password match a record in the database
    // The query now checks ONLY username and password
    $sql = "SELECT id, username FROM users WHERE username = ? AND password = ?";
    
    // Prepare the statement
    if ($stmt = $conn->prepare($sql)) {
        // Bind parameters (only username and password)
        $stmt->bind_param("ss", $username, $password);

        // Execute the statement
        $stmt->execute();

        // Store the result
        $stmt->store_result();

        // Check if a user was found
        if ($stmt->num_rows == 1) {
            // User found, login is successful
            $stmt->bind_result($user_id, $db_username);
            $stmt->fetch();

            // Set session variables
            $_SESSION['loggedin'] = true;
            $_SESSION['id'] = $user_id;
            $_SESSION['username'] = $db_username;
            $_SESSION['department'] = $department; // Store the selected department

            // Redirect to welcome page
            header("Location: welcome.php");
            exit;
        } else {
            // Login failed, redirect back to the login page with an error
            $_SESSION['login_error'] = "Invalid username or password.";
            header("Location: index.php");
            exit;
        }

        // Close the statement
        $stmt->close();
    }
}

// Close the database connection
$conn->close();

// If the form was not submitted or something went wrong, redirect to the login page
header("Location: index.php");
exit;
?>