<?php

namespace App\Services;

use Closure;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class Covid
{
    public function stats()
    {
        return $this->cached('stats', function () {
            return Http::get('https://coronavirus-tracker-api.herokuapp.com/v2/latest')->json()['latest'];
        });
    }

    public function allLocations(string $countryCode = null)
    {
        $key = sprintf('locations.%s', $countryCode ?: 'all');

        return collect($this->cached($key, function () use ($countryCode) {
            $query = http_build_query($countryCode ? ['country_code' => $countryCode, 'timelines' => 1] : []);
            return $this->squashCountries(Http::get("https://coronavirus-tracker-api.herokuapp.com/v2/locations?{$query}")->json()['locations']);
        }));
    }

    public function location(string $countryCode)
    {
        return collect($this->allLocations($countryCode)->get($countryCode));
    }

    private function cached($key, Closure $callback)
    {
        return Cache::remember($key, now()->addMinutes(10), $callback);
    }

    private function squashCountries(array $locations)
    {
        $squased = [];

        foreach ($locations as $location) {
            if (!isset($squased[$location['country_code']])) {
                $squased[$location['country_code']] = $location;
            }
            else {
                $squased[$location['country_code']]['latest']['confirmed'] += $location['latest']['confirmed'];
                $squased[$location['country_code']]['latest']['deaths'] += $location['latest']['deaths'];
                $squased[$location['country_code']]['latest']['recovered'] += $location['latest']['recovered'];
            }

            if (isset($squased[$location['country_code']]['timelines'])) {
                $squased[$location['country_code']]['timelines'] = $this->mergeTimelines(
                    $squased[$location['country_code']]['timelines'],
                    $location['timelines']
                );
            }
        }

        return $squased;
    }

    private function mergeTimelines(array $first, array $second): array
    {
        foreach (['confirmed', 'deaths', 'recovered'] as $timeline) {
            $first[$timeline]['latest'] += $second[$timeline]['latest'];

            foreach ($second[$timeline]['timeline'] as $date => $count) {
                $first[$timeline]['timeline'][$date] = ($first[$timeline]['timeline'][$date] ?? 0) + $count;
            }
        }

        return $first;
    }
}
