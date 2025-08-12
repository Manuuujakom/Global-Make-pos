<?php
/**
 * Temporary login_process.php with hard-coded credentials for local development.
 * This file is for testing purposes and bypasses database validation.
 *
 * Use username: 123
 * Use password: 123
 */

// Start a new session or resume the existing one.
session_start();

// NOTE: For local development, we are bypassing the database connection.
// require_once 'db.php';

// Check if the form was submitted using the POST method.
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Retrieve the data from the form.
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $department = $_POST['department'] ?? '';

    // --- Hard-coded credentials for temporary login ---
    // Define the temporary username and password for local testing.
    $hardcoded_username = '123';
    $hardcoded_password = '123';
    // You can set a hardcoded department as well if needed, or just let it pass.
    $hardcoded_department = 'Global Make Traders LTD';

    // Validate the submitted credentials against the hard-coded ones.
    if ($username === $hardcoded_username && $password === $hardcoded_password) {
        
        // If credentials match, set session variables and redirect to the welcome page.
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['department'] = $department;

        header('Location: welcome.php');
        exit;
    } else {
        // If credentials don't match, redirect back to the login page with an error.
        header('Location: index.php?error=invalid_credentials');
        exit;
    }

} else {
    // If someone tries to access this page directly without submitting the form,
    // redirect them to the login page.
    header('Location: index.php');
    exit;
}
?>
