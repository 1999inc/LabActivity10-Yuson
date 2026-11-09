@extends('layouts.app')

@section('title', $title)

@section('content')
    <x-page-heading title="Bakuna Tracker - Purok Yuson">
        Vaccination schedule overview for the Barangay Matina Crossing Health Center.
    </x-page-heading>

    @if ($alerts->isNotEmpty())
        <section class="mb-6 rounded-lg border border-rose-200 bg-rose-50 p-4 text-rose-900" role="status">
            <p class="font-semibold">{{ $alerts->count() }} vaccination {{ $alerts->count() === 1 ? 'schedule is' : 'schedules are' }} overdue.</p>
            <p class="mt-1 text-sm">Review the schedule and contact the residents to arrange follow-up.</p>
        </section>
    @elseif ($schedules->isEmpty())
        <section class="mb-6 rounded-lg border border-amber-200 bg-amber-50 p-4 text-amber-900" role="status">
            <p class="font-semibold">No vaccination schedules have been added yet.</p>
            <p class="mt-1 text-sm">The schedule will appear here after records are added.</p>
        </section>
    @else
        <section class="mb-6 rounded-lg border border-emerald-200 bg-emerald-50 p-4 text-emerald-900" role="status">
            <p class="font-semibold">All clear! There are no overdue vaccination schedules.</p>
        </section>
    @endif

    <section aria-label="Vaccination statistics" class="mb-8 grid grid-cols-1 gap-4 md:grid-cols-4">
        @foreach ($stats as $stat)
            <article class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
                <p class="text-sm font-medium text-slate-500">{{ $stat['label'] }}</p>
                <p class="mt-2 text-3xl font-bold text-slate-900">{{ $stat['value'] }}</p>
            </article>
        @endforeach
    </section>

    <section class="overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm">
        <div class="flex flex-col gap-3 border-b border-slate-200 p-5 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-lg font-semibold text-slate-900">Upcoming and recent vaccinations</h2>
                <p class="mt-1 text-sm text-slate-600">Schedules are ordered by vaccination date.</p>
            </div>
            <a href="{{ route('schedule') }}" class="text-sm font-semibold text-emerald-700 hover:text-emerald-900">View full schedule</a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200 text-left text-sm">
                <thead class="bg-slate-50 text-xs uppercase tracking-wide text-slate-500">
                    <tr>
                        <th scope="col" class="px-5 py-3">Resident</th>
                        <th scope="col" class="px-5 py-3">Purok</th>
                        <th scope="col" class="px-5 py-3">Vaccine / dose</th>
                        <th scope="col" class="px-5 py-3">Scheduled</th>
                        <th scope="col" class="px-5 py-3">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($schedules as $schedule)
                        <tr class="{{ $loop->first ? 'bg-emerald-50/40' : 'bg-white' }} {{ $loop->last ? 'border-b-0' : '' }}">
                            <td class="whitespace-nowrap px-5 py-4 font-medium text-slate-900">{{ $schedule->patient_name }}</td>
                            <td class="whitespace-nowrap px-5 py-4 text-slate-600">{{ $schedule->purok }}</td>
                            <td class="px-5 py-4 text-slate-600">{{ $schedule->vaccine }} <span class="text-slate-400">·</span> {{ $schedule->dose }}</td>
                            <td class="whitespace-nowrap px-5 py-4 text-slate-600">{{ $schedule->scheduled_at->format('M j, Y') }}</td>
                            <td class="whitespace-nowrap px-5 py-4">
                                @unless ($schedule->status === 'Overdue')
                                    <x-status-badge :status="$schedule->status">{{ $schedule->status }}</x-status-badge>
                                @else
                                    <x-status-badge :status="$schedule->status">Overdue</x-status-badge>
                                @endunless
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-5 py-10 text-center text-slate-500">No vaccination schedules are available.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection
