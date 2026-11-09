@props(['status'])

@php
    $classes = match ($status) {
        'Done' => 'bg-emerald-100 text-emerald-800',
        'Overdue' => 'bg-rose-100 text-rose-800',
        default => 'bg-sky-100 text-sky-800',
    };
@endphp

<span {{ $attributes->class(['inline-flex rounded-full px-2.5 py-1 text-xs font-semibold', $classes]) }}>
    {{ $slot }}
</span>
