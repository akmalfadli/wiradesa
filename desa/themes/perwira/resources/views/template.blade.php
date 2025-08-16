@php
    $themeVersion = 'v2508.0.0';
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Website Resmi Desa Dayeuhkolot')</title>
    @include('theme::commons.meta')
    @include('theme::commons.source_css')
    @include('theme::commons.source_js')
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
</head>
<body class="w-full bg-white">
    <div class="max-w-6xl mx-auto">
        @include('theme::partials.header')
        @include('theme::partials.hero')
        
        @yield('layout')
    </div>
    
    @include('theme::partials.footer')

    <script>
        // Initialize Lucide icons
        lucide.createIcons();
    </script>
</body>
</html>