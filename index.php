<?php
// Start a session
session_start();

// Include the database connection file using the correct relative path
require_once 'duromart-php/db.php';

// Prepare and execute the SQL query to fetch branch names from the 'branch' table
$sql = "SELECT name FROM branch";
$result = $conn->query($sql);

$branches = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $branches[] = $row['name'];
    }
}
$conn->close();

// Check for and clear any login error messages
$login_error = '';
if (isset($_SESSION['login_error'])) {
    $login_error = $_SESSION['login_error'];
    unset($_SESSION['login_error']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DuroPOS 2024 Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Custom styles for the dropdown arrow, not possible with Tailwind */
        select {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            background-size: 1.5em 1.5em;
        }
    </style>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen p-4">
    <div class="w-full max-w-sm bg-white border border-gray-300 rounded-lg shadow-xl overflow-hidden">
        <div class="flex items-center justify-between bg-blue-600 text-white p-2">
            <div class="flex items-center space-x-2">
                <div class="w-4 h-4 bg-white rounded-sm"></div>
                <h1 class="text-base font-bold">DuroPOS 2024 Login...</h1>
            </div>
            <button class="text-white hover:text-gray-200">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
            </button>
        </div>

        <form class="p-4 grid grid-cols-2 gap-4" action="login_process.php" method="post">
            <?php if ($login_error): ?>
                <div class="col-span-2 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline"><?php echo htmlspecialchars($login_error); ?></span>
                </div>
            <?php endif; ?>

            <div class="col-span-2 md:col-span-1 space-y-4">
                <div>
                    <label for="user" class="block text-sm font-medium text-gray-700">User</label>
                    <input type="text" id="user" name="username" placeholder="" required
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>
                <div class="flex items-center space-x-2">
                    <input type="checkbox" id="remember" name="remember" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                    <label for="remember" class="text-sm font-medium text-gray-700">Remember me...</label>
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" id="password" name="password" placeholder="" required
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>
                <div>
                    <label for="department" class="block text-sm font-medium text-gray-700">Department/Branch</label>
                    <div class="relative">
                        <select id="department" name="department"
                                class="mt-1 block w-full pl-3 pr-10 py-2 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            <?php
                            if (!empty($branches)) {
                                foreach ($branches as $branch_name) {
                                    echo "<option value=\"$branch_name\">" . htmlspecialchars($branch_name) . "</option>";
                                }
                            } else {
                                echo "<option value=\"\">No branches found</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <button type="button" class="flex items-center text-sm text-gray-500 hover:text-blue-600 space-x-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-lock"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                    <span>Change Password</span>
                </button>
            </div>

            <div class="col-span-2 md:col-span-1 flex flex-col justify-between items-center md:items-start space-y-4">
                <div class="flex flex-col space-y-2 w-full">
                    <button type="submit" class="w-full py-2 px-4 bg-gray-200 hover:bg-gray-300 rounded-lg border border-gray-400 text-gray-700 font-bold shadow-sm">
                        Login
                    </button>
                    <button type="button" class="w-full py-2 px-4 bg-gray-200 hover:bg-gray-300 rounded-lg border border-gray-400 text-gray-700 font-bold shadow-sm">
                        Quit
                    </button>
                </div>
                <div class="mt-4 md:mt-0 w-full flex justify-center md:justify-end">
                    <img src="https://placehold.co/150x50/ffffff/000000?text=DURO+ICT" alt="Company Logo" class="rounded-lg shadow-sm">
                </div>
            </div>
        </form>

        <div class="flex items-center justify-between p-2 text-xs text-gray-500 border-t border-gray-200">
            <div class="flex flex-col">
                <span>Licence Validity : Unlimited</span>
                <span class="font-bold">GLOBAL MAKE TRADERS LTD</span>
            </div>
            <span class="text-right">Connection Settings</span>
        </div>
    </div>
</body>
</html>