@extends('layouts.app')

@section('title', 'Vaccination Schedule')

@section('content')
    <x-page-heading title="Vaccination Schedule">
        Browse the seeded vaccination records, ordered by scheduled date.
    </x-page-heading>

    <section class="overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200 text-left text-sm">
                <thead class="bg-slate-50 text-xs uppercase tracking-wide text-slate-500">
                    <tr>
                        <th scope="col" class="px-5 py-3">Resident</th>
                        <th scope="col" class="px-5 py-3">Purok</th>
                        <th scope="col" class="px-5 py-3">Vaccine</th>
                        <th scope="col" class="px-5 py-3">Dose</th>
                        <th scope="col" class="px-5 py-3">Scheduled</th>
                        <th scope="col" class="px-5 py-3">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($schedules as $schedule)
                        <tr class="{{ $loop->odd ? 'bg-white' : 'bg-slate-50/70' }}">
                            <td class="whitespace-nowrap px-5 py-4 font-medium text-slate-900">{{ $schedule->patient_name }}</td>
                            <td class="whitespace-nowrap px-5 py-4 text-slate-600">{{ $schedule->purok }}</td>
                            <td class="whitespace-nowrap px-5 py-4 text-slate-600">{{ $schedule->vaccine }}</td>
                            <td class="whitespace-nowrap px-5 py-4 text-slate-600">{{ $schedule->dose }}</td>
                            <td class="whitespace-nowrap px-5 py-4 text-slate-600">{{ $schedule->scheduled_at->format('M j, Y') }}</td>
                            <td class="whitespace-nowrap px-5 py-4">
                                <x-status-badge :status="$schedule->status">{{ $schedule->status }}</x-status-badge>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-5 py-10 text-center text-slate-500">No vaccination schedules are available.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection
