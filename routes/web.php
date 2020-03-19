<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome', [
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
