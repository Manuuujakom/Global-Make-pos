<?php
/**
 * welcome.php
 *
 * This is the main dashboard page for the DuroPOS system.
 * It contains the main navigation headers and a placeholder for content.
 *
 * It checks for an active session to ensure the user is logged in.
 * If no session is found, the user is redirected to the login page.
 */

// Start a new session or resume the existing one.
session_start();

// Check if the user is logged in.
// If not, redirect them to the login page.
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: index.php");
    exit;
}

// Get the username and department from the session to display on the page.
$username = $_SESSION['username'] ?? 'User';
$department = $_SESSION['department'] ?? 'Department';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DuroPOS Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Custom styles for the nav items */
        .nav-link {
            transition: all 0.2s ease-in-out;
            position: relative;
        }

        .nav-link:hover {
            color: #ffffff;
            background-color: #3b82f6; /* bg-blue-500 */
        }
        
        /* Underline effect on hover */
        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            display: block;
            margin-top: 5px;
            right: 0;
            background: #ffffff;
            transition: width 0.4s ease;
            -webkit-transition: width 0.4s ease;
        }

        .nav-link:hover::after {
            width: 100%;
            left: 0;
            background: #ffffff;
        }

        /* Custom styles for the draggable popup */
        .draggable-popup {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1000; /* Ensure it's on top of other content */
            max-width: 90%;
            max-height: 90vh;
            overflow: auto;
            cursor: move; /* Change cursor to indicate it's draggable */
        }

        .no-drag {
            cursor: auto; /* Revert cursor for non-draggable elements inside the popup */
        }
    </style>
