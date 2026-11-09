@extends('layouts.app')

@section('title', 'Sign in')

@section('content')
    <div class="mx-auto max-w-md">
        <x-page-heading title="Health worker sign in">
            Sign in to view the barangay vaccination dashboard.
        </x-page-heading>

        <form method="POST" action="{{ route('login.store') }}" class="space-y-5 rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
            @csrf

            <div>
                <label for="email" class="mb-1 block text-sm font-medium text-slate-700">Email address</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" autocomplete="username" required autofocus
                       class="w-full rounded-md border border-slate-300 px-3 py-2 shadow-sm focus:border-emerald-600 focus:outline-none focus:ring-2 focus:ring-emerald-100">
                @error('email')
                    <p class="mt-1 text-sm text-rose-700">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="mb-1 block text-sm font-medium text-slate-700">Password</label>
                <input id="password" type="password" name="password" autocomplete="current-password" required
                       class="w-full rounded-md border border-slate-300 px-3 py-2 shadow-sm focus:border-emerald-600 focus:outline-none focus:ring-2 focus:ring-emerald-100">
                @error('password')
                    <p class="mt-1 text-sm text-rose-700">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="w-full rounded-md bg-emerald-700 px-4 py-2.5 font-semibold text-white hover:bg-emerald-800 focus:outline-none focus:ring-2 focus:ring-emerald-600 focus:ring-offset-2">
                Sign in
            </button>
        </form>
    </div>
@endsection
