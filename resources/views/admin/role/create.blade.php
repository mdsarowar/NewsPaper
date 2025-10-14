@extends('admin.master')
@section('content')
    <div class="p-6 ">

        <!-- Page Header -->
        <div class="mb-8">
{{--            <div class="flex items-center space-x-4 mb-4">--}}
{{--                <a href="/admin/roles"--}}
{{--                   class="flex items-center text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">--}}
{{--                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">--}}
{{--                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"--}}
{{--                              d="M15 19l-7-7 7-7"></path>--}}
{{--                    </svg>--}}
{{--                    Back to Roles--}}
{{--                </a>--}}
{{--            </div>--}}

            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Create New Role</h1>
                    <p class="text-gray-600 dark:text-gray-400 mt-1">Create a new role with specific permissions</p>
                </div>

                <!-- Help Button -->
{{--                <div class="bg-blue-50 dark:bg-blue-900/20 p-4 rounded-lg border  dark:border-blue-800">--}}
                    <div class="mt-4 sm:mt-0 flex flex-col sm:flex-row gap-3">
                        <a href="{{route('roles.index')}}" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl flex items-center justify-center"><i class="fas fa-plus mr-2"></i>Manage Role</a>
                        {{--                <button @click="showAddUserModal = true"--}}
                        {{--                        class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl flex items-center justify-center">--}}
                        {{--                    <i class="fas fa-plus mr-2"></i>Add User--}}
                        {{--                </button>--}}
                        <button class="px-4 py-2 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 rounded-lg transition-colors flex items-center justify-center">
                            <i class="fas fa-download mr-2"></i>Export
                        </button>
                    </div>
{{--                </div>--}}
            </div>
        </div>

        <!-- Create Role Form -->
        <div class="flex items-center justify-center min-h-screen p-6">
            <div class="w-full max-w-2xl">  <!-- ✅ form width সীমিত -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">

                    <!-- Form Header -->
                    <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                            <div
                                class="w-8 h-8 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center mr-3">
                                <svg class="w-4 h-4 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor"
                                     viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                </svg>
                            </div>
                            Role Information
                        </h3>
                        <p class="text-gray-600 dark:text-gray-400 text-sm mt-1 ml-11">Fill in the role details below</p>
                    </div>

                    <!-- Form Content -->
                    <form action="{{route('roles.store')}}" method="POST" class="p-6">
                        @csrf

                        <div class="space-y-6">

                            <!-- Role Name -->
                            <div>
                                <label for="name"
                                       class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Role Name *
                                    <span class="text-gray-500 dark:text-gray-400 text-xs ml-1">(Used internally, lowercase with hyphens)</span>
                                </label>
                                <input type="text"
                                       id="name"
                                       name="name"
                                       value="{{ old('name') }}"
                                       placeholder="e.g., content-editor, sales-manager"
                                       class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                       required>
                                @error('name')
                                <p class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Display Name -->
                            <div>
                                <label for="display_name"
                                       class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Display Name *
                                    <span class="text-gray-500 dark:text-gray-400 text-xs ml-1">(Human readable name)</span>
                                </label>
                                <input type="text"
                                       id="display_name"
                                       name="display_name"
                                       value="{{ old('display_name') }}"
                                       placeholder="e.g., Content Editor, Sales Manager"
                                       class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                       required>
                                @error('display_name')
                                <p class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Description -->
                            <div>
                                <label for="description"
                                       class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Description
                                    <span class="text-gray-500 dark:text-gray-400 text-xs ml-1">(Optional)</span>
                                </label>
                                <textarea id="description"
                                          name="description"
                                          rows="4"
                                          placeholder="Brief description of this role's purpose and responsibilities..."
                                          class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 resize-none">{{ old('description') }}</textarea>
                                @error('description')
                                <p class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Status -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">
                                    Status
                                </label>
                                <div class="flex items-center space-x-6">
                                    <label class="flex items-center">
                                        <input type="radio"
                                               name="is_active"
                                               value="1"
                                               {{ old('is_active', '1') == '1' ? 'checked' : '' }}
                                               class="w-4 h-4 text-blue-600 bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600 focus:ring-blue-500 focus:ring-2">
                                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Active</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="radio"
                                               name="is_active"
                                               value="0"
                                               {{ old('is_active') == '0' ? 'checked' : '' }}
                                               class="w-4 h-4 text-blue-600 bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600 focus:ring-blue-500 focus:ring-2">
                                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Inactive</span>
                                    </label>
                                </div>
                            </div>

                        </div>

                        <!-- Form Actions -->
                        <div class="flex items-center justify-between pt-8 border-t border-gray-200 dark:border-gray-700 mt-8">
                            <div class="text-sm text-gray-500 dark:text-gray-400">
                                * Required fields
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
                                    Create Role
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <!-- Additional Info Cards -->
{{--        <div class="grid md:grid-cols-2 gap-6 mt-8 max-w-2xl">--}}

{{--            <!-- Next Steps Card -->--}}
{{--            <div--}}
{{--                class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg p-4">--}}
{{--                <div class="flex items-start">--}}
{{--                    <div--}}
{{--                        class="w-8 h-8 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center mr-3">--}}
{{--                        <svg class="w-4 h-4 text-green-600 dark:text-green-400" fill="none" stroke="currentColor"--}}
{{--                             viewBox="0 0 24 24">--}}
{{--                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"--}}
{{--                                  d="M13 10V3L4 14h7v7l9-11h-7z"></path>--}}
{{--                        </svg>--}}
{{--                    </div>--}}
{{--                    <div>--}}
{{--                        <h4 class="font-semibold text-green-900 dark:text-green-100 text-sm">Next Steps</h4>--}}
{{--                        <p class="text-green-700 dark:text-green-300 text-xs mt-1">After creating, assign permissions to--}}
{{--                            this role</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <!-- Best Practices Card -->--}}
{{--            <div--}}
{{--                class="bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-800 rounded-lg p-4">--}}
{{--                <div class="flex items-start">--}}
{{--                    <div--}}
{{--                        class="w-8 h-8 bg-amber-100 dark:bg-amber-900/30 rounded-lg flex items-center justify-center mr-3">--}}
{{--                        <svg class="w-4 h-4 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor"--}}
{{--                             viewBox="0 0 24 24">--}}
{{--                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"--}}
{{--                                  d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>--}}
{{--                        </svg>--}}
{{--                    </div>--}}
{{--                    <div>--}}
{{--                        <h4 class="font-semibold text-amber-900 dark:text-amber-100 text-sm">Best Practices</h4>--}}
{{--                        <p class="text-amber-700 dark:text-amber-300 text-xs mt-1">Keep role names descriptive and follow--}}
{{--                            naming conventions</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>
@endsection
