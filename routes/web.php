<?php

use Facades\App\Services\Covid;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome', [
        'stats' => Covid::stats(),
        'locations' => Covid::allLocations()->sortBy('country_code'),
    ]);
})->name('welcome');

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
