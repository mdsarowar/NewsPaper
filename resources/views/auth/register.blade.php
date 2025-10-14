<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lucide/0.263.1/umd/lucide.js"></script>
    @include('auth.auth_includes.assets.css')
</head>
<body class="min-h-screen gradient-bg flex items-center justify-center p-4">

<!-- Background Animation Elements -->
<div class="absolute inset-0 overflow-hidden">
    <div class="absolute top-10 left-10 w-20 h-20 bg-white/10 rounded-full floating-animation" style="animation-delay: 0s;"></div>
    <div class="absolute top-32 right-20 w-16 h-16 bg-white/10 rounded-full floating-animation" style="animation-delay: 1s;"></div>
    <div class="absolute bottom-20 left-32 w-24 h-24 bg-white/10 rounded-full floating-animation" style="animation-delay: 2s;"></div>
    <div class="absolute bottom-32 right-10 w-12 h-12 bg-white/10 rounded-full floating-animation" style="animation-delay: 1.5s;"></div>
    <div class="absolute top-1/2 left-1/4 w-8 h-8 bg-white/10 rounded-full floating-animation" style="animation-delay: 0.5s;"></div>
    <div class="absolute top-1/4 right-1/3 w-14 h-14 bg-white/10 rounded-full floating-animation" style="animation-delay: 2.5s;"></div>
</div>

