<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bite's ME</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes slideIn {
            from { transform: translateX(-20px); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        .animate-fadeIn {
            animation: fadeIn 0.5s ease-out forwards;
        }

        .animate-slideIn {
            animation: slideIn 0.5s ease-out forwards;
        }

        .animate-pulse {
            animation: pulse 2s infinite;
        }

        .sidebar-item {
            transition: all 0.3s ease;
        }

        .sidebar-item:hover {
            transform: translateX(4px);
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .table-row {
            transition: all 0.2s ease;
        }

        .table-row:hover {
            background-color: rgba(59, 130, 246, 0.05);
        }

        .theme-dot {
            transition: all 0.3s ease;
        }

        .theme-dot:hover {
            transform: scale(1.2);
        }

        .theme-dot.active {
            transform: scale(1.1);
            box-shadow: 0 0 0 2px white, 0 0 0 4px currentColor;
        }

        .sidebar-group-items {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.4s ease-out;
        }

        .sidebar-group.active .sidebar-group-items {
            max-height: 500px;
            transition: max-height 0.5s ease-in;
        }

        .modal {
            opacity: 0;
            transform: translateY(-20px);
            transition: opacity 0.3s ease, transform 0.3s ease;
            pointer-events: none;
        }

        .modal.active {
            opacity: 1;
            transform: translateY(0);
            pointer-events: all;
        }

        .input-focus:focus {
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
        }

        .chart-container {
            position: relative;
            height: 300px;
            width: 100%;
        }

        .toggle-checkbox:checked {
            right: 0;
            border-color: #68D391;
        }

        .toggle-checkbox:checked + .toggle-label {
            background-color: #68D391;
        }
    </style>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: {
                            yellow: '#F6E05E',
                            blue: '#3B82F6',
                            green: '#10B981',
                        }
                    },
                    animation: {
                        'spin-slow': 'spin 3s linear infinite',
                        'bounce-slow': 'bounce 2s infinite',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-200 transition-colors duration-300">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <div id="sidebar" class="hidden md:flex md:flex-shrink-0">
            <div class="flex flex-col w-64 border-r border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 transition-all duration-300">
                <div class="flex items-center justify-center h-16 px-4 border-b border-gray-200 dark:border-gray-700 animate-slideIn">
                    <div class="flex items-center">
                        <i class="fas fa-cube text-xl mr-2 text-primary-blue animate-spin-slow"></i>
                        <span class="text-xl font-semibold">AdminPro</span>
                    </div>
                </div>
                <div class="flex flex-col flex-grow overflow-y-auto">
                    <nav class="flex-1 px-2 py-4 space-y-1">
                        <!-- Dashboard -->
                        <div class="animate-fadeIn" style="animation-delay: 0.1s;">
                            <a href="#" class="flex items-center px-4 py-2 text-sm font-medium rounded-md bg-primary-blue/10 text-primary-blue dark:bg-primary-blue/20 sidebar-item">
                                <i class="fas fa-tachometer-alt mr-3"></i>
                                Dashboard
                            </a>
                        </div>

                        <!-- Group 1 -->
                        <div class="sidebar-group animate-fadeIn" style="animation-delay: 0.2s;">
                            <button class="flex items-center w-full px-4 py-2 text-sm font-medium rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 sidebar-item">
                                <i class="fas fa-users mr-3"></i>
                                <span class="flex-1 text-left">User Management</span>
                                <i class="fas fa-chevron-down text-xs transition-transform duration-300"></i>
                            </button>
                            <div class="sidebar-group-items pl-4 mt-1 space-y-1">
                                <a href="#" class="block px-4 py-2 text-sm rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 sidebar-item">All Users</a>
                                <a href="#" class="block px-4 py-2 text-sm rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 sidebar-item">Roles</a>
                                <a href="#" class="block px-4 py-2 text-sm rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 sidebar-item">Permissions</a>
                                <a href="#" class="block px-4 py-2 text-sm rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 sidebar-item">Activity Log</a>
                            </div>
                        </div>

                        <!-- Group 2 -->
                        <div class="sidebar-group animate-fadeIn" style="animation-delay: 0.3s;">
                            <button class="flex items-center w-full px-4 py-2 text-sm font-medium rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 sidebar-item">
                                <i class="fas fa-shopping-cart mr-3"></i>
                                <span class="flex-1 text-left">Products</span>
                                <i class="fas fa-chevron-down text-xs transition-transform duration-300"></i>
                            </button>
                            <div class="sidebar-group-items pl-4 mt-1 space-y-1">
                                <a href="#" class="block px-4 py-2 text-sm rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 sidebar-item">All Products</a>
                                <a href="#" class="block px-4 py-2 text-sm rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 sidebar-item">Categories</a>
                                <a href="#" class="block px-4 py-2 text-sm rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 sidebar-item">Inventory</a>
                                <a href="#" class="block px-4 py-2 text-sm rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 sidebar-item">Reviews</a>
                            </div>
                        </div>

                        <!-- Group 3 -->
                        <div class="sidebar-group animate-fadeIn" style="animation-delay: 0.4s;">
                            <button class="flex items-center w-full px-4 py-2 text-sm font-medium rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 sidebar-item">
                                <i class="fas fa-chart-line mr-3"></i>
                                <span class="flex-1 text-left">Analytics</span>
                                <i class="fas fa-chevron-down text-xs transition-transform duration-300"></i>
                            </button>
                            <div class="sidebar-group-items pl-4 mt-1 space-y-1">
                                <a href="#" class="block px-4 py-2 text-sm rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 sidebar-item">Sales</a>
                                <a href="#" class="block px-4 py-2 text-sm rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 sidebar-item">Revenue</a>
                                <a href="#" class="block px-4 py-2 text-sm rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 sidebar-item">Customers</a>
                                <a href="#" class="block px-4 py-2 text-sm rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 sidebar-item">Products</a>
                            </div>
                        </div>

                        <!-- Group 4 -->
                        <div class="sidebar-group animate-fadeIn" style="animation-delay: 0.5s;">
                            <button class="flex items-center w-full px-4 py-2 text-sm font-medium rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 sidebar-item">
                                <i class="fas fa-cog mr-3"></i>
                                <span class="flex-1 text-left">Settings</span>
                                <i class="fas fa-chevron-down text-xs transition-transform duration-300"></i>
                            </button>
                            <div class="sidebar-group-items pl-4 mt-1 space-y-1">
                                <a href="#" class="block px-4 py-2 text-sm rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 sidebar-item">General</a>
                                <a href="#" class="block px-4 py-2 text-sm rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 sidebar-item">Appearance</a>
                                <a href="#" class="block px-4 py-2 text-sm rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 sidebar-item">Notifications</a>
                                <a href="#" class="block px-4 py-2 text-sm rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 sidebar-item">Security</a>
                            </div>
                        </div>
                    </nav>
                </div>
                <div class="p-4 border-t border-gray-200 dark:border-gray-700 animate-fadeIn" style="animation-delay: 0.6s;">
                    <div class="flex items-center">
                        <img class="w-10 h-10 rounded-full object-cover ring-2 ring-primary-blue" src="https://randomuser.me/api/portraits/women/44.jpg" alt="User avatar">
                        <div class="ml-3">
                            <p class="text-sm font-medium">Sarah Johnson</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Admin</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex flex-col flex-1 overflow-hidden">
            <!-- Top Navigation -->
            <div class="flex items-center justify-between h-16 px-4 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 transition-colors duration-300">
                <!-- Mobile menu button -->
                <button id="mobile-menu-button" class="md:hidden p-2 rounded-md text-gray-500 hover:text-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                    <i class="fas fa-bars"></i>
                </button>

                <!-- Search bar -->
                <div class="flex-1 max-w-md mx-4">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                        <input class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white dark:bg-gray-700 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-primary-blue focus:border-primary-blue sm:text-sm transition-all duration-200 input-focus" placeholder="Search..." type="search">
                    </div>
                </div>

                <!-- Right side items -->
                <div class="flex items-center space-x-4">
                    <!-- Theme switcher -->
                    <div class="flex items-center space-x-2 bg-gray-100 dark:bg-gray-700 rounded-full p-1">
                        <button id="theme-yellow" class="theme-dot w-6 h-6 rounded-full bg-primary-yellow"></button>
                        <button id="theme-blue" class="theme-dot w-6 h-6 rounded-full bg-primary-blue active"></button>
                        <button id="theme-green" class="theme-dot w-6 h-6 rounded-full bg-primary-green"></button>
                    </div>

                    <!-- Dark mode toggle -->
                    <button id="dark-mode-toggle" class="p-2 rounded-md text-gray-500 hover:text-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                        <i class="fas fa-moon hidden dark:block"></i>
                        <i class="fas fa-sun block dark:hidden"></i>
                    </button>

                    <!-- Notifications -->
                    <button class="p-2 rounded-md text-gray-500 hover:text-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700 relative transition-colors">
                        <i class="fas fa-bell"></i>
                        <span class="absolute top-0 right-0 h-2 w-2 rounded-full bg-red-500 animate-ping opacity-75"></span>
                        <span class="absolute top-0 right-0 h-2 w-2 rounded-full bg-red-500"></span>
                    </button>
                </div>
            </div>

            <!-- Main Content Area -->
            <div class="flex-1 overflow-auto p-4">
                <div class="mb-6 flex justify-between items-center animate-fadeIn">
                    <h1 class="text-2xl font-bold">Dashboard Overview</h1>
                    <button id="open-modal" class="px-4 py-2 bg-primary-blue text-white rounded-md hover:bg-opacity-90 transition-all duration-200 transform hover:scale-105 shadow-md">
                        <i class="fas fa-plus mr-2"></i> Add New Item
                    </button>
                </div>

                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 card-hover animate-fadeIn" style="animation-delay: 0.1s;">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-primary-blue/10 text-primary-blue">
                                <i class="fas fa-users text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Users</p>
                                <p class="text-2xl font-semibold">1,254 <span class="text-sm text-green-500">↑ 12%</span></p>
                            </div>
                        </div>
                        <div class="mt-4 h-2 bg-gray-200 rounded-full">
                            <div class="h-2 bg-primary-blue rounded-full" style="width: 72%"></div>
                        </div>
                    </div>

                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 card-hover animate-fadeIn" style="animation-delay: 0.2s;">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-primary-green/10 text-primary-green">
                                <i class="fas fa-shopping-cart text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Sales</p>
                                <p class="text-2xl font-semibold">$12,345 <span class="text-sm text-green-500">↑ 5.2%</span></p>
                            </div>
                        </div>
                        <div class="mt-4 h-2 bg-gray-200 rounded-full">
                            <div class="h-2 bg-primary-green rounded-full" style="width: 58%"></div>
                        </div>
                    </div>

                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 card-hover animate-fadeIn" style="animation-delay: 0.3s;">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-primary-yellow/10 text-primary-yellow">
                                <i class="fas fa-chart-line text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Conversion Rate</p>
                                <p class="text-2xl font-semibold">3.42% <span class="text-sm text-red-500">↓ 1.1%</span></p>
                            </div>
                        </div>
                        <div class="mt-4 h-2 bg-gray-200 rounded-full">
                            <div class="h-2 bg-primary-yellow rounded-full" style="width: 34%"></div>
                        </div>
                    </div>

                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 card-hover animate-fadeIn" style="animation-delay: 0.4s;">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-red-100 text-red-600">
                                <i class="fas fa-exclamation-triangle text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Pending Issues</p>
                                <p class="text-2xl font-semibold">12 <span class="text-sm text-green-500">↓ 3</span></p>
                            </div>
                        </div>
                        <div class="mt-4 h-2 bg-gray-200 rounded-full">
                            <div class="h-2 bg-red-500 rounded-full" style="width: 24%"></div>
                        </div>
                    </div>
                </div>

                <!-- Charts Row -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                    <!-- Line Chart -->
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 animate-fadeIn" style="animation-delay: 0.5s;">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-lg font-semibold">Sales Overview</h2>
                            <div class="flex space-x-2">
                                <button class="px-2 py-1 text-xs border border-gray-300 rounded-md hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">Day</button>
                                <button class="px-2 py-1 text-xs bg-gray-100 dark:bg-gray-700 rounded-md hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">Week</button>
                                <button class="px-2 py-1 text-xs border border-gray-300 rounded-md hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">Month</button>
                            </div>
                        </div>
                        <div class="chart-container">
                            <canvas id="lineChart"></canvas>
                        </div>
                    </div>

                    <!-- Pie Chart -->
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 animate-fadeIn" style="animation-delay: 0.6s;">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-lg font-semibold">Product Categories</h2>
                            <button class="px-2 py-1 text-xs border border-gray-300 rounded-md hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                <i class="fas fa-download mr-1"></i> Export
                            </button>
                        </div>
                        <div class="chart-container">
                            <canvas id="pieChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Table -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden mb-6 animate-fadeIn" style="animation-delay: 0.7s;">
                    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
                        <h2 class="text-lg font-semibold">Recent Orders</h2>
                        <div class="flex space-x-2">
                            <button class="px-3 py-1 text-sm border border-gray-300 rounded-md hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                <i class="fas fa-download mr-1"></i> Export
                            </button>
                            <button class="px-3 py-1 text-sm bg-gray-100 dark:bg-gray-700 rounded-md hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                                <i class="fas fa-filter mr-1"></i> Filter
                            </button>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Order ID</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Customer</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Date</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Amount</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                <tr class="table-row">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">#ORD-0001</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">John Smith</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">12 May 2023</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">Completed</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">$125.00</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <button class="text-primary-blue hover:text-primary-blue/80 mr-3 transition-colors"><i class="fas fa-eye"></i></button>
                                        <button class="text-primary-green hover:text-primary-green/80 transition-colors"><i class="fas fa-edit"></i></button>
                                    </td>
                                </tr>
                                <tr class="table-row">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">#ORD-0002</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">Sarah Johnson</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">11 May 2023</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">Pending</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">$89.50</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <button class="text-primary-blue hover:text-primary-blue/80 mr-3 transition-colors"><i class="fas fa-eye"></i></button>
                                        <button class="text-primary-green hover:text-primary-green/80 transition-colors"><i class="fas fa-edit"></i></button>
                                    </td>
                                </tr>
                                <tr class="table-row">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">#ORD-0003</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">Michael Brown</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">10 May 2023</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">Processing</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">$245.75</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <button class="text-primary-blue hover:text-primary-blue/80 mr-3 transition-colors"><i class="fas fa-eye"></i></button>
                                        <button class="text-primary-green hover:text-primary-green/80 transition-colors"><i class="fas fa-edit"></i></button>
                                    </td>
                                </tr>
                                <tr class="table-row">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">#ORD-0004</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">Emily Davis</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">9 May 2023</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">Cancelled</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">$67.30</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <button class="text-primary-blue hover:text-primary-blue/80 mr-3 transition-colors"><i class="fas fa-eye"></i></button>
                                        <button class="text-primary-green hover:text-primary-green/80 transition-colors"><i class="fas fa-edit"></i></button>
                                    </td>
                                </tr>
                                <tr class="table-row">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">#ORD-0005</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">Robert Wilson</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">8 May 2023</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">Completed</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">$189.99</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <button class="text-primary-blue hover:text-primary-blue/80 mr-3 transition-colors"><i class="fas fa-eye"></i></button>
                                        <button class="text-primary-green hover:text-primary-green/80 transition-colors"><i class="fas fa-edit"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700 flex items-center justify-between">
                        <div class="text-sm text-gray-500 dark:text-gray-400">
                            Showing <span class="font-medium">1</span> to <span class="font-medium">5</span> of <span class="font-medium">24</span> results
                        </div>
                        <div class="flex space-x-2">
                            <button class="px-3 py-1 text-sm border border-gray-300 rounded-md hover:bg-gray-50 dark:hover:bg-gray-700 disabled:opacity-50 transition-colors" disabled>Previous</button>
                            <button class="px-3 py-1 text-sm bg-primary-blue text-white rounded-md hover:bg-opacity-90 transition-colors">1</button>
                            <button class="px-3 py-1 text-sm border border-gray-300 rounded-md hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">2</button>
                            <button class="px-3 py-1 text-sm border border-gray-300 rounded-md hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">3</button>
                            <button class="px-3 py-1 text-sm border border-gray-300 rounded-md hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">Next</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="modal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 modal">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl w-full max-w-md transform transition-all duration-300 scale-95">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
                <h3 class="text-lg font-semibold">Add New Item</h3>
                <button id="close-modal" class="text-gray-500 hover:text-gray-700 dark:hover:text-gray-300 transition-colors">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="px-6 py-4">
                <form>
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-1" for="name">Item Name</label>
                        <input id="name" type="text" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-blue focus:border-primary-blue dark:bg-gray-700 transition-all duration-200 input-focus">
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-1" for="category">Category</label>
                        <select id="category" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-blue focus:border-primary-blue dark:bg-gray-700 transition-all duration-200 input-focus">
                            <option>Select a category</option>
                            <option>Electronics</option>
                            <option>Clothing</option>
                            <option>Home & Garden</option>
                            <option>Books</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-1" for="price">Price</label>
                        <input id="price" type="number" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-blue focus:border-primary-blue dark:bg-gray-700 transition-all duration-200 input-focus">
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-1" for="description">Description</label>
                        <textarea id="description" rows="3" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-blue focus:border-primary-blue dark:bg-gray-700 transition-all duration-200 input-focus"></textarea>
                    </div>
                </form>
            </div>
            <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700 flex justify-end space-x-3">
                <button id="cancel-modal" class="px-4 py-2 text-sm border border-gray-300 rounded-md hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">Cancel</button>
                <button class="px-4 py-2 text-sm bg-primary-blue text-white rounded-md hover:bg-opacity-90 transition-colors transform hover:scale-105">Save Item</button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Set default theme to blue
            let currentTheme = 'blue';

            // Theme switcher buttons
            const themeYellow = document.getElementById('theme-yellow');
            const themeBlue = document.getElementById('theme-blue');
            const themeGreen = document.getElementById('theme-green');
            const themeDots = document.querySelectorAll('.theme-dot');

            // Dark mode toggle
            const darkModeToggle = document.getElementById('dark-mode-toggle');

            // Modal elements
            const openModalBtn = document.getElementById('open-modal');
            const closeModalBtn = document.getElementById('close-modal');
            const cancelModalBtn = document.getElementById('cancel-modal');
            const modal = document.getElementById('modal');
            const modalContent = modal.querySelector('div');

            // Mobile menu toggle
            const mobileMenuBtn = document.getElementById('mobile-menu-button');
            const sidebar = document.getElementById('sidebar');

            // Apply theme
            function applyTheme(theme) {
                // Update all elements with primary color classes
                document.querySelectorAll('[class*="primary-"]').forEach(el => {
                    const classes = el.className.split(' ');
                    const newClasses = classes.map(cls => {
                        if (cls.includes('primary-')) {
                            return cls.replace(/primary-(yellow|blue|green)/, `primary-${theme}`);
                        }
                        return cls;
                    });
                    el.className = newClasses.join(' ');
                });

                // Update logo color
                const logoIcon = document.querySelector('.fa-cube');
                if (logoIcon) {
                    logoIcon.classList.remove('text-primary-yellow', 'text-primary-blue', 'text-primary-green');
                    logoIcon.classList.add(`text-primary-${theme}`);
                }

                // Update active theme dot
                themeDots.forEach(dot => dot.classList.remove('active'));
                document.getElementById(`theme-${theme}`).classList.add('active');

                currentTheme = theme;
                localStorage.setItem('theme', theme);
            }

            // Toggle dark mode
            function toggleDarkMode() {
                const html = document.documentElement;
                if (html.classList.contains('dark')) {
                    html.classList.remove('dark');
                    localStorage.setItem('darkMode', 'false');
                } else {
                    html.classList.add('dark');
                    localStorage.setItem('darkMode', 'true');
                }
            }

            // Check for saved preferences
            if (localStorage.getItem('darkMode') === 'true') {
                document.documentElement.classList.add('dark');
            }

            const savedTheme = localStorage.getItem('theme') || 'blue';
            applyTheme(savedTheme);

            // Modal functions
            function openModal() {
                modal.classList.add('active');
                setTimeout(() => {
                    modalContent.classList.remove('scale-95');
                    modalContent.classList.add('scale-100');
                }, 10);
            }

            function closeModal() {
                modalContent.classList.remove('scale-100');
                modalContent.classList.add('scale-95');
                setTimeout(() => {
                    modal.classList.remove('active');
                }, 300);
            }

            // Event listeners
            themeYellow.addEventListener('click', () => applyTheme('yellow'));
            themeBlue.addEventListener('click', () => applyTheme('blue'));
            themeGreen.addEventListener('click', () => applyTheme('green'));

            darkModeToggle.addEventListener('click', toggleDarkMode);

            // Modal functionality
            openModalBtn.addEventListener('click', openModal);
            closeModalBtn.addEventListener('click', closeModal);
            cancelModalBtn.addEventListener('click', closeModal);

            // Close modal when clicking outside
            modal.addEventListener('click', (e) => {
                if (e.target === modal) {
                    closeModal();
                }
            });

            // Mobile menu toggle
            mobileMenuBtn.addEventListener('click', () => {
                sidebar.classList.toggle('hidden');
            });

            // Sidebar group toggle functionality
            document.querySelectorAll('.sidebar-group button').forEach(button => {
                button.addEventListener('click', () => {
                    const group = button.closest('.sidebar-group');
                    const icon = button.querySelector('.fa-chevron-down');

                    group.classList.toggle('active');
                    icon.classList.toggle('rotate-180');
                });
            });

            // Animate elements on scroll
            const animateOnScroll = function() {
                const elements = document.querySelectorAll('.animate-fadeIn, .animate-slideIn');

                elements.forEach(element => {
                    const elementPosition = element.getBoundingClientRect().top;
                    const windowHeight = window.innerHeight;

                    if (elementPosition < windowHeight - 100) {
                        element.style.opacity = '1';
                        element.style.transform = 'translateY(0)';
                    }
                });
            };

            // Initial check
            animateOnScroll();

            // Check on scroll
            window.addEventListener('scroll', animateOnScroll);

            // Initialize charts
            const lineCtx = document.getElementById('lineChart').getContext('2d');
            const pieCtx = document.getElementById('pieChart').getContext('2d');

            // Line Chart
            const lineChart = new Chart(lineCtx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
                    datasets: [{
                        label: 'Sales',
                        data: [65, 59, 80, 81, 56, 55, 40],
                        backgroundColor: 'rgba(59, 130, 246, 0.2)',
                        borderColor: 'rgba(59, 130, 246, 1)',
                        borderWidth: 2,
                        tension: 0.4,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });

            // Pie Chart
            const pieChart = new Chart(pieCtx, {
                type: 'pie',
                data: {
                    labels: ['Electronics', 'Clothing', 'Home & Garden', 'Books', 'Other'],
                    datasets: [{
                        data: [300, 500, 100, 200, 150],
                        backgroundColor: [
                            'rgba(59, 130, 246, 0.7)',
                            'rgba(16, 185, 129, 0.7)',
                            'rgba(246, 224, 94, 0.7)',
                            'rgba(139, 92, 246, 0.7)',
                            'rgba(239, 68, 68, 0.7)'
                        ],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'right',
                            labels: {
                                usePointStyle: true,
                                padding: 20
                            }
                        }
                    }
                }
            });

            // Update charts when theme changes
            function updateCharts() {
                lineChart.update();
                pieChart.update();
            }

            // Watch for dark mode changes
            const observer = new MutationObserver(function(mutations) {
                mutations.forEach(function(mutation) {
                    if (mutation.attributeName === 'class') {
                        updateCharts();
                    }
                });
            });

            observer.observe(document.documentElement, {
                attributes: true
            });
        });
    </script>
</body>
</html>