<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'News Portal - Latest News & Articles')</title>

    <!-- SEO Meta Tags -->
    <meta name="description" content="@yield('description', 'Stay updated with the latest news and articles')">
    <meta name="keywords" content="@yield('keywords', 'news, articles, breaking news, latest updates')">
    <meta name="author" content="News Portal">

    <!-- Open Graph -->
    <meta property="og:title" content="@yield('title', 'News Portal')">
    <meta property="og:description" content="@yield('description', 'Latest news and articles')">
    <meta property="og:image" content="@yield('og_image', asset('images/og-default.jpg'))">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', 'News Portal')">
    <meta name="twitter:description" content="@yield('description', 'Latest news and articles')">
    <meta name="twitter:image" content="@yield('og_image', asset('images/og-default.jpg'))">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>


    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Custom Styles -->
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }

        /* Smooth scroll */
        html {
            scroll-behavior: smooth;
        }

        /* Prose styling for article content */
        .prose {
            color: #374151;
            max-width: 65ch;
        }

        .prose h1, .prose h2, .prose h3, .prose h4 {
            color: #111827;
            font-weight: 700;
            margin-top: 2em;
            margin-bottom: 1em;
        }

        .prose h1 { font-size: 2.25em; }
        .prose h2 { font-size: 1.875em; }
        .prose h3 { font-size: 1.5em; }

        .prose p {
            margin-top: 1.25em;
            margin-bottom: 1.25em;
            line-height: 1.75;
        }

        .prose img {
            margin-top: 2em;
            margin-bottom: 2em;
            border-radius: 0.5rem;
        }

        .prose a {
            color: #2563eb;
            text-decoration: underline;
        }

        .prose ul, .prose ol {
            margin-top: 1.25em;
            margin-bottom: 1.25em;
            padding-left: 1.625em;
        }

        .prose li {
            margin-top: 0.5em;
            margin-bottom: 0.5em;
        }

        .prose blockquote {
            font-weight: 500;
            font-style: italic;
            color: #111827;
            border-left-width: 0.25rem;
            border-left-color: #e5e7eb;
            quotes: "\201C""\201D""\2018""\2019";
            margin-top: 1.6em;
            margin-bottom: 1.6em;
            padding-left: 1em;
        }

        /* Line clamp utilities */
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>

    @yield('styles')
</head>
<body class="bg-gray-50 text-gray-900">

<!-- Header/Navigation -->
@include('frontend.includes.header')

<!-- Main Content -->
<main>
    @yield('content')
</main>

<!-- Footer -->
@include('frontend.includes.footer')

<!-- Scroll to Top Button -->
<button id="scrollToTop"
        class="fixed bottom-8 right-8 w-12 h-12 bg-blue-600 hover:bg-blue-700 text-white rounded-full shadow-lg flex items-center justify-center opacity-0 invisible transition-all duration-300 z-50">
    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
    </svg>
</button>

<!-- Scripts -->
<script>
    // Scroll to top button
    const scrollToTopBtn = document.getElementById('scrollToTop');

    window.addEventListener('scroll', () => {
        if (window.pageYOffset > 300) {
            scrollToTopBtn.classList.remove('opacity-0', 'invisible');
        } else {
            scrollToTopBtn.classList.add('opacity-0', 'invisible');
        }
    });

    scrollToTopBtn.addEventListener('click', () => {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });

    // Mobile menu toggle
    function toggleMobileMenu() {
        const menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
    }

    // Search toggle
    function toggleSearch() {
        const searchModal = document.getElementById('search-modal');
        searchModal.classList.toggle('hidden');
        if (!searchModal.classList.contains('hidden')) {
            document.getElementById('search-input').focus();
        }
    }
</script>

@yield('scripts')
</body>
</html>