<!-- Registration Card -->
<div class="glass-effect rounded-2xl p-8 w-full max-w-md shadow-2xl fade-in relative z-10">
    <!-- Logo/Brand -->
    <div class="text-center mb-8">
        <div class="mx-auto w-16 h-16 bg-white rounded-full flex items-center justify-center mb-4 glow-effect">
            <i data-lucide="user-plus" class="w-8 h-8 text-indigo-600"></i>
        </div>
        <h1 class="text-3xl font-bold text-white mb-2">Create Account</h1>
        <p class="text-white/80">Join our admin panel today</p>
    </div>

    <!-- Registration Form -->
    <form class="space-y-6" action="{{route('register.store')}}" method="POST" id="registrationForm">
        @csrf
        <!-- Full Name Field -->
        <div>
            <label for="fullname" class="block text-white/90 text-sm font-medium mb-2">Full Name</label>
            <div class="relative">
                <i data-lucide="user" class="absolute left-3 top-3 w-5 h-5 text-gray-400"></i>
                <input
                    type="text"
                    id="fullname"
                    name="name"
                    class="w-full pl-12 pr-4 py-3 bg-white/20 border border-white/30 rounded-lg text-white placeholder-white/60 focus:outline-none focus:ring-2 focus:ring-white/50 focus:border-white/50 input-focus"
                    placeholder="Enter your full name"
                    required
                    minlength="2"
                >
            </div>
        </div>

        <!-- Email Field -->
        <div>
            <label for="email" class="block text-white/90 text-sm font-medium mb-2">Email Address</label>
            <div class="relative">
                <i data-lucide="mail" class="absolute left-3 top-3 w-5 h-5 text-gray-400"></i>
                <input
                    type="email"
                    id="email"
                    name="email"
                    class="w-full pl-12 pr-4 py-3 bg-white/20 border border-white/30 rounded-lg text-white placeholder-white/60 focus:outline-none focus:ring-2 focus:ring-white/50 focus:border-white/50 input-focus"
                    placeholder="Enter your email address"
                    required
                >
            </div>
        </div>

        <!-- Phone Number Field -->
{{--        <div>--}}
{{--            <label for="phone" class="block text-white/90 text-sm font-medium mb-2">Phone Number</label>--}}
{{--            <div class="relative">--}}
{{--                <i data-lucide="phone" class="absolute left-3 top-3 w-5 h-5 text-gray-400"></i>--}}
{{--                <input--}}
{{--                    type="tel"--}}
{{--                    id="phone"--}}
{{--                    name="phone"--}}
{{--                    class="w-full pl-12 pr-4 py-3 bg-white/20 border border-white/30 rounded-lg text-white placeholder-white/60 focus:outline-none focus:ring-2 focus:ring-white/50 focus:border-white/50 input-focus"--}}
{{--                    placeholder="Enter your phone number"--}}
{{--                    required--}}
{{--                >--}}
{{--            </div>--}}
{{--        </div>--}}

        <!-- Password Field -->
        <div>
            <label for="password" class="block text-white/90 text-sm font-medium mb-2">Password</label>
            <div class="relative">
                <i data-lucide="lock" class="absolute left-3 top-3 w-5 h-5 text-gray-400"></i>
                <input
                    type="password"
                    id="password"
                    name="password"
                    class="w-full pl-12 pr-12 py-3 bg-white/20 border border-white/30 rounded-lg text-white placeholder-white/60 focus:outline-none focus:ring-2 focus:ring-white/50 focus:border-white/50 input-focus"
                    placeholder="Create a strong password"
                    required
                    minlength="8"
                    oninput="checkPasswordStrength(this.value)"
                >
                <button type="button" class="absolute right-3 top-3 text-gray-400 hover:text-white" onclick="togglePassword('password')">
                    <i data-lucide="eye" id="togglePasswordIcon"></i>
                </button>
            </div>
            <!-- Password Strength Indicator -->
            <div class="mt-2">
                <div class="flex justify-between items-center mb-1">
                    <span class="text-xs text-white/70">Password Strength</span>
                    <span class="text-xs text-white/70" id="strengthText">Weak</span>
                </div>
                <div class="w-full bg-white/20 rounded-full h-2">
                    <div class="progress-bar h-2 rounded-full strength-weak" style="width: 25%" id="strengthBar"></div>
                </div>
            </div>
        </div>

        <!-- Confirm Password Field -->
        <div>
            <label for="confirmPassword" class="block text-white/90 text-sm font-medium mb-2">Confirm Password</label>
            <div class="relative">
                <i data-lucide="lock" class="absolute left-3 top-3 w-5 h-5 text-gray-400"></i>
                <input
                    type="password"
                    id="confirmPassword"
                    name="confirmPassword"
                    class="w-full pl-12 pr-12 py-3 bg-white/20 border border-white/30 rounded-lg text-white placeholder-white/60 focus:outline-none focus:ring-2 focus:ring-white/50 focus:border-white/50 input-focus"
                    placeholder="Confirm your password"
                    required
                    oninput="checkPasswordMatch()"
                >
                <button type="button" class="absolute right-3 top-3 text-gray-400 hover:text-white" onclick="togglePassword('confirmPassword')">
                    <i data-lucide="eye" id="toggleConfirmPasswordIcon"></i>
                </button>
            </div>
            <div id="passwordMatchMessage" class="text-xs mt-1 hidden"></div>
        </div>

        <!-- Role Selection -->
{{--        <div>--}}
{{--            <label for="role" class="block text-white/90 text-sm font-medium mb-2">Role</label>--}}
{{--            <div class="relative">--}}
{{--                <i data-lucide="user-check" class="absolute left-3 top-3 w-5 h-5 text-gray-400"></i>--}}
{{--                <select--}}
{{--                    id="role"--}}
{{--                    name="role"--}}
{{--                    class="w-full pl-12 pr-4 py-3 bg-white/20 border border-white/30 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-white/50 focus:border-white/50 input-focus"--}}
{{--                    required--}}
{{--                >--}}
{{--                    <option value="" class="text-gray-900">Select your role</option>--}}
{{--                    <option value="admin" class="text-gray-900">Administrator</option>--}}
{{--                    <option value="manager" class="text-gray-900">Manager</option>--}}
{{--                    <option value="user" class="text-gray-900">User</option>--}}
{{--                    <option value="editor" class="text-gray-900">Editor</option>--}}
{{--                </select>--}}
{{--            </div>--}}
{{--        </div>--}}

        <!-- Terms and Conditions -->
        <div class="flex items-start">
            <input
                type="checkbox"
                id="terms"
                name="terms"
                class="w-4 h-4 mt-1 rounded border-white/30 bg-white/20 text-indigo-600 focus:ring-indigo-500 focus:ring-2"
                required
            >
            <label for="terms" class="ml-3 text-white/80 text-sm">
                I agree to the
                <a href="#" class="text-white hover:text-white/80 font-semibold transition-colors duration-200">Terms of Service</a>
                and
                <a href="#" class="text-white hover:text-white/80 font-semibold transition-colors duration-200">Privacy Policy</a>
            </label>
        </div>

        <!-- Newsletter Subscription -->
        <div class="flex items-center">
            <input
                type="checkbox"
                id="newsletter"
                name="newsletter"
                class="w-4 h-4 rounded border-white/30 bg-white/20 text-indigo-600 focus:ring-indigo-500 focus:ring-2"
            >
            <label for="newsletter" class="ml-3 text-white/80 text-sm">
                Subscribe to our newsletter for updates and tips
            </label>
        </div>

        <!-- Register Button -->
        <button
            type="submit"
            class="w-full bg-white text-indigo-600 py-3 rounded-lg font-semibold hover:bg-white/90 transition duration-200 hover-scale focus:outline-none focus:ring-4 focus:ring-white/30"
        >
            Create Account
        </button>

        <!-- Divider -->
        <div class="relative my-6">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-white/30"></div>
            </div>
            <div class="relative flex justify-center text-sm">
                <span class="px-2 bg-transparent text-white/60">Or register with</span>
            </div>
        </div>

        <!-- Social Registration Buttons -->
        <div class="grid grid-cols-2 gap-3">
            <button
                type="button"
                class="flex items-center justify-center px-4 py-2 bg-white/20 border border-white/30 rounded-lg text-white hover:bg-white/30 transition-colors duration-200"
            >
                <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                    <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                    <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                    <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                </svg>
                Google
            </button>

            <button
                type="button"
                class="flex items-center justify-center px-4 py-2 bg-white/20 border border-white/30 rounded-lg text-white hover:bg-white/30 transition-colors duration-200"
            >
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                </svg>
                Facebook
            </button>
        </div>

        <!-- Sign In Link -->
        <div class="text-center">
            <span class="text-white/80 text-sm">Already have an account? </span>
            <a href="{{route('login')}}" class="text-white hover:text-white/80 text-sm font-semibold transition-colors duration-200">
                Sign in here
            </a>
        </div>
    </form>

    <!-- Footer -->
    <div class="mt-8 text-center">
        <p class="text-white/60 text-xs">
            By creating an account, you agree to our
            <a href="#" class="text-white/80 hover:text-white transition-colors duration-200">Terms</a>
            and
            <a href="#" class="text-white/80 hover:text-white transition-colors duration-200">Privacy Policy</a>
        </p>
    </div>
</div>

@include('auth.auth_includes.assets.js')
</body>
</html>
