<?php

use Facades\App\Services\Covid;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome', [
        'stats' => Covid::stats(),
        'locations' => \App\Location::orderBy('country_code', 'ASC')->get(),
    ]);
})->name('welcome');

Route::get('locations/{location:country_code}', function (\App\Location $location) {
    return view('locations.show', [
        'location' => $location,
        'chartData' => collect([['Date', '# Confirmed']])
            ->merge(collect($location->history)->sortBy(function ($numConfirmed, $date) {
                return Carbon\Carbon::createFromFormat('n/j/y', $date)->startOfDay();
            })->map(function ($numConfirmed, $date) {
                return [$date, $numConfirmed];
            })->values()),
    ]);
})->name('locations.show');
