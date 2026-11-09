@props(['title'])

<div class="mb-6">
    <h1 class="text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">{{ $title }}</h1>
    @if (trim($slot) !== '')
        <p class="mt-2 text-sm text-slate-600">{{ $slot }}</p>
    @endif
</div>
