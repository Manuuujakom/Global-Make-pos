<?php
/**
 * Updated login_process.php
 *
 * This file now connects to the database and securely validates
 * user credentials using password hashing.
 */

// Start a new session or resume the existing one.
session_start();

// Include the database connection file.
require_once 'db.php';

// Check if the form was submitted using the POST method.
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Retrieve the data from the form.
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $department = $_POST['department'] ?? '';

    // Prepare a SQL query to select a user by username and branch.
    // The password is not included in the query for security reasons.
    $sql = "SELECT password, branch FROM users WHERE username = ? AND branch = ?";

    if ($stmt = $conn->prepare($sql)) {
        // Bind parameters to the statement. 'ss' indicates two string parameters.
        $stmt->bind_param("ss", $param_username, $param_department);

        // Set the parameters.
        $param_username = $username;
        $param_department = $department;

        // Execute the prepared statement.
        if ($stmt->execute()) {
            // Bind the result variables.
            $stmt->bind_result($hashed_password, $fetched_branch);
            
            // Fetch the result.
            if ($stmt->fetch()) {
                // Now, verify the submitted password against the stored hashed password.
                if (password_verify($password, $hashed_password)) {
                    // Password is correct, so set a session variable to indicate login.
                    $_SESSION['loggedin'] = true;
                    $_SESSION['username'] = $username;
                    $_SESSION['department'] = $department;

                    // Redirect the user to the welcome page.
                    header('Location: welcome.php');
                    exit;
                } else {
                    // If the password doesn't match, redirect to the login page with an error.
                    header('Location: index.php?error=invalid_credentials');
                    exit;
                }
            } else {
                // User not found, redirect back to the login page with an error.
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
