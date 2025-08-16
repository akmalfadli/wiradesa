@php
    $themeVersion = 'v2508.0.0';
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Website Resmi Desa Dayeuhkolot')</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
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
        
        <div class="px-4 md:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row gap-8 mt-8">
                @include('theme::partials.history')
                @include('theme::partials.location')
            </div>
            
            <div class="flex flex-col md:flex-row gap-8 mt-16">
                @include('theme::partials.development')
                @include('theme::partials.vision')
            </div>
            
            @include('theme::partials.statistics')
            @include('theme::partials.articles')
            @include('theme::partials.officials')
        </div>
    </div>
    
    @include('theme::partials.footer')

    <script>
        // Initialize Lucide icons
        lucide.createIcons();
    </script>
</body>
</html>