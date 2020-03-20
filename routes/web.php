<?php

use Facades\App\Services\Covid;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::prefix('_partials')->as('partials.')->group(function () {
    Route::get('world-stats', function () {
        return Cache::remember('_partials.world-stats', now()->addMinutes(1), function () {
            return view('_partials.world-stats', [
                'stats' => Covid::stats(),
                'locations' => Covid::allLocations()->sortBy('country_code'),
            ])->render();
        });
    })->name('world-stats');
});

Route::get('locations/{location}', function ($location) {
    $location = Covid::location($location);

    return view('locations.show', [
        'location' => $location,
        'chartData' => collect([['Date', '# Confirmed']])
            ->merge(collect($location['timelines']['confirmed']['timeline'])->sortBy(function ($numConfirmed, $date) {
                return Carbon\Carbon::parse($date)->startOfDay();
            })->map(function ($numConfirmed, $date) {
                return [$date, $numConfirmed];
            })->values()),
    ]);
})->name('locations.show');
