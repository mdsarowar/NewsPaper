<div class="flex h-16 items-center justify-between px-4 sm:px-6">
    <!-- Mobile menu button & Search -->
    <div class="flex items-center space-x-4">
        <button @click="sidebarOpen = !sidebarOpen"
                class="lg:hidden p-2 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
            <i class="fas fa-bars text-gray-600 dark:text-gray-400"></i>
        </button>

        <!-- Search Bar -->
        <div class="relative hidden sm:block">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                <i class="fas fa-search text-gray-400"></i>
            </div>
            <input type="text" x-model="searchQuery" @focus="searchFocused = true"
                   @blur="setTimeout(() => searchFocused = false, 200)" placeholder="Search everything..."
                   class="w-96 pl-10 pr-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100 placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">

            <!-- Search Results Dropdown -->
            <div x-show="searchFocused && searchQuery.length > 0"
                 class="absolute top-full left-0 right-0 mt-1 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-lg z-50 animate-slide-down">
                <div class="p-2">
                    <template x-for="result in searchResults" :key="result.title">
                        <a href="#"
                           class="flex items-center p-3 hover:bg-gray-50 dark:hover:bg-gray-700 rounded-lg transition-colors">
                            <i :class="result.icon" class="text-blue-500 mr-3"></i>
                            <div>
                                <div class="font-medium text-gray-900 dark:text-gray-100"
                                     x-text="result.title"></div>
                                <div class="text-sm text-gray-500 dark:text-gray-400"
                                     x-text="result.category"></div>
                            </div>
                        </a>
                    </template>
                </div>
            </div>
        </div>
    </div>

    <!-- Header Actions -->
    <div class="flex items-center space-x-3">
        <!-- Mobile Search Icon -->
        <button @click="mobileSearchOpen = !mobileSearchOpen"
                class="sm:hidden p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
            <i class="fas fa-search text-gray-600 dark:text-gray-400"></i>
        </button>

        <!-- Theme Toggle -->
        <button @click="toggleTheme()"
                class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-all duration-200 transform hover:scale-110">
            <i x-show="darkMode" class="fas fa-sun text-yellow-500"></i>
            <i x-show="!darkMode" class="fas fa-moon text-gray-600"></i>
        </button>

        <!-- Notifications -->
        <div class="relative" x-data="{ open: false }">
            <button @click="open = !open"
                    class="relative p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-all duration-200 transform hover:scale-110">
                <i class="fas fa-bell text-gray-600 dark:text-gray-400"></i>
                <span
                    class="absolute -top-1 -right-1 w-5 h-5 bg-red-500 text-white text-xs rounded-full flex items-center justify-center animate-pulse"
                    x-text="notifications.length"></span>
            </button>

            <!-- Notifications Dropdown -->
            <div x-show="open" @click.outside="open = false"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 class="absolute right-0 mt-2 w-80 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-xl z-50">
                <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="font-semibold text-gray-900 dark:text-gray-100">Notifications</h3>
                </div>
                <div class="max-h-96 overflow-y-auto">
                    <template x-for="notification in notifications" :key="notification.id">
                        <div
                            class="p-4 border-b border-gray-100 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                            <div class="flex items-start space-x-3">
                                <div class="flex-shrink-0">
                                    <div :class="notification.color"
                                         class="w-8 h-8 rounded-full flex items-center justify-center">
                                        <i :class="notification.icon" class="text-white text-sm"></i>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-900 dark:text-gray-100"
                                       x-text="notification.title"></p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400"
                                       x-text="notification.message"></p>
                                    <p class="text-xs text-gray-400 dark:text-gray-500 mt-1"
                                       x-text="notification.time"></p>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
                <div class="p-3 border-t border-gray-200 dark:border-gray-700">
                    <button
                        class="w-full text-sm text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 transition-colors">View
                        all notifications</button>
                </div>
            </div>
        </div>

        <!-- User Avatar -->
        <div class="relative" x-data="{ open: false }">
            <button @click="open = !open"
                    class="flex items-center space-x-2 p-1 rounded-full hover:bg-gray-100 dark:hover:bg-gray-700 transition-all duration-200 transform hover:scale-105">
                <img class="w-8 h-8 rounded-full ring-2 ring-blue-500 ring-offset-2 ring-offset-white dark:ring-offset-gray-800"
                     src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=100&q=80"
                     alt="Avatar">
                <i class="fas fa-chevron-down text-xs text-gray-400 transition-transform duration-200"
                   :class="open ? 'rotate-180' : ''"></i>
            </button>

            <!-- User Dropdown -->
            <div x-show="open" @click.outside="open = false"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 class="absolute right-0 mt-2 w-56 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-xl z-50">
                <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex items-center space-x-3">
                        <img class="w-10 h-10 rounded-full"
                             src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=100&q=80"
                             alt="Avatar">
                        <div>
                            <p class="font-medium text-gray-900 dark:text-gray-100">{{\Illuminate\Support\Facades\Auth::user()->name}}</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{\Illuminate\Support\Facades\Auth::user()->email}}</p>
                        </div>
                    </div>
                </div>
                <div class="py-2">
                    <template x-for="item in userMenuItems" :key="item.name">
                        <a href="#"
                           class="flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                            <i :class="item.icon" class="mr-3 text-gray-400"></i>
                            <span x-text="item.name"></span>
                        </a>
                    </template>
                </div>
                <div class="border-t border-gray-200 dark:border-gray-700 py-2">
                    <form action="{{route('logout')}}" method="post">
                        @csrf
                        <button type="submit"
                            class="flex items-center w-full px-4 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                            <i class="fas fa-sign-out-alt mr-3"></i>
                            <span>Sign Out</span>
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Mobile Search Bar -->
<div x-show="mobileSearchOpen" x-transition:enter="transition ease-out duration-200"
     x-transition:enter-start="opacity-0 transform -translate-y-4"
     x-transition:enter-end="opacity-100 transform translate-y-0" class="sm:hidden px-4 pb-4">
    <div class="relative">
        <div class="absolute inset-y-0 left-0 flex items-center pl-3">
            <i class="fas fa-search text-gray-400"></i>
        </div>
        <input type="text" placeholder="Search everything..."
               class="w-full pl-10 pr-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100">
    </div>
</div>
