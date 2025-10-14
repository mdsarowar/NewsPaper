@extends('admin.master')
@section('content')

    <!-- Main Content Area -->
    <div class="p-6">

        <!-- Page Header -->
        <div class="mb-8">
            <!-- Breadcrumb -->
            <div class="flex items-center space-x-2 text-sm text-gray-600 dark:text-gray-400 mb-4">
                <a href="" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Roles</a>
                <svg class="w-4 h-4 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <span class="text-gray-900 dark:text-white font-medium">{{ $role->display_name ?? 'Content Editor' }}</span>
                <svg class="w-4 h-4 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <span class="text-gray-700 dark:text-gray-300">Assign Permissions</span>
            </div>

            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between space-y-4 lg:space-y-0">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Assign Permissions</h1>
                    <p class="text-gray-600 dark:text-gray-400 mt-1">
                        Configure permissions for <span class="font-semibold text-blue-600 dark:text-blue-400">{{ $role->display_name ?? 'Content Editor' }}</span> role
                    </p>
                </div>

                <!-- Quick Stats -->
                <div class="flex items-center space-x-4">
                    <div class="bg-blue-50 dark:bg-blue-900/20 px-4 py-2 rounded-lg border border-blue-200 dark:border-blue-800">
                        <div class="text-xs text-blue-700 dark:text-blue-300">Total Permissions</div>
                        <div class="text-lg font-bold text-blue-900 dark:text-blue-100">{{ $totalPermissions ?? '32' }}</div>
                    </div>
                    <div class="bg-green-50 dark:bg-green-900/20 px-4 py-2 rounded-lg border border-green-200 dark:border-green-800">
                        <div class="text-xs text-green-700 dark:text-green-300">Currently Assigned</div>
                        <div class="text-lg font-bold text-green-900 dark:text-green-100">{{ $assignedCount ?? '12' }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Role Information Card -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 mb-8">
            <div class="p-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl flex items-center justify-center">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                            </svg>
                        </div>

                        <div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white">{{ $role->display_name ?? 'Content Editor' }}</h3>
                            <p class="text-gray-600 dark:text-gray-400">{{ $role->name ?? 'content-editor' }}</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ $role->description ?? 'Manages content creation and editing' }}</p>
                        </div>
                    </div>

                    <div class="flex items-center space-x-3">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ ($role->is_active ?? true) ? 'bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300' : 'bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-300' }}">
                            <div class="w-2 h-2 rounded-full {{ ($role->is_active ?? true) ? 'bg-green-500' : 'bg-red-500' }} mr-2"></div>
                            {{ ($role->is_active ?? true) ? 'Active' : 'Inactive' }}
                        </span>

                        <div class="text-right text-sm text-gray-500 dark:text-gray-400">
                            <div>Created: {{ $role->created_at ?? 'Jan 15, 2025' }}</div>
                            <div>Users: {{ $role->users_count ?? '5' }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Permission Assignment Form -->
        <form action="{{route('updateroletopermission',$role->id)}}" method="POST">
            @csrf
            @method('PUT')

            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">

                <!-- Form Header -->
                <div class="p-4 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Permission Assignment</h3>

                    <!-- Bulk Actions -->
                    <div class="flex items-center space-x-3">
                        <button type="button" onclick="selectAll()"
                                class="text-sm text-blue-600 dark:text-blue-400 hover:underline">
                            Select All
                        </button>
                        <span class="text-gray-300 dark:text-gray-600">|</span>
                        <button type="button" onclick="deselectAll()"
                                class="text-sm text-gray-600 dark:text-gray-400 hover:underline">
                            Deselect All
                        </button>
                    </div>
                </div>

                <!-- Permissions Table -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Category
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Permissions
                            </th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Select All
                            </th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700 bg-white dark:bg-gray-900">

                        <!-- Example: User Management -->
                           @foreach($permissions as $category=> $perms)
                        <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">
                                    {{$category}}-Management
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-wrap gap-6">
                                        @foreach($perms as $permission)
                                            <label class="flex items-center space-x-2">
                                                <input type="checkbox" name="permissions[]" value="{{$permission->id}}" class="perm-{{$category}}">
                                                <span class="text-gray-700 dark:text-gray-300">{{$permission->name}}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <input type="checkbox" onclick="toggleGroup('perm-{{$category}}', this)"
                                           class="w-5 h-5 text-blue-600 dark:bg-gray-700 dark:border-gray-600 rounded">
                                </td>
                        </tr>
                           @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="flex space-x-3">
                    <a href=""
                       class="px-6 py-3 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 focus:ring-2 focus:ring-gray-500 transition-all duration-200">
                        Cancel
                    </a>

                    <button type="submit"
                            class="px-8 py-3 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold rounded-lg focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-100 dark:focus:ring-offset-gray-900 transition-all duration-200 transform hover:scale-[1.02] shadow-lg">
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Submit
                    </button>
                </div>
            </div>
        </form>

        <!-- Help Section -->
        <div class="mt-8 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-xl p-6">
            <div class="flex items-start space-x-4">
                <div class="w-10 h-10 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <h4 class="font-semibold text-blue-900 dark:text-blue-100 mb-2">Permission Guidelines</h4>
                    <div class="text-blue-800 dark:text-blue-200 text-sm space-y-2">
                        <p><strong>🔵 Regular Permissions:</strong> Standard access controls for daily operations</p>
                        <p><strong>🟣 Special Permissions:</strong> Advanced features with additional functionality</p>
                        <p><strong>🔴 Dangerous Permissions:</strong> High-risk actions that can affect system security</p>
                        <p><strong>🟠 Admin Only:</strong> Restricted to super administrators only</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Global select all
        function selectAll() {
            document.querySelectorAll('input[type="checkbox"]').forEach(cb => cb.checked = true);
        }

        function deselectAll() {
            document.querySelectorAll('input[type="checkbox"]').forEach(cb => cb.checked = false);
        }

        // Per-group select all
        function toggleGroup(groupClass, checkbox) {
            document.querySelectorAll('.' + groupClass).forEach(cb => cb.checked = checkbox.checked);
        }
    </script>

@endsection
