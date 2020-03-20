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

    public function allLocations()
    {
        return collect($this->cached('locations', function () {
            return $this->squashCountries(Http::get('https://coronavirus-tracker-api.herokuapp.com/v2/locations')->json()['locations']);
        }));
    }

    public function location($id)
    {
        return collect($this->cached("locations.{$id}", function () use ($id) {
            return Http::get("https://coronavirus-tracker-api.herokuapp.com/v2/locations/{$id}")->json()['location'];
        }));
    }

    private function cached($key, Closure $callback)
    {
        return Cache::remember($key, now()->addMinutes(10), $callback);
    }

    private function squashCountries(Array $locations)
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
        }
        return $squased;
    }
}
