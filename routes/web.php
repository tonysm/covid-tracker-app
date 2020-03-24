<?php

use App\Services\Covid;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome', [
        'sort' => request()->query('sort', 'country'),
    ]);
})->name('welcome');

Route::prefix('_partials')
    ->as('partials.')
    ->group(function () {
        Route::get('world-stats', function (Covid $covid) {
            $sort = request()->query('sort', 'country');

            return Cache::remember("_partials.world-stats.{$sort}", now()->addMinutes(1), function () use ($sort, $covid) {
                $sorters = [
                    'country' => fn (Collection $locations) => $locations->sortBy('country'),
                    '-confirmed' => fn (Collection $locations) => $locations->sortByDesc('latest.confirmed'),
                ];

                /** @var \Closure $sorter */
                $sorter = $sorters[$sort] ?? $sorters['country'];

                return view('_partials.world-stats', [
                    'stats' => $covid->stats(),
                    'locations' => $sorter($covid->allLocations()),
                ])->render();
            });
        })->name('world-stats');
    });

Route::get('locations/{location}', function ($location, Covid $covid) {
    $location = $covid->location($location);

    return view('locations.show', [
        'location' => $location,
        'chartData' => collect([['Date', '# Confirmed']])
            ->merge(collect($location['timelines']['confirmed']['timeline'])->sortBy(function ($numConfirmed, $date) {
                return Carbon\Carbon::parse($date)->startOfDay();
            })->map(function ($numConfirmed, $date) {
                return [Carbon\Carbon::parse($date)->format('Y-m-d'), $numConfirmed];
            })->values()),
    ]);
})->name('locations.show');
