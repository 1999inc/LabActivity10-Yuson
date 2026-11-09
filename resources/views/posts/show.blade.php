@extends('layouts.app')

@section('title', 'Barangay Bulletin – Purok Yuson')

@section('content')
    <a href="{{ route('posts.index') }}" class="mb-6 inline-flex text-sm font-semibold text-emerald-700 hover:text-emerald-900">
        &larr; Back to all posts
    </a>

    <article class="mx-auto max-w-3xl rounded-lg border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
        <div class="mb-4 flex flex-wrap items-center gap-2">
            <span class="rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-800">{{ $post->category }}</span>
            @if ($post->is_pinned)
                <span class="rounded-full bg-amber-100 px-3 py-1 text-xs font-semibold text-amber-900">Pinned</span>
            @endif
        </div>

        <h1 class="text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">{{ $post->title }}</h1>
        <p class="mt-3 text-sm text-slate-500">
            Author #{{ $post->author_id }} <span aria-hidden="true">·</span>
            {{ $post->published_at?->format('M j, Y') ?? 'Date unavailable' }}
        </p>

        <div class="mt-8 whitespace-pre-line text-base leading-7 text-slate-700">{{ $post->body }}</div>
        <p class="mt-8 border-t border-slate-100 pt-4 text-sm text-slate-500">
            {{ $post->views }} {{ $post->views === 1 ? 'view' : 'views' }}
        </p>
    </article>
@endsection
