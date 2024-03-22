<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="flex items-center justify-center min-h-screen bg-blue-100">
        <div class="text-center">
            <h1 class="text-5xl font-bold text-gray-800 mb-6">Welcome to {{ config('app.name', 'Laravel') }}</h1>
            <p class="mb-6 text-lg text-gray-600">A simple, modern web application.</p>
            @if (Route::has('login'))
                <div class="space-x-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="px-4 py-2 bg-blue-500 hover:bg-blue-700 text-white rounded-lg">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="px-4 py-2 bg-green-500 hover:bg-green-700 text-white rounded-lg">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-4 py-2 bg-gray-500 hover:bg-gray-700 text-white rounded-lg">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
    </div>
</body>
</html>