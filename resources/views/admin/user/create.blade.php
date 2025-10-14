@extends('admin.master')

@section('content')
    <div class="max-w-4xl mx-auto">
        <!-- Page Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Add New User</h1>
                    <p class="text-gray-600 dark:text-gray-400 mt-1">Create a new user account with appropriate permissions</p>
                </div>
                <div class="flex space-x-3">
                    <button class="px-4 py-2 text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 flex items-center">
                        <i data-lucide="x" class="w-4 h-4 mr-2"></i>
                        Cancel
                    </button>
                </div>
            </div>
        </div>

        <!-- Progress Steps -->
        <div class="mb-8">
            <div class="flex items-center justify-center">
                <div class="flex items-center space-x-4">
                    <div class="flex items-center">
                        <div class="progress-step active w-8 h-8 rounded-full flex items-center justify-center text-sm font-semibold border-2 border-indigo-600">
                            1
                        </div>
                        <span class="ml-2 text-sm font-medium text-indigo-600">Basic Info</span>
                    </div>
                    <div class="w-12 h-1 bg-gray-200 dark:bg-gray-700 rounded"></div>
                    <div class="flex items-center">
                        <div class="progress-step w-8 h-8 rounded-full flex items-center justify-center text-sm font-semibold border-2 border-gray-300 dark:border-gray-600 bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400">
                            2
                        </div>
                        <span class="ml-2 text-sm font-medium text-gray-500 dark:text-gray-400">Permissions</span>
                    </div>
                    <div class="w-12 h-1 bg-gray-200 dark:bg-gray-700 rounded"></div>
                    <div class="flex items-center">
                        <div class="progress-step w-8 h-8 rounded-full flex items-center justify-center text-sm font-semibold border-2 border-gray-300 dark:border-gray-600 bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400">
                            3
                        </div>
                        <span class="ml-2 text-sm font-medium text-gray-500 dark:text-gray-400">Review</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- User Creation Form -->
        <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm">
            <form id="userForm" action="{{route('users.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- Step 1: Basic Information -->
                <div id="step1" class="p-8">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-6">Basic Information</h3>

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        <!-- Profile Photo Upload -->
                        <div class="lg:col-span-1">
                            <label  class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Profile Photo</label>
                            <div class="flex flex-col items-center">
                                <div class="w-32 h-32 bg-gray-200 dark:bg-gray-700 rounded-full flex items-center justify-center mb-4 overflow-hidden" id="imagePreview">
                                    <i data-lucide="user" class="w-12 h-12 text-gray-400" id="defaultIcon"></i>
                                    <img id="previewImg" class="w-full h-full object-cover hidden" alt="Preview">
                                </div>
                                <div  class="drag-area w-full p-4 border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg text-center hover:border-indigo-400 cursor-pointer">
                                    <input type="file" id="profilePhoto" name="profilePhoto" accept="image/*" class="hidden">
                                    <i data-lucide="upload-cloud" class="w-8 h-8 text-gray-400 mx-auto mb-2"></i>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Click to upload or drag and drop</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-500 mt-1">PNG, JPG up to 2MB</p>
                                </div>
                            </div>
                        </div>
                        <script>
                            document.querySelector('.drag-area').addEventListener('click', function () {
                                document.getElementById('profilePhoto').click();
                            });
                        </script>

                        <!-- Form Fields -->
                        <div class="lg:col-span-2">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- First Name -->
                                <div>
                                    <label for="firstName" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">First Name *</label>
                                    <div class="relative">
                                        <i data-lucide="user" class="absolute left-3 top-3 w-5 h-5 text-gray-400"></i>
                                        <input
                                            type="text"
                                            id="firstName"
                                            name="firstName"
                                            required
                                            class="form-input w-full pl-12 pr-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100"
                                            placeholder="Enter first name"
                                        >
                                    </div>
                                </div>

                                <!-- Last Name -->
                                <div>
                                    <label for="lastName" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Last Name *</label>
                                    <div class="relative">
                                        <i data-lucide="user" class="absolute left-3 top-3 w-5 h-5 text-gray-400"></i>
                                        <input
                                            type="text"
                                            id="lastName"
                                            name="lastName"
                                            required
                                            class="form-input w-full pl-12 pr-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100"
                                            placeholder="Enter last name"
                                        >
                                    </div>
                                </div>

                                <!-- Email -->
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Email Address *</label>
                                    <div class="relative">
                                        <i data-lucide="mail" class="absolute left-3 top-3 w-5 h-5 text-gray-400"></i>
                                        <input
                                            type="email"
                                            id="email"
                                            name="email"
                                            required
                                            class="form-input w-full pl-12 pr-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100"
                                            placeholder="Enter email address"
                                        >
                                    </div>
                                </div>

                                <!-- Phone -->
                                <div>
                                    <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Phone Number</label>
                                    <div class="relative">
                                        <i data-lucide="phone" class="absolute left-3 top-3 w-5 h-5 text-gray-400"></i>
                                        <input
                                            type="tel"
                                            id="phone"
                                            name="phone"
                                            class="form-input w-full pl-12 pr-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100"
                                            placeholder="Enter phone number"
                                        >
                                    </div>
                                </div>

                                <!-- Username -->
                                <div>
                                    <label for="username" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Username *</label>
                                    <div class="relative">
                                        <i data-lucide="at-sign" class="absolute left-3 top-3 w-5 h-5 text-gray-400"></i>
                                        <input
                                            type="text"
                                            id="username"
                                            name="username"
                                            required
                                            class="form-input w-full pl-12 pr-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100"
                                            placeholder="Enter username"
                                            onblur="checkUsername(this.value)"
                                        >
                                    </div>
                                    <p id="usernameMessage" class="text-xs mt-1 hidden"></p>
                                </div>

                                <!-- Role -->
                                <div>
                                    <label for="role" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Role *</label>
                                    <div class="relative">
                                        <i data-lucide="user-check" class="absolute left-3 top-3 w-5 h-5 text-gray-400"></i>
                                        @foreach($roles as $role)
                                            <select
                                                id="role"
                                                name="role"
                                                required
                                                class="form-input w-full pl-12 pr-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100"
                                            >
                                                <option value="">Select a role</option>
                                                <option value="{{$role->id}}">{{$role->name}}</option>
{{--                                                <option value="manager">Manager</option>--}}
{{--                                                <option value="editor">Editor</option>--}}
{{--                                                <option value="user">User</option>--}}
{{--                                                <option value="viewer">Viewer</option>--}}
                                            </select>
                                        @endforeach

                                    </div>
                                </div>
                            </div>

                            <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Department -->
                                <div>
                                    <label for="department" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Department</label>
                                    <div class="relative">
                                        <i data-lucide="building" class="absolute left-3 top-3 w-5 h-5 text-gray-400"></i>
                                        <select
                                            id="department"
                                            name="department"
                                            class="form-input w-full pl-12 pr-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100"
                                        >
                                            <option value="">Select department</option>
                                            <option value="it">IT & Technology</option>
                                            <option value="hr">Human Resources</option>
                                            <option value="finance">Finance</option>
                                            <option value="marketing">Marketing</option>
                                            <option value="sales">Sales</option>
                                            <option value="support">Customer Support</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Status -->
                                <div>
                                    <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Status *</label>
                                    <div class="relative">
                                        <i data-lucide="activity" class="absolute left-3 top-3 w-5 h-5 text-gray-400"></i>
                                        <select
                                            id="status"
                                            name="status"
                                            required
                                            class="form-input w-full pl-12 pr-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100"
                                        >
                                            <option value="active">Active</option>
                                            <option value="inactive">Inactive</option>
                                            <option value="pending">Pending</option>
                                            <option value="suspended">Suspended</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Password Section -->
                    <div class="mt-8 border-t dark:border-gray-700 pt-8">
                        <h4 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-6">Account Security</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Password -->
                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Password *</label>
                                <div class="relative">
                                    <i data-lucide="lock" class="absolute left-3 top-3 w-5 h-5 text-gray-400"></i>
                                    <input
                                        type="password"
                                        id="password"
                                        name="password"
                                        required
                                        minlength="8"
                                        class="form-input w-full pl-12 pr-12 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100"
                                        placeholder="Create password"
                                        oninput="checkPasswordStrength(this.value)"
                                    >
                                    <button type="button" class="absolute right-3 top-3 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300" onclick="togglePassword('password')">
                                        <i data-lucide="eye" id="togglePasswordIcon"></i>
                                    </button>
                                </div>
                                <!-- Password Strength Indicator -->
                                <div class="mt-2">
                                    <div class="flex justify-between items-center mb-1">
                                        <span class="text-xs text-gray-500 dark:text-gray-400">Password Strength</span>
                                        <span class="text-xs text-gray-500 dark:text-gray-400" id="strengthText">Weak</span>
                                    </div>
                                    <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                                        <div class="password-strength h-2 rounded-full strength-weak" id="strengthBar"></div>
                                    </div>
                                </div>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">
                                    Password must be at least 8 characters with uppercase, lowercase, number and special character
                                </p>
                            </div>

                            <!-- Confirm Password -->
                            <div>
                                <label for="confirmPassword" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Confirm Password *</label>
                                <div class="relative">
                                    <i data-lucide="lock" class="absolute left-3 top-3 w-5 h-5 text-gray-400"></i>
                                    <input
                                        type="password"
                                        id="confirmPassword"
                                        name="confirmPassword"
                                        required
                                        class="form-input w-full pl-12 pr-12 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100"
                                        placeholder="Confirm password"
                                        oninput="checkPasswordMatch()"
                                    >
                                    <button type="button" class="absolute right-3 top-3 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300" onclick="togglePassword('confirmPassword')">
                                        <i data-lucide="eye" id="toggleConfirmPasswordIcon"></i>
                                    </button>
                                </div>
                                <p id="passwordMatchMessage" class="text-xs mt-1 hidden"></p>
                            </div>
                        </div>
                    </div>

                    <!-- Additional Options -->
                    <div class="mt-8 border-t dark:border-gray-700 pt-8">
                        <h4 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-6">Additional Settings</h4>
                        <div class="space-y-4">
                            <div class="flex items-center">
                                <input
                                    type="checkbox"
                                    id="sendWelcomeEmail"
                                    name="sendWelcomeEmail"
                                    class="w-4 h-4 text-indigo-600 border-gray-300 dark:border-gray-600 rounded focus:ring-indigo-500"
                                    checked
                                >
                                <label for="sendWelcomeEmail" class="ml-3 text-sm text-gray-700 dark:text-gray-300">
                                    Send welcome email to the user
                                </label>
                            </div>

                            <div class="flex items-center">
                                <input
                                    type="checkbox"
                                    id="forcePasswordChange"
                                    name="forcePasswordChange"
                                    class="w-4 h-4 text-indigo-600 border-gray-300 dark:border-gray-600 rounded focus:ring-indigo-500"
                                >
                                <label for="forcePasswordChange" class="ml-3 text-sm text-gray-700 dark:text-gray-300">
                                    Force password change on first login
                                </label>
                            </div>

                            <div class="flex items-center">
                                <input
                                    type="checkbox"
                                    id="enableTwoFactor"
                                    name="enableTwoFactor"
                                    class="w-4 h-4 text-indigo-600 border-gray-300 dark:border-gray-600 rounded focus:ring-indigo-500"
                                >
                                <label for="enableTwoFactor" class="ml-3 text-sm text-gray-700 dark:text-gray-300">
                                    Enable two-factor authentication
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="mt-8 pt-8 border-t flex justify-between border-gray-200 dark:border-gray-700">
                        <button type="button"
                                class="px-6 py-3 text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 flex items-center">
                            <i data-lucide="arrow-left" class="w-4 h-4 mr-2"></i>
                            Back to Users
                        </button>
                        <div class="flex space-x-3">
                            <button type="button"
                                    class="px-6 py-3 text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700">
                                Save as Draft
                            </button>
                            <button type="submit"
                                    class="px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 flex items-center">
                                Create User
                                <i data-lucide="user-plus" class="w-4 h-4 ml-2"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
