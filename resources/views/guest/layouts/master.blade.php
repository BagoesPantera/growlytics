<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name', 'Growlytics') }}</title>

    @stack('meta')

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>
<body class="min-h-screen bg-[#F7FAFC] text-[#172B44] antialiased">
    @include('guest.layouts.partials.header')

    <main class="flex-1">
        @yield('content')
    </main>

    @include('guest.layouts.partials.footer')

    @stack('scripts')
</body>
</html>
