<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vaccination;

class VaccinationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Bakuna Tracker - Purok Yuson';
        $schedules = Vaccination::orderBy('scheduled_at')->get();
        $stats = [
        ['label' => 'Total', 'value' => $schedules->count()],
        ['label' => 'Done', 'value' => $schedules->where('status', 'Done')->count()],
        // ... 2 more
        ];
        $alerts = $schedules->where('status', 'Overdue');
        return view('dashboard.index', compact('title', 'stats', 'schedules', 'alerts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
