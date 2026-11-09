<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Barangay Bulletin – Purok Yuson')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-50 text-slate-900 antialiased">
    <header class="border-b border-slate-200 bg-white">
        <nav class="mx-auto flex max-w-7xl flex-col gap-4 px-4 py-4 sm:flex-row sm:items-center sm:justify-between sm:px-6 lg:px-8" aria-label="Main navigation">
            <a href="{{ route('posts.index') }}" class="text-xl font-bold tracking-tight text-emerald-800">
                Barangay Bulletin <span class="text-sm font-medium text-slate-500">– Purok Yuson</span>
            </a>

            <a href="{{ route('posts.index') }}" class="text-sm font-medium text-emerald-700 hover:text-emerald-900">
                Browse posts
            </a>
        </nav>
    </header>

    <main class="mx-auto min-h-[calc(100vh-9rem)] max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        @yield('content')
    </main>

    <footer class="border-t border-slate-200 bg-white">
        <div class="mx-auto max-w-7xl px-4 py-4 text-sm text-slate-500 sm:px-6 lg:px-8">
            Barangay Bulletin – Purok Yuson
        </div>
    </footer>
</body>
</html>
