@extends('layouts.app')

@section('title', 'Barangay Bulletin – Purok Yuson')

@section('content')
    <x-page-heading title="Barangay Bulletin – Purok Yuson">
        Community announcements and updates from Barangay Matina Crossing.
    </x-page-heading>

    <form method="GET" action="{{ route('posts.index') }}" class="mb-8 grid grid-cols-1 gap-4 rounded-lg border border-slate-200 bg-white p-5 shadow-sm sm:grid-cols-[minmax(0,1fr)_16rem_auto] sm:items-end">
        <div>
            <label for="q" class="mb-1 block text-sm font-medium text-slate-700">Search title</label>
            <input
                id="q"
                name="q"
                type="search"
                value="{{ request('q') }}"
                placeholder="Search posts"
                class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm shadow-sm focus:border-emerald-600 focus:outline-none focus:ring-2 focus:ring-emerald-100"
            >
        </div>

        <div>
            <label for="category" class="mb-1 block text-sm font-medium text-slate-700">Category</label>
            <select
                id="category"
                name="category"
                class="w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm shadow-sm focus:border-emerald-600 focus:outline-none focus:ring-2 focus:ring-emerald-100"
            >
                <option value="">All categories</option>
                @foreach ($categories as $category)
                    <option value="{{ $category }}" @selected(request('category') === $category)>{{ $category }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="rounded-md bg-emerald-700 px-4 py-2 text-sm font-semibold text-white hover:bg-emerald-800">
            Filter
        </button>
    </form>

    <section aria-label="Published posts" class="grid grid-cols-1 gap-5 md:grid-cols-2">
        @forelse ($posts as $post)
            <article class="flex h-full flex-col rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
                <div class="mb-3 flex flex-wrap items-center gap-2">
                    <span class="rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-800">{{ $post->category }}</span>
                    @if ($post->is_pinned)
                        <span class="rounded-full bg-amber-100 px-3 py-1 text-xs font-semibold text-amber-900">Pinned</span>
                    @endif
                </div>

                <h2 class="text-lg font-semibold text-slate-900">
                    <a href="{{ route('posts.show', $post->id) }}" class="hover:text-emerald-800">{{ $post->title }}</a>
                </h2>
                <p class="mt-2 flex-1 text-sm leading-6 text-slate-600">{{ \Illuminate\Support\Str::limit($post->body, 180) }}</p>

                <div class="mt-5 flex flex-wrap items-center justify-between gap-2 border-t border-slate-100 pt-4 text-xs text-slate-500">
                    <span>Author #{{ $post->author_id }} <span aria-hidden="true">·</span> {{ $post->published_at?->format('M j, Y') ?? 'Date unavailable' }}</span>
                    <span>{{ $post->views }} {{ $post->views === 1 ? 'view' : 'views' }}</span>
                </div>
            </article>
        @empty
            <p class="rounded-lg border border-slate-200 bg-white px-5 py-10 text-center text-sm text-slate-600 md:col-span-2">
                No posts match your search.
            </p>
        @endforelse
    </section>

    <div class="mt-8">
        {{ $posts->links() }}
    </div>
    <p class="mt-3 text-sm text-slate-600">
        Showing {{ $posts->firstItem() ?? 0 }}–{{ $posts->lastItem() ?? 0 }} of {{ $posts->total() }} posts
    </p>
@endsection
