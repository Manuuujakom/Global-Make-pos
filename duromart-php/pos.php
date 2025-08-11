<?php
/**
 * Global Market Traders LTD POS Home Screen
 *
 * This file contains the main structure and a placeholder for a Point of Sale (POS) system.
 * It uses a combination of PHP, HTML, and JavaScript with Tailwind CSS for styling.
 * The PHP syntax has been updated to switch between PHP and HTML blocks for better readability.
 * The script must be served by a PHP-enabled web server to function correctly.
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GTM POS Home</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        // Tailwind CSS configuration
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        primary: '#1D4ED8',
                        secondary: '#4B5563',
                        accent: '#F59E0B',
                        background: '#F9FAFB',
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #F9FAFB;
        }
        .card {
            background-color: white;
            border-radius: 0.75rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            padding: 1.5rem;
        }
        .btn {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 600;
            transition: all 0.2s ease-in-out;
            cursor: pointer;
        }
        .btn-primary {
            background-color: #1D4ED8;
            color: white;
        }
        .btn-primary:hover {
            background-color: #1E40AF;
        }
        .btn-secondary {
            background-color: #E5E7EB;
            color: #4B5563;
        }
        .btn-secondary:hover {
            background-color: #D1D5DB;
        }
        .dropdown-menu {
            position: absolute;
            top: 100%;
            right: 0;
            background-color: white;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            min-width: 150px;
            z-index: 10;
        }
        .dropdown-item {
            padding: 0.5rem 1rem;
            cursor: pointer;
        }
        .dropdown-item:hover {
            background-color: #F3F4F6;
        }
        /* New styles for the POS screen */
        .pos-container {
            display: none; /* Initially hidden */
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.95);
            z-index: 20;
            backdrop-filter: blur(5px);
            padding: 2rem;
            box-sizing: border-box;
            overflow-y: auto;
        }
        /* Styles for the POS menu bar */
        .pos-menu-bar {
            background-color: #ffffff;
            border-bottom: 1px solid #E5E7EB;
            display: flex;
            align-items: center;
            padding: 0.5rem 1rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        .pos-menu-button {
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
            font-weight: 500;
            color: #4B5563;
            cursor: pointer;
            border-radius: 0.375rem;
            transition: background-color 0.2s;
        }
        .pos-menu-button:hover {
            background-color: #F3F4F6;
        }
        .pos-menu-button.active {
            background-color: #E5E7EB;
            color: #1D4ED8;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="min-h-screen flex flex-col">
        <!-- Header -->
        <header class="bg-white shadow-sm p-4 flex justify-between items-center z-10">
            <div class="flex items-center space-x-4">
                <h1 class="text-xl font-bold text-gray-900">Global Market Traders LTD</h1>
                <!-- Branch Switcher -->
                <div class="relative">
                    <button id="branch-dropdown-btn" class="btn btn-secondary flex items-center space-x-2">
                        <span>Main Branch</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    <div id="branch-dropdown-menu" class="dropdown-menu hidden">
                        <div class="dropdown-item">Westlands Branch</div>
                        <div class="dropdown-item">Industrial Area Branch</div>
                        <div class="dropdown-item">CBD Branch</div>
                    </div>
                </div>
            </div>
            <div class="flex items-center space-x-4">
                <span class="text-gray-700">Hello, Admin User</span>
                <a href="#" class="btn btn-secondary">Logout</a>
            </div>
        </header>

        <!-- Main Content Area -->
        <main class="flex-1 p-6 lg:p-10 grid gap-6 lg:grid-cols-3 xl:grid-cols-4">

            <!-- Sidebar/Navigation -->
            <aside class="lg:col-span-1 xl:col-span-1 flex flex-col space-y-4">
                <div class="card p-6">
                    <h2 class="text-lg font-bold text-gray-900 mb-4">Modules</h2>
                    <nav class="flex flex-col space-y-2">
                        <!-- Dashboard button is now the primary active button -->
                        <button id="btn-dashboard" class="btn btn-primary w-full justify-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                            </svg>
                            Dashboard
                        </button>
                        <!-- Other buttons are now secondary -->
                        <button id="btn-pos-sales" class="btn btn-secondary w-full justify-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M4 4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2H4zm10 2a2 2 0 11-4 0 2 2 0 014 0zm-5 4a2 2 0 100 4 2 2 0 000-4z" />
                            </svg>
                            POS & Sales
                        </button>
                        <button class="btn btn-secondary w-full justify-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 011 1v12a1 1 0 01-1 1H4a1 1 0 01-1-1V4zm2 2v2h2V6H5zm4 0v2h2V6H9zm4 0v2h2V6h-2zM5 10v2h2v-2H5zm4 0v2h2v-2H9zm4 0v2h2v-2h-2zm-8 4v2h2v-2H5zm4 0v2h2v-2H9zm4 0v2h2v-2h-2z" clip-rule="evenodd" />
                            </svg>
                            Inventory
                        </button>
                        <button class="btn btn-secondary w-full justify-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                            </svg>
                            Reports
                        </button>
                        <button class="btn btn-secondary w-full justify-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                            </svg>
                            HR
                        </button>
                        <button class="btn btn-secondary w-full justify-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm-7-9a1 1 0 011-1h10a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM10 6a3 3 0 100 6 3 3 0 000-6z" clip-rule="evenodd" />
                                <path d="M5 8.75a1 1 0 112 0 1 1 0 01-2 0zM13 8.75a1 1 0 112 0 1 1 0 01-2 0z" />
                                <path fill-rule="evenodd" d="M10 12a1 1 0 000-2h.01a1 1 0 000 2H10z" clip-rule="evenodd" />
                            </svg>
                            Accounting
                        </button>
                    </nav>
                </div>
            </aside>

            <!-- Main Dashboard Panels -->
            <div id="dashboard-content" class="lg:col-span-2 xl:col-span-3 grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                <!-- Sales Today Summary -->
                <div class="card md:col-span-2 xl:col-span-1 flex flex-col">
                    <h2 class="text-lg font-bold text-gray-900 mb-4">Today's Sales Summary</h2>
                    <div class="flex-1 grid grid-cols-2 gap-4">
                        <div class="bg-gray-100 p-4 rounded-lg flex flex-col justify-center">
                            <p class="text-sm font-medium text-gray-500">Total Sales</p>
                            <p class="text-2xl font-bold text-primary">KSh 1,250,500</p>
                        </div>
                        <div class="bg-gray-100 p-4 rounded-lg flex flex-col justify-center">
                            <p class="text-sm font-medium text-gray-500">Transactions</p>
                            <p class="text-2xl font-bold text-secondary">258</p>
                        </div>
                        <div class="bg-gray-100 p-4 rounded-lg flex flex-col justify-center">
                            <p class="text-sm font-medium text-gray-500">Average Sale</p>
                            <p class="text-2xl font-bold text-secondary">KSh 4,846</p>
                        </div>
                        <div class="bg-gray-100 p-4 rounded-lg flex flex-col justify-center">
                            <p class="text-sm font-medium text-gray-500">Gross Profit</p>
                            <p class="text-2xl font-bold text-green-600">KSh 325,000</p>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="card xl:col-span-1">
                    <h2 class="text-lg font-bold text-gray-900 mb-4">Quick Actions</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <button class="btn btn-secondary">New Sale</button>
                        <button class="btn btn-secondary">Process Return</button>
                        <button class="btn btn-secondary">View Open Orders</button>
                        <button class="btn btn-secondary">Open Cash Drawer</button>
                    </div>
                </div>

                <!-- Low Stock Alerts -->
                <div class="card md:col-span-2 xl:col-span-1">
                    <h2 class="text-lg font-bold text-red-600 mb-4">Low Stock Alerts</h2>
                    <ul class="space-y-3">
                        <li class="flex items-center justify-between">
                            <span class="text-gray-700">Laptop Sleeve (13-inch)</span>
                            <span class="text-sm font-medium text-red-600">3 left</span>
                        </li>
                        <li class="flex items-center justify-between">
                            <span class="text-gray-700">Wireless Mouse M210</span>
                            <span class="text-sm font-medium text-red-600">8 left</span>
                        </li>
                        <li class="flex items-center justify-between">
                            <span class="text-gray-700">Thermal Printer Paper</span>
                            <span class="text-sm font-medium text-red-600">1 box left</span>
                        </li>
                    </ul>
                    <a href="#" class="mt-4 block text-center text-sm font-semibold text-primary hover:underline">View All Low Stock Items</a>
                </div>

                <!-- Daily Reports Snapshot -->
                <div class="card xl:col-span-2">
                    <h2 class="text-lg font-bold text-gray-900 mb-4">Daily Reports Snapshot</h2>
                    <div class="flex justify-between items-center mb-2">
                        <p class="text-sm font-medium text-gray-500">Best-Selling Product:</p>
                        <p class="text-gray-700 font-semibold">Monitor Dell 24"</p>
                    </div>
                    <div class="flex justify-between items-center mb-2">
                        <p class="text-sm font-medium text-gray-500">Most Profitable Category:</p>
                        <p class="text-gray-700 font-semibold">Laptops</p>
                    </div>
                    <a href="#" class="mt-4 block text-center text-sm font-semibold text-primary hover:underline">View Full Reports</a>
                </div>
            </div>

            <!-- POS Screen - initially hidden -->
            <div id="pos-screen" class="pos-container lg:col-span-2 xl:col-span-3">
                <div class="pos-menu-bar">
                    <h2 class="text-xl font-bold text-gray-900 mr-4">DuraPOS</h2>
                    <button class="pos-menu-button active" data-content="file">File</button>
                    <button class="pos-menu-button" data-content="edit">Edit</button>
                    <button class="pos-menu-button" data-content="view">View</button>
                    <button class="pos-menu-button" data-content="admin">Admin</button>
                    <button class="pos-menu-button" data-content="reports">Reports</button>
                    <button class="pos-menu-button" data-content="masters">Masters</button>
                    <button class="pos-menu-button" data-content="stores">Stores</button>
                    <button class="pos-menu-button" data-content="accounts">Accounts</button>
                    <button class="pos-menu-button" data-content="hrm">HRM</button>
                    <button class="pos-menu-button" data-content="payroll">Payroll</button>
                    <button class="pos-menu-button" data-content="tools">Tools</button>
                    <button class="pos-menu-button" data-content="windows">Windows</button>
                    <button class="pos-menu-button" data-content="help">Help</button>
                </div>
                <div id="pos-content-area" class="flex-1 p-4 bg-white mt-4 rounded-lg shadow-lg">
                    <div id="pos-content-file" class="content-section">
                        <h3 class="text-xl font-semibold mb-4">File Options</h3>
                        <p>Content for the File section will be displayed here.</p>
                        <!-- Other file-related UI components would go here -->
                    </div>
                    <div id="pos-content-edit" class="content-section hidden">
                        <h3 class="text-xl font-semibold mb-4">Edit Options</h3>
                        <p>Content for the Edit section will be displayed here.</p>
                    </div>
                    <div id="pos-content-view" class="content-section hidden">
                        <h3 class="text-xl font-semibold mb-4">View Options</h3>
                        <p>Content for the View section will be displayed here.</p>
                    </div>
                    <!-- Add more sections for other menu options here, all initially hidden -->
                </div>
                
                <button id="close-pos-btn" class="absolute top-4 right-4 btn btn-secondary">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const dropdownBtn = document.getElementById('branch-dropdown-btn');
            const dropdownMenu = document.getElementById('branch-dropdown-menu');
            
            const dashboardContent = document.getElementById('dashboard-content');
            const posScreen = document.getElementById('pos-screen');
            const btnPosSales = document.getElementById('btn-pos-sales');
            const btnDashboard = document.getElementById('btn-dashboard');
            const closePosBtn = document.getElementById('close-pos-btn');

            // --- POS Menu Logic ---
            const posMenuButtons = document.querySelectorAll('.pos-menu-button');
            const contentSections = document.querySelectorAll('.content-section');
            const posContentArea = document.getElementById('pos-content-area');

            function showContentSection(contentId) {
                // Hide all content sections
                contentSections.forEach(section => {
                    section.classList.add('hidden');
                });
                // Show the requested content section
                const targetSection = document.getElementById(`pos-content-${contentId}`);
                if (targetSection) {
                    targetSection.classList.remove('hidden');
                } else {
                    // Placeholder for content not yet implemented
                    posContentArea.innerHTML = `<div class="p-4"><p class="text-gray-400 text-lg">Content for "${contentId}" is not yet available.</p></div>`;
                }
            }

            posMenuButtons.forEach(button => {
                button.addEventListener('click', () => {
                    // Remove 'active' class from all buttons
                    posMenuButtons.forEach(btn => btn.classList.remove('active'));
                    // Add 'active' class to the clicked button
                    button.classList.add('active');
                    // Get the content ID from the data attribute and show the corresponding section
                    const contentId = button.getAttribute('data-content');
                    showContentSection(contentId);
                });
            });

            // --- Branch Dropdown Logic ---
            dropdownBtn.addEventListener('click', () => {
                dropdownMenu.classList.toggle('hidden');
            });
            window.addEventListener('click', (e) => {
                if (!dropdownBtn.contains(e.target) && !dropdownMenu.contains(e.target)) {
                    dropdownMenu.classList.add('hidden');
                }
            });

            // --- Screen Transition Logic ---
            // Function to show the POS screen
            function showPosScreen() {
                dashboardContent.style.display = 'none';
                posScreen.style.display = 'flex';
                posScreen.classList.add('flex-col');
                // Update button styles
                btnPosSales.classList.remove('btn-secondary');
                btnPosSales.classList.add('btn-primary');
                btnDashboard.classList.remove('btn-primary');
                btnDashboard.classList.add('btn-secondary');
            }

            // Function to show the Dashboard screen
            function showDashboard() {
                posScreen.style.display = 'none';
                dashboardContent.style.display = 'grid';
                // Update button styles
                btnDashboard.classList.remove('btn-secondary');
                btnDashboard.classList.add('btn-primary');
                btnPosSales.classList.remove('btn-primary');
                btnPosSales.classList.add('btn-secondary');
            }

            // Event listeners for the buttons
            btnPosSales.addEventListener('click', showPosScreen);
            btnDashboard.addEventListener('click', showDashboard);
            closePosBtn.addEventListener('click', showDashboard);
        });
    </script>
</body>
</html>