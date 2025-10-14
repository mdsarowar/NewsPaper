@extends('admin.master')
@section('content')

    <div class="mb-8">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-gray-100">Welcome back,
                    {{\Illuminate\Support\Facades\Auth::user()->name}}!</h1>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Here's what's happening with your
                    projects today.</p>
            </div>
            <div class="mt-4 sm:mt-0 flex space-x-3">
                <button
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl">
                    <i class="fas fa-plus mr-2"></i>New Project
                </button>
                <button
                    class="px-4 py-2 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                    <i class="fas fa-download mr-2"></i>Export
                </button>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <template x-for="stat in stats" :key="stat.title">
            <div
                class="bg-white dark:bg-gray-800 rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 transform hover:scale-105 border border-gray-200 dark:border-gray-700">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400"
                               x-text="stat.title"></p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-gray-100 mt-1"
                               x-text="stat.value"></p>
                            <p class="text-sm mt-1"
                               :class="stat.changeType === 'increase' ? 'text-green-600' : 'text-red-600'">
                                <i :class="stat.changeType === 'increase' ? 'fas fa-arrow-up' : 'fas fa-arrow-down'"
                                   class="mr-1"></i>
                                <span x-text="stat.change"></span>
                            </p>
                        </div>
                        <div :class="stat.iconBg" class="p-3 rounded-lg">
                            <i :class="stat.icon" class="text-2xl text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </div>

    <!-- Charts and Tables -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Chart Card -->
        <div
            class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
            <div class="p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Revenue Analytics
                    </h3>
                    <div class="flex space-x-2">
                        <button
                            class="px-3 py-1 text-xs bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-blue-400 rounded-full">7D</button>
                        <button
                            class="px-3 py-1 text-xs text-gray-500 dark:text-gray-400 rounded-full hover:bg-gray-100 dark:hover:bg-gray-700">30D</button>
                    </div>
                </div>
                <div
                    class="h-64 bg-gradient-to-br from-blue-50 to-indigo-100 dark:from-blue-900/20 dark:to-indigo-900/20 rounded-lg flex items-center justify-center">
                    <div class="text-center">
                        <i class="fas fa-chart-line text-6xl text-blue-300 dark:text-blue-600 mb-4"></i>
                        <p class="text-gray-600 dark:text-gray-400">Chart visualization would go here</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div
            class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
            <div class="p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-6">Recent Activity</h3>
                <div class="space-y-4">
                    <template x-for="activity in recentActivity" :key="activity.id">
                        <div
                            class="flex items-start space-x-3 p-3 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                            <div :class="activity.iconBg" class="p-2 rounded-lg flex-shrink-0">
                                <i :class="activity.icon" class="text-sm text-white"></i>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-900 dark:text-gray-100"
                                   x-text="activity.title"></p>
                                <p class="text-xs text-gray-500 dark:text-gray-400"
                                   x-text="activity.description"></p>
                                <p class="text-xs text-gray-400 dark:text-gray-500 mt-1"
                                   x-text="activity.time"></p>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </div>
@endsection
