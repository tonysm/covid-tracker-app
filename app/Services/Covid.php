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

    private function cached($key, Closure $callback)
    {
        return Cache::remember($key, now()->addMinutes(10), $callback);
    }
}
