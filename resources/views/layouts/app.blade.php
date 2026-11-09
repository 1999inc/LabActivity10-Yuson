<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Bakuna Tracker')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-50 text-slate-900 antialiased">
    <header class="border-b border-slate-200 bg-white">
        <nav class="mx-auto flex max-w-7xl flex-col gap-4 px-4 py-4 sm:flex-row sm:items-center sm:justify-between sm:px-6 lg:px-8" aria-label="Main navigation">
            <a href="{{ route('dashboard') }}" class="text-xl font-bold tracking-tight text-emerald-800">
                Bakuna Tracker
            </a>

            @auth
                <div class="flex flex-wrap items-center gap-4 text-sm">
                    <a href="{{ route('dashboard') }}" class="font-medium text-slate-700 hover:text-emerald-700">Dashboard</a>
                    <a href="{{ route('schedule') }}" class="font-medium text-slate-700 hover:text-emerald-700">Schedule</a>
                    <span class="text-slate-600">Hi, {{ auth()->user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="rounded-md border border-slate-300 px-3 py-2 font-medium text-slate-700 hover:bg-slate-100">
                            Log out
                        </button>
                    </form>
                </div>
            @endauth

            @guest
                <a href="{{ route('login') }}" class="text-sm font-medium text-emerald-700 hover:text-emerald-900">Sign in</a>
            @endguest
        </nav>
    </header>

    <main class="mx-auto min-h-[calc(100vh-9rem)] max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        @yield('content')
    </main>

    <footer class="border-t border-slate-200 bg-white">
        <div class="mx-auto max-w-7xl px-4 py-4 text-sm text-slate-500 sm:px-6 lg:px-8">
            Barangay Bakuna Tracker
        </div>
    </footer>
</body>
</html>
