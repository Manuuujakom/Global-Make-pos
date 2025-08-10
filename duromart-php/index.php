<?php
// login.php

// Start a session to manage user login state.
session_start();

// Include the database configuration file.
require 'config.php';

$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and get user input from the form.
    $username = htmlspecialchars($_POST['user']);
    $password = $_POST['password']; // Password is not sanitized to allow password_verify() to work correctly.
    $department = htmlspecialchars($_POST['department']);

    // Create a new MySQLi connection using credentials from config.php
    $db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

    // Check for a connection error.
    if ($db->connect_error) {
        // Log the error and show a generic message to the user for security.
        $error_message = "Connection to the database failed. Please try again later.";
        error_log("Database connection failed: " . $db->connect_error);
    } else {
        // Use a prepared statement to prevent SQL injection.
        // We select the hashed password and department for the given username.
        $stmt = $db->prepare("SELECT password, department FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if a user was found.
        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();

            // Verify the submitted password against the stored hash.
            if (password_verify($password, $user['password']) && $user['department'] === $department) {
                // Successful login.
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $username;
                $_SESSION['department'] = $department;
                header('Location: success.php'); // Redirect to a success page
                exit();
            } else {
                $error_message = 'Invalid username, password, or department.';
            }
        } else {
            $error_message = 'Invalid username, password, or department.';
        }

        // Close the statement and connection.
        $stmt->close();
        $db->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DuroPOS 2024 Login</title>
    <!-- Tailwind CSS CDN for styling -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Use Inter font from Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #1a2731; /* Dark background to match the desktop app's window */
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen p-4">

    <div class="bg-gray-200 shadow-xl rounded-lg w-full max-w-lg p-6 md:p-8">
        <!-- Header mimicking a desktop window title bar -->
        <div class="flex justify-between items-center bg-gray-400 text-white rounded-t-lg -mx-6 -mt-6 px-6 py-2">
            <h1 class="text-sm font-semibold flex items-center">
                <img src="https://placehold.co/16x16/000000/FFFFFF?text=%20" alt="logo" class="mr-2 rounded">
                DuroPOS 2024 Login
            </h1>
            <!-- The close button 'X' -->
            <button class="text-white text-lg hover:text-red-500 transition-colors">
                &times;
            </button>
        </div>

        <form action="login.php" method="POST" class="mt-6 space-y-4">
            <?php if ($error_message): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded relative" role="alert">
                    <span class="block sm:inline"><?= htmlspecialchars($error_message) ?></span>
                </div>
            <?php endif; ?>

            <div>
                <label for="user" class="block text-sm font-medium text-gray-700">User</label>
                <input type="text" id="user" name="user" required
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2">
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" id="password" name="password" required
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2">
            </div>

            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input id="remember-me" name="remember-me" type="checkbox"
                           class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                    <label for="remember-me" class="ml-2 block text-sm text-gray-900">
                        Remember me...
                    </label>
                </div>
                <a href="#" class="flex items-center text-sm text-gray-600 hover:text-gray-900">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 3.75h1.5a1.5 1.5 0 001.5-1.5V13.5a1.5 1.5 0 00-1.5-1.5H7.5a1.5 1.5 0 00-1.5 1.5v2.25c0 .828.672 1.5 1.5 1.5h1.5zm6-6h-1.5a1.5 1.5 0 00-1.5 1.5v2.25c0 .828.672 1.5 1.5 1.5h1.5a1.5 1.5 0 001.5-1.5V13.5a1.5 1.5 0 00-1.5-1.5z" />
                    </svg>
                    Change Password
                </a>
            </div>

            <div>
                <label for="department" class="block text-sm font-medium text-gray-700">Department/Branch</label>
                <select id="department" name="department"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2">
                    <option value="main">Main Branch</option>
                    <option value="warehouse">Warehouse</option>
                    <option value="sales">Sales</option>
                </select>
            </div>

            <div class="flex space-x-4">
                <button type="submit"
                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:w-auto sm:text-sm">
                    Login
                </button>
                <a href="#"
                   class="w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:w-auto sm:text-sm">
                    Quit
                </a>
            </div>

            <div class="mt-8 pt-4 border-t border-gray-300 text-xs text-gray-500 flex justify-between items-end">
                <div>
                    <p class="text-green-600 font-semibold">Licence Validity : Unlimited</p>
                    <p>GLOBAL MAKE TRADERS LTD</p>
                </div>
                <div class="text-right">
                    <!-- Placeholder for the DURO logo -->
                    <img src="https://placehold.co/120x40/000000/FFFFFF?text=DURO+LOGO" alt="Duro logo" class="mb-1 rounded">
                    <p>Connection Settings</p>
                </div>
            </div>
        </form>
    </div>

</body>
</html>
