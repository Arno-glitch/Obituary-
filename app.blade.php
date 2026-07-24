<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Task 6.1: dynamic meta tags --}}
    <title>@yield('title', 'Obituary Platform')</title>
    <meta name="description" content="@yield('meta_description', 'Submit, browse, and remember loved ones on the Obituary Platform.')">
    <meta name="keywords" content="@yield('meta_keywords', 'obituary, obituaries, memorial, remembrance')">

    {{-- Task 6.5: canonical tag --}}
    <link rel="canonical" href="@yield('canonical_url', url()->current())">

    {{-- Task 6.3: Open Graph tags for social sharing --}}
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:title" content="@yield('og_title', 'Obituary Platform')">
    <meta property="og:description" content="@yield('og_description', 'Submit, browse, and remember loved ones on the Obituary Platform.')">
    <meta property="og:url" content="@yield('og_url', url()->current())">
    <meta property="og:site_name" content="Obituary Platform">
    <meta name="twitter:card" content="summary">

    {{-- Task 6.2: schema.org structured data --}}
    @yield('structured_data')

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @stack('styles')
</head>
<body>
    <header class="site-header">
        <a href="{{ route('obituaries.index') }}" class="brand">Obituary Platform</a>
        <nav>
            <a href="{{ route('obituaries.index') }}">Browse</a>
            <a href="{{ route('obituaries.create') }}">Submit an Obituary</a>
        </nav>
    </header>

    <main class="container">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="site-footer">
        <p>&copy; {{ date('Y') }} Obituary Platform. All rights reserved.</p>
    </footer>

    <script src="{{ asset('js/validate.js') }}"></script>
    @stack('scripts')
</body>
</html>
