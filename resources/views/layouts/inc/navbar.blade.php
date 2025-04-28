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
            <button id="theme-green" class="theme-dot w-6 h-6 rounded-full bg-primary-green"></button>
            <button id="theme-blue" class="theme-dot w-6 h-6 rounded-full bg-primary-blue active"></button>
            <button id="theme-purple" class="theme-dot w-6 h-6 rounded-full bg-primary-purple"></button>
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