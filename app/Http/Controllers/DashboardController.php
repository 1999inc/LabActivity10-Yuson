<?php

namespace App\Http\Controllers;

use App\Models\Vaccination;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $title = 'Bakuna Tracker - Purok Yuson';
        $schedules = Vaccination::query()->orderBy('scheduled_at')->get();
        $stats = [
            ['label' => 'Total schedules', 'value' => $schedules->count()],
            ['label' => 'Completed', 'value' => $schedules->where('status', 'Done')->count()],
            ['label' => 'Scheduled', 'value' => $schedules->where('status', 'Scheduled')->count()],
            ['label' => 'Overdue', 'value' => $schedules->where('status', 'Overdue')->count()],
        ];
        $alerts = $schedules->where('status', 'Overdue');

        return view('dashboard.index', compact('title', 'stats', 'schedules', 'alerts'));
    }

    public function schedule(): View
    {
        $schedules = Vaccination::query()->orderBy('scheduled_at')->get();

        return view('dashboard.schedule', compact('schedules'));
    }
}
