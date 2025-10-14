@extends('admin.master')

@section('title', 'Analytics Dashboard')

@section('content')

    <div class="container mx-auto px-4 py-8">

        <h1 class="text-3xl font-bold mb-8">Visitor Analytics</h1>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <!-- Total Visitors -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600">Total Visitors</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">{{ number_format($stats['total']) }}</p>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Today -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600">Today</p>
                        <p class="text-3xl font-bold text-green-600 mt-2">{{ number_format($stats['today']) }}</p>
                        <p class="text-xs text-gray-500 mt-1">{{ $uniqueVisitors['today'] }} unique</p>
                    </div>
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- This Week -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600">This Week</p>
                        <p class="text-3xl font-bold text-purple-600 mt-2">{{ number_format($stats['this_week']) }}</p>
                        <p class="text-xs text-gray-500 mt-1">{{ $uniqueVisitors['week'] }} unique</p>
                    </div>
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- This Month -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600">This Month</p>
                        <p class="text-3xl font-bold text-orange-600 mt-2">{{ number_format($stats['this_month']) }}</p>
                        <p class="text-xs text-gray-500 mt-1">{{ $uniqueVisitors['month'] }} unique</p>
                    </div>
                    <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <!-- Device Stats -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h3 class="text-lg font-bold mb-4">Devices</h3>
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">📱 Mobile</span>
                        <span class="font-bold">{{ number_format($stats['by_device']['mobile']) }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">💻 Desktop</span>
                        <span class="font-bold">{{ number_format($stats['by_device']['desktop']) }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">📱 Tablet</span>
                        <span class="font-bold">{{ number_format($stats['by_device']['tablet']) }}</span>
                    </div>
                </div>
            </div>

            <!-- Top Browsers -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h3 class="text-lg font-bold mb-4">Top Browsers</h3>
                <div class="space-y-3">
                    @foreach($stats['top_browsers'] as $browser)
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">{{ $browser->browser }}</span>
                            <span class="font-bold">{{ number_format($browser->count) }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Top Countries -->
        <div class="bg-white rounded-xl shadow-md p-6 mb-8">
            <h3 class="text-lg font-bold mb-4">Top Countries</h3>
            <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
                @foreach($stats['top_countries'] as $country)
                    <div class="text-center p-4 bg-gray-50 rounded-lg">
                        <p class="text-2xl mb-2">🌍</p>
                        <p class="font-bold">{{ $country->country }}</p>
                        <p class="text-sm text-gray-600">{{ number_format($country->count) }} visits</p>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Recent Visitors -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-bold">Recent Visitors</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">IP</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Location</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Device</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Browser</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Page</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Time</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                    @foreach($recentVisitors as $visitor)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm">{{ $visitor->ip_address }}</td>
                            <td class="px-6 py-4 text-sm">
                                {{ $visitor->city ? $visitor->city . ', ' : '' }}{{ $visitor->country }}
                            </td>
                            <td class="px-6 py-4 text-sm">{{ ucfirst($visitor->device_type) }}</td>
                            <td class="px-6 py-4 text-sm">{{ $visitor->browser }}</td>
                            <td class="px-6 py-4 text-sm truncate max-w-xs">
                                <a href="{{ $visitor->url }}" target="_blank" class="text-blue-600 hover:underline">
                                    {{ Str::limit($visitor->url, 50) }}
                                </a>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                {{ $visitor->visited_at->diffForHumans() }}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>

@endsection
