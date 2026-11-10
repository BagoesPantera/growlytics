<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Services\TopItemsThisWeekService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct(
        private TopItemsThisWeekService $topItemsThisWeek,
    ) {}

    /**
     * Display the Growlytics public homepage.
     */
    public function index()
    {
        $period = $this->topItemsThisWeek->currentPeriod();

        return view('guest.home.index', [
            'topItems' => $this->topItemsThisWeek->topItemsThisWeek(),
            'weekStart' => $period['start'],
            'weekEnd' => $period['end'],
        ]);
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