</head>
<body class="bg-gray-100 font-sans">
    <div class="flex flex-col min-h-screen">
        <div class="w-full bg-white text-right p-2 shadow-md">
            <a href="welcome.php" class="inline-block text-sm px-4 py-2 leading-none border rounded text-white bg-red-500 border-transparent hover:bg-red-600 transition-colors duration-200">Back</a>
            <a href="logout.php" class="inline-block text-sm px-4 py-2 leading-none border rounded text-white bg-red-500 border-transparent hover:bg-red-600 transition-colors duration-200">Logout</a>
        </div>

        <header class="bg-blue-600 shadow-md">
            <nav class="flex items-center justify-between p-4 flex-wrap">
                <div class="flex items-center flex-shrink-0 text-white mr-6">
                    <span class="font-bold text-xl tracking-tight">DuroPOS</span>
                </div>
                <div class="w-full flex-grow lg:flex lg:items-center lg:w-auto mt-2 lg:mt-0">
                    <div class="text-sm lg:flex-grow">
                        <a href="#" class="nav-link block mt-4 lg:inline-block lg:mt-0 text-white hover:text-white mr-4 p-2 rounded-md font-medium">View</a>
                        <a href="#" class="nav-link block mt-4 lg:inline-block lg:mt-0 text-white hover:text-white mr-4 p-2 rounded-md font-medium">Admin</a>
                        <a href="#" class="nav-link block mt-4 lg:inline-block lg:mt-0 text-white hover:text-white mr-4 p-2 rounded-md font-medium">Reports</a>
                        <a href="#" class="nav-link block mt-4 lg:inline-block lg:mt-0 text-white hover:text-white mr-4 p-2 rounded-md font-medium">Masters</a>
                        <a href="#" class="nav-link block mt-4 lg:inline-block lg:mt-0 text-white hover:text-white mr-4 p-2 rounded-md font-medium">Stores</a>
                        <a href="#" class="nav-link block mt-4 lg:inline-block lg:mt-0 text-white hover:text-white mr-4 p-2 rounded-md font-medium">Accounts</a>
                        <a href="#" class="nav-link block mt-4 lg:inline-block lg:mt-0 text-white hover:text-white mr-4 p-2 rounded-md font-medium">HRM</a>
                        <a href="#" class="nav-link block mt-4 lg:inline-block lg:mt-0 text-white hover:text-white mr-4 p-2 rounded-md font-medium">Tools</a>
                        <a href="#" class="nav-link block mt-4 lg:inline-block lg:mt-0 text-white hover:text-white mr-4 p-2 rounded-md font-medium">Help</a>
                        <a href="#" class="nav-link block mt-4 lg:inline-block lg:mt-0 text-white hover:text-white mr-4 p-2 rounded-md font-medium">Drawer Reconciliation</a>
                    </div>
                </div>
                <div class="text-sm flex items-center space-x-2 mt-4 lg:mt-0">
                    <span class="text-white">Welcome, <?php echo htmlspecialchars($username); ?>!</span>
                    <a href="#" class="inline-block text-sm px-4 py-2 leading-none border rounded text-blue-600 border-white bg-blue-100 hover:border-transparent hover:text-blue-500 hover:bg-white transition-colors duration-200 font-extrabold shadow-md transform hover:scale-105" onclick="openPosForm(); return false;">POS</a>
                    <a href="#" class="inline-block text-sm px-4 py-2 leading-none border rounded text-white border-white hover:border-transparent hover:text-blue-500 hover:bg-white transition-colors duration-200">Find Record</a>
                </div>
            </nav>
        </header>

        <main class="flex-grow p-6">
            <div class="container mx-auto">
                </div>
        </main>

        <footer class="bg-gray-800 text-white p-4 text-center text-sm">
            &copy; 2024 Global Make Traders LTD. All rights reserved.
        </footer>
    </div>

    <script>
        /**
         * Dynamically creates a new draggable popup with content from 'pos-form.html'.
         * Each click on the POS button will create a new, independent popup.
         */
        function openPosForm() {
            // Generate a unique ID for the new popup to allow for multiple instances
            const popupId = `pos-popup-${Date.now()}`;
            const popup = document.createElement('div');
            popup.id = popupId;
            popup.classList.add(
                'draggable-popup',
                'bg-white',
                'p-6',
                'rounded-xl',
                'shadow-2xl',
                'w-full',
                'max-w-xl',
                'border-4',
                'border-blue-500',
                'flex',
                'flex-col'
            );

            // Create a handle for dragging and a close button
            const header = document.createElement('div');
            header.classList.add('flex', 'justify-between', 'items-center', 'mb-4', 'p-2', 'bg-blue-600', 'text-white', 'rounded-lg', 'shadow-md');
            header.innerHTML = `
                <h3 class="text-lg font-bold">POS Form</h3>
                <button class="close-button text-white font-bold p-1 rounded-full hover:bg-blue-700 transition-colors duration-200 no-drag" onclick="document.getElementById('${popupId}').remove();">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            `;

            // Create the content container for the form
            const content = document.createElement('div');
            content.classList.add('no-drag', 'overflow-y-auto', 'p-4', 'bg-gray-50', 'rounded-b-lg');
            content.innerHTML = '<p class="text-center text-gray-500">Loading form...</p>'; // Loading message

            // Append header and content to the popup
            popup.appendChild(header);
            popup.appendChild(content);
            document.body.appendChild(popup);

            // Fetch the content of the form and inject it into the popup
            fetch('/workspaces/GlobalMakers/assets/pos-form.html')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Failed to fetch POS form');
                    }
                    return response.text();
                })
                .then(html => {
                    content.innerHTML = html;
                })
                .catch(error => {
                    console.error('Error loading POS form:', error);
                    content.innerHTML = `<p class="text-red-500">Error: Could not load the form. Check the console for details.</p>`;
                });

            // Draggable logic for the popup
            let isDragging = false;
            let currentX;
            let currentY;
            let initialX;
            let initialY;
            let xOffset = 0;
            let yOffset = 0;

            const dragStart = (e) => {
                // Only start dragging if the event is on the header, not the content
                if (e.target === header || header.contains(e.target)) {
                    isDragging = true;
                    // Get initial position relative to the cursor
                    initialX = e.clientX - xOffset;
                    initialY = e.clientY - yOffset;
                }
            };

            const drag = (e) => {
                if (isDragging) {
                    e.preventDefault();
                    currentX = e.clientX - initialX;
                    currentY = e.clientY - initialY;
                    xOffset = currentX;
                    yOffset = currentY;

                    // Apply the translation to the popup element
                    setTranslate(currentX, currentY, popup);
                }
            };

            const dragEnd = (e) => {
                initialX = currentX;
                initialY = currentY;
                isDragging = false;
            };

            const setTranslate = (xPos, yPos, el) => {
                el.style.transform = `translate3d(${xPos}px, ${yPos}px, 0)`;
            };

            header.addEventListener("mousedown", dragStart, false);
            window.addEventListener("mouseup", dragEnd, false);
            window.addEventListener("mousemove", drag, false);
        }
    </script>
</body>
</html>