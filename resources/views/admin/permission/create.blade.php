@extends('admin.master')
@section('content')
    <div class="p-6 ">
        <!-- Page Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Create New Permission</h1>
                    <p class="text-gray-600 dark:text-gray-400 mt-1">Create a new Permission with specific Role</p>
                </div>
                <div class="mt-4 sm:mt-0 flex flex-col sm:flex-row gap-3">
                    <a href="{{route('permissions.index')}}" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl flex items-center justify-center"><i class="fas fa-plus mr-2"></i>Manage Permission</a>
                    <button class="px-4 py-2 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 rounded-lg transition-colors flex items-center justify-center">
                        <i class="fas fa-download mr-2"></i>Export
                    </button>
                </div>
                {{--                </div>--}}
            </div>
        </div>

        <div class="flex justify-center p-6">

            <!-- Permission Form -->
            <div class="w-full max-w-2xl bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">

                <!-- Header -->
                <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                        <div class="w-8 h-8 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-4 h-4 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        Permission Information
                    </h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm mt-1 ml-11">Fill in permission details below</p>
                </div>

                <!-- Form Content -->
                <form action="{{ route('permissions.store') }}" method="POST" class="p-6">
                    @csrf
                    <div class="space-y-6">

                        <!-- Permission Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Permission Name *
                                <span class="text-gray-500 dark:text-gray-400 text-xs ml-1">(Internal name, lowercase with hyphens)</span>
                            </label>
                            <input type="text" id="name"
                                   name="name"
                                   value="{{ old('name') }}"
                                   placeholder="e.g., create-post, delete-user"
                                   class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200"
                                   required>
                            @error('name')
                            <p class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Display Name -->
                        <div>
                            <label for="display_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Display Name *
                                <span class="text-gray-500 dark:text-gray-400 text-xs ml-1">(Human readable)</span>
                            </label>
                            <input type="text"
                                   id="display_name"
                                   name="display_name"
                                   value="{{ old('display_name') }}"
                                   placeholder="e.g., Create Post, Delete User"
                                   class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200"
                                   required>
                            @error('display_name')
                            <p class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Description
                                <span class="text-gray-500 dark:text-gray-400 text-xs ml-1">(Optional)</span>
                            </label>
                            <textarea id="description"
                                      name="description"
                                      rows="4"
                                      placeholder="Brief description of this permission"
                                      class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200 resize-none">{{ old('description') }}</textarea>
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
                                    <input type="radio" name="is_active" value="1" {{ old('is_active', '1') == '1' ? 'checked' : '' }}
                                    class="w-4 h-4 text-green-600 bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600 focus:ring-green-500 focus:ring-2">
                                    <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Active</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="is_active" value="0" {{ old('is_active') == '0' ? 'checked' : '' }}
                                    class="w-4 h-4 text-green-600 bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600 focus:ring-green-500 focus:ring-2">
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
                            <a href="{{ route('permissions.index') }}"
                               class="px-6 py-3 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 focus:ring-2 focus:ring-gray-500 transition-all duration-200">
                                Cancel
                            </a>

                            <button type="submit"
                                    class="px-8 py-3 bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white font-semibold rounded-lg focus:ring-2 focus:ring-green-500 focus:ring-offset-2 focus:ring-offset-gray-100 dark:focus:ring-offset-gray-900 transition-all duration-200 transform hover:scale-[1.02] shadow-lg">
                                Create Permission
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
