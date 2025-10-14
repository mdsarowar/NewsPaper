<div class="fixed inset-y-0 left-0 z-50 transform transition-all duration-300 ease-in-out lg:translate-x-0"
     :class="{
                  'translate-x-0': sidebarOpen,
                 '-translate-x-full': !sidebarOpen && window.innerWidth < 1024,
                 'w-64': !sidebarCollapsed,
                 'w-16': sidebarCollapsed && window.innerWidth >= 1024,
{{--                  'w-64': sidebarOpen && window.innerWidth < 1024--}}
             }">
    <div
        class="flex h-full flex-col bg-white dark:bg-gray-800 shadow-xl border-r border-gray-200 dark:border-gray-700">
        <!-- Logo -->
        <div
            class="flex h-16 items-center justify-center border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-blue-600 to-purple-600 relative">
            <div class="flex items-center" x-show="!sidebarCollapsed"
                 x-transition:enter="transition-opacity ease-in duration-200"
                 x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
                <div class="w-8 h-8 bg-white rounded-lg flex items-center justify-center mr-3">
                    <i class="fas fa-bolt text-blue-600"></i>
                </div>
                <span class="text-xl font-bold text-white">DashPro</span>
            </div>

            <!-- Collapsed Logo -->
            <div x-show="sidebarCollapsed" x-transition:enter="transition-opacity ease-in duration-200"
                 x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                 class="w-8 h-8 bg-white rounded-lg flex items-center justify-center">
                <i class="fas fa-bolt text-blue-600"></i>
            </div>

            <!-- Desktop Collapse Button -->
            <button @click="toggleSidebarCollapse()"
                    class="hidden lg:block absolute -right-3 top-6 w-6 h-6 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-full shadow-lg flex items-center justify-center text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 transition-all duration-200 z-10">
                <i :class="sidebarCollapsed ? 'fas fa-chevron-right' : 'fas fa-chevron-left'"
                   class="text-xs"></i>
            </button>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 overflow-y-auto px-4 py-6">

            <!-- Dashboard -->
            <div class="mb-1">
                <a href="{{route('home')}}"
                   class="flex items-center rounded-lg px-3 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                    <i class="fas fa-home mr-3"></i>
                    <span>Dashboard</span>
                </a>
            </div>

            <!-- Users with submenu -->
            <div class="mb-1" x-data="{ open: false }">
                <button @click="open = !open"
                        class="flex w-full items-center justify-between rounded-lg px-3 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                    <div class="flex items-center">
                        <i class="fas fa-users mr-3"></i>
                        <span>Users</span>
                    </div>
                    <i :class="open ? 'fas fa-chevron-down rotate-180' : 'fas fa-chevron-down'"
                       class="text-xs transition-transform duration-200"></i>
                </button>
                <div x-show="open" x-transition class="ml-6 mt-1 space-y-1">
{{--                    @permission('update-user')--}}
                    <a href="{{route('users.index')}}"
                       class="block rounded-md px-3 py-2 text-sm text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700">
                        All Users
                    </a>
{{--                    @endpermission--}}
{{--                    @permission('create-user')--}}
                    <a href="{{route('users.create')}}"
                       class="block rounded-md px-3 py-2 text-sm text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700">
                        Add User
                    </a>
{{--                    @endpermission--}}
                </div>
            </div>
            <!-- Users with submenu -->
            <div class="mb-1" x-data="{ open: false }">
                <button @click="open = !open"
                        class="flex w-full items-center justify-between rounded-lg px-3 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                    <div class="flex items-center">
                        <i class="fas fa-users mr-3"></i>
                        <span>Roles & Permissions</span>
                    </div>
                    <i :class="open ? 'fas fa-chevron-down rotate-180' : 'fas fa-chevron-down'"
                       class="text-xs transition-transform duration-200"></i>
                </button>
                <div x-show="open" x-transition class="ml-6 mt-1 space-y-1">
{{--                    @permission('update-role')--}}
                    <a href="{{route('roles.index')}}"
                       class="block rounded-md px-3 py-2 text-sm text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700">
                        Role
                    </a>
{{--                    @endpermission--}}
{{--                    @permission('create-role')--}}
                    <a href="{{route('roles.create')}}"
                       class="block rounded-md px-3 py-2 text-sm text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700">
                        Role Create
                    </a>
{{--                    @endpermission--}}
{{--                    @permission('update-permission')--}}
                    <a href="{{route('permissions.index')}}"
                       class="block rounded-md px-3 py-2 text-sm text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700">
                        Permission
                    </a>
{{--                    @endpermission--}}
{{--                    @permission('create-permission')--}}
                        <a href="{{route('permissions.create')}}"
                           class="block rounded-md px-3 py-2 text-sm text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700">
                            Permission Create
                        </a>
{{--                    @endpermission--}}
{{--                    @permission('create-user')--}}
                        <a href="{{route('roletopermission')}}"
                           class="block rounded-md px-3 py-2 text-sm text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700">
                            Role Assign Permissions
                        </a>
{{--                    @endpermission--}}

                </div>
            </div>
            <!--Categories-->
            <div class="mb-1" x-data="{ open: false }">
                <button @click="open = !open"
                        class="flex w-full items-center justify-between rounded-lg px-3 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                    <div class="flex items-center">
                        <i class="fas fa-users mr-3"></i>
                        <span>Categories</span>
                    </div>
                    <i :class="open ? 'fas fa-chevron-down rotate-180' : 'fas fa-chevron-down'"
                       class="text-xs transition-transform duration-200"></i>
                </button>
                <div x-show="open" x-transition class="ml-6 mt-1 space-y-1">
                    <a href="{{route('categories.index')}}"
                       class="block rounded-md px-3 py-2 text-sm text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700">
                        List
                    </a>
                    <a href="{{route('categories.create')}}"
                       class="block rounded-md px-3 py-2 text-sm text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700">
                        Create
                    </a>
                </div>
            </div>
            <!--Articles-->
            <div class="mb-1" x-data="{ open: false }">
                <button @click="open = !open"
                        class="flex w-full items-center justify-between rounded-lg px-3 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                    <div class="flex items-center">
                        <i class="fas fa-users mr-3"></i>
                        <span>Articles</span>
                    </div>
                    <i :class="open ? 'fas fa-chevron-down rotate-180' : 'fas fa-chevron-down'"
                       class="text-xs transition-transform duration-200"></i>
                </button>
                <div x-show="open" x-transition class="ml-6 mt-1 space-y-1">
                    <a href="{{route('articles.index')}}"
                       class="block rounded-md px-3 py-2 text-sm text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700">
                        List
                    </a>
                    <a href="{{route('articles.create')}}"
                       class="block rounded-md px-3 py-2 text-sm text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700">
                        Create
                    </a>
                </div>
            </div>
            <!--Tags-->
            <div class="mb-1" x-data="{ open: false }">
                <button @click="open = !open"
                        class="flex w-full items-center justify-between rounded-lg px-3 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                    <div class="flex items-center">
                        <i class="fas fa-users mr-3"></i>
                        <span>Tags</span>
                    </div>
                    <i :class="open ? 'fas fa-chevron-down rotate-180' : 'fas fa-chevron-down'"
                       class="text-xs transition-transform duration-200"></i>
                </button>
                <div x-show="open" x-transition class="ml-6 mt-1 space-y-1">
                    <a href="{{route('articles.index')}}"
                       class="block rounded-md px-3 py-2 text-sm text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700">
                        List
                    </a>
                    <a href="{{route('articles.create')}}"
                       class="block rounded-md px-3 py-2 text-sm text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700">
                        Create
                    </a>
                </div>
            </div>
            <!-- Projects with submenu -->
            <div class="mb-1" x-data="{ open: false }">
                <button @click="open = !open"
                        class="flex w-full items-center justify-between rounded-lg px-3 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                    <div class="flex items-center">
                        <i class="fas fa-users mr-3"></i>
                        <span>Projects</span>
                    </div>
                    <i :class="open ? 'fas fa-chevron-down rotate-180' : 'fas fa-chevron-down'"
                       class="text-xs transition-transform duration-200"></i>
                </button>
                <div x-show="open" x-transition class="ml-6 mt-1 space-y-1">
                    <a href="/"
                       class="block rounded-md px-3 py-2 text-sm text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700">
                        All Projects
                    </a>
                    <a href="/"
                       class="block rounded-md px-3 py-2 text-sm text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700">
                        Active
                    </a>
                    <a href="/"
                       class="block rounded-md px-3 py-2 text-sm text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700">
                        complited
                    </a>
                </div>
            </div>
            <!-- Team with submenu -->
            <div class="mb-1" x-data="{ open: false }">
                <button @click="open = !open"
                        class="flex w-full items-center justify-between rounded-lg px-3 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                    <div class="flex items-center">
                        <i class="fas fa-users mr-3"></i>
                        <span>Team</span>
                    </div>
                    <i :class="open ? 'fas fa-chevron-down rotate-180' : 'fas fa-chevron-down'"
                       class="text-xs transition-transform duration-200"></i>
                </button>
                <div x-show="open" x-transition class="ml-6 mt-1 space-y-1">
                    <a href="/"
                       class="block rounded-md px-3 py-2 text-sm text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700">
                        Members
                    </a>
                    <a href="/"
                       class="block rounded-md px-3 py-2 text-sm text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700">
                        Role
                    </a>
                    <a href="/"
                       class="block rounded-md px-3 py-2 text-sm text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700">
                        Permission
                    </a>
                </div>
            </div>

            <!-- Settings -->
            <div class="mb-1">
                <a href="/"
                   class="flex items-center rounded-lg px-3 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                    <i class="fas fa-cog mr-3"></i>
                    <span>Settings</span>
                </a>
            </div>

        </nav>

        <!-- Sidebar Footer -->
        <div class="border-t border-gray-200 dark:border-gray-700 p-4">
            <div x-show="!sidebarCollapsed" x-transition:enter="transition-opacity ease-in duration-200"
                 x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                 class="flex items-center justify-between text-xs text-gray-500 dark:text-gray-400">
                <span>Version 2.1.0</span>
                <div class="flex items-center">
                    <div class="w-2 h-2 bg-green-500 rounded-full mr-2 animate-pulse-soft"></div>
                    <span>Online</span>
                </div>
            </div>
            <div x-show="sidebarCollapsed" x-transition:enter="transition-opacity ease-in duration-200"
                 x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                 class="flex justify-center">
                <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse-soft"></div>
            </div>
        </div>
    </div>
</div>

