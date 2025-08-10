<?php
// Start the session to access session variables.
session_start();

// Check if the user is NOT logged in.
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // If not logged in, redirect them to the login page.
    header('Location: index.php');
    exit;
}

// Get the user's name and department from the session.
$username = $_SESSION['username'] ?? 'User';
$department = $_SESSION['department'] ?? 'No Department';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - POS</title>
    <!-- Tailwind CSS CDN for styling -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex flex-col items-center justify-center min-h-screen p-4">
    <div class="p-8 bg-white border border-gray-300 rounded-lg shadow-xl text-center">
        <!-- Display the main "Hello POS" header -->
        <h1 class="text-3xl font-bold text-gray-800 mb-4">Hello POS</h1>

        <!-- Welcome message -->
        <p class="text-gray-600 text-lg mb-6">
            Welcome, <span class="font-semibold text-blue-600"><?php echo htmlspecialchars($username); ?></span>!
            You are logged in as part of the <span class="font-semibold"><?php echo htmlspecialchars($department); ?></span>.
        </p>

        <!-- Logout button -->
        <a href="logout.php" class="inline-block py-2 px-4 bg-red-500 hover:bg-red-600 text-white font-bold rounded-lg shadow-sm transition-colors duration-200">
            Logout
        </a>
    </div>
</body>
</html>
