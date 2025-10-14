<!DOCTYPE html>
{{--<html lang="en">--}}
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
      @include('admin.includes.assets.css')
</head>
<body class="bg-gray-50 dark:bg-gray-900 transition-colors duration-300">
<div x-data="dashboard()" class="min-h-screen">
    <!-- Sidebar -->
   @include('admin.includes.sidebare')

    <!-- Overlay for mobile -->
    <div x-show="sidebarOpen" @click="sidebarOpen = false"
         class="fixed inset-0 z-40 bg-black bg-opacity-50 lg:hidden"
         x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"></div>

    <!-- Main Content -->
    <div class="transition-all duration-300 ease-in-out" :class="sidebarCollapsed ? 'lg:pl-16' : 'lg:pl-64'">
        <!-- Header -->
        <header class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 shadow-sm">
           @include('admin.includes.header')
        </header>

        <!-- Main Content Area -->
        <main class="p-4 sm:p-6">
            <!-- Dashboard Content -->
            @yield('content')
        </main>
    </div>
</div>
@include('admin.includes.assets.js')
</body>
</html>
