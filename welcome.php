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
    </style>
</head>
<body>
    <div class="min-h-screen flex flex-col">
        <header class="bg-white shadow-sm p-4 flex justify-between items-center z-10">
            <div class="flex items-center space-x-4">
                <h1 class="text-xl font-bold text-gray-900">Global Market Traders LTD</h1>
                <div class="relative">
                    <button id="branch-dropdown-btn" class="btn btn-secondary flex items-center space-x-2">
                        <span>Main Branch</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    <div id="branch-dropdown-menu" class="dropdown-menu hidden">
                        <div class="dropdown-item">Global Make Traders LTD</div>
                        <div class="dropdown-item">Other Branches</div>
                    </div>
                </div>
            </div>
            <div class="flex items-center space-x-4">
                <span class="text-gray-700">Hello, Admin User</span>
                <a href="#" class="btn btn-secondary">Logout</a>
            </div>
        </header>

        <main class="flex-1 p-6 lg:p-10 grid gap-6 lg:grid-cols-3 xl:grid-cols-4">
            <aside class="lg:col-span-1 xl:col-span-1 flex flex-col space-y-4">
                <div class="card p-6">
                    <h2 class="text-lg font-bold text-gray-900 mb-4">Modules</h2>
                    <nav class="flex flex-col space-y-2">
                        <a href="index.html" class="btn btn-primary w-full justify-start">
                             <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                 <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                            </svg>
                            Dashboard
                        </a>
                        <a href="pos.php" class="btn btn-secondary w-full justify-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M4 4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2H4zm10 2a2 2 0 11-4 0 2 2 0 014 0zm-5 4a2 2 0 100 4 2 2 0 000-4z" />
                            </svg>
                            POS & Sales
                        </a>
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

            <div id="dashboard-content" class="lg:col-span-2 xl:col-span-3 grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                <div class="card md:col-span-2 xl:col-span-1 flex flex-col">
                    <h2 class="text-lg font-bold text-gray-900 mb-4">Today's Sales Summary</h2>
                    <div class="flex-1 grid grid-cols-2 gap-4">
                        <div class="bg-gray-100 p-4 rounded-lg flex flex-col justify-center">
                            <p class="text-sm font-medium text-gray-500">Total Sales</p>
                            <p class="text-2xl font-bold text-primary">--</p>
                        </div>
                        <div class="bg-gray-100 p-4 rounded-lg flex flex-col justify-center">
                            <p class="text-sm font-medium text-gray-500">Transactions</p>
                            <p class="text-2xl font-bold text-secondary">--</p>
                        </div>
                        <div class="bg-gray-100 p-4 rounded-lg flex flex-col justify-center">
                            <p class="text-sm font-medium text-gray-500">Average Sale</p>
                            <p class="text-2xl font-bold text-secondary">--</p>
                        </div>
                        <div class="bg-gray-100 p-4 rounded-lg flex flex-col justify-center">
                            <p class="text-sm font-medium text-gray-500">Gross Profit</p>
                            <p class="text-2xl font-bold text-green-600">--</p>
                        </div>
                    </div>
                </div>

                <div class="card xl:col-span-1">
                    <h2 class="text-lg font-bold text-gray-900 mb-4">Quick Actions</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <button class="btn btn-secondary">New Sale</button>
                        <button class="btn btn-secondary">Process Return</button>
                        <button class="btn btn-secondary">View Open Orders</button>
                        <button class="btn btn-secondary">Open Cash Drawer</button>
                    </div>
                </div>

                <div class="card md:col-span-2 xl:col-span-1">
                    <h2 class="text-lg font-bold text-red-600 mb-4">Low Stock Alerts</h2>
                    <ul class="space-y-3">
                        <li class="text-gray-500 text-center">No low stock items to display.</li>
                    </ul>
                    <a href="#" class="mt-4 block text-center text-sm font-semibold text-primary hover:underline">View All Low Stock Items</a>
                </div>

                <div class="card xl:col-span-2">
                    <h2 class="text-lg font-bold text-gray-900 mb-4">Daily Reports Snapshot</h2>
                    <div class="flex justify-between items-center mb-2">
                        <p class="text-sm font-medium text-gray-500">Best-Selling Product:</p>
                        <p class="text-gray-700 font-semibold">--</p>
                    </div>
                    <div class="flex justify-between items-center mb-2">
                        <p class="text-sm font-medium text-gray-500">Most Profitable Category:</p>
                        <p class="text-gray-700 font-semibold">--</p>
                    </div>
                    <a href="#" class="mt-4 block text-center text-sm font-semibold text-primary hover:underline">View Full Reports</a>
                </div>
            </div>
        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const dropdownBtn = document.getElementById('branch-dropdown-btn');
            const dropdownMenu = document.getElementById('branch-dropdown-menu');

            dropdownBtn.addEventListener('click', () => {
                dropdownMenu.classList.toggle('hidden');
            });

            window.addEventListener('click', (e) => {
                if (!dropdownBtn.contains(e.target) && !dropdownMenu.contains(e.target)) {
                    dropdownMenu.classList.add('hidden');
                }
            });
        });
    </script>
</body>
</html>