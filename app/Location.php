<?php

namespace App;

use App\Casts\Json;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Sushi\Sushi;

class Location extends Model
{
    use Sushi;

    protected $casts = [
        'history' => Json::class,
        'coordinate' => Json::class,
    ];

    public function getRows()
    {
        return Cache::remember('locations', now()->addMinute(), function () {
            return collect(Http::get('https://coronavirus-tracker-api.herokuapp.com/confirmed')->json()['locations'])
                ->map(function (array $item) {
                    return array_replace($item, [
                        'history' => json_encode($item['history']),
                        'coordinates' => json_encode($item['coordinates']),
                    ]);
                })
                ->all();
        });
    }

    public function getLatestCasesCountAttribute()
    {
        return collect($this->history)->sortBy(fn ($item, $key) => Carbon::createFromFormat('n/j/y', $key)->startOfDay())->last();
    }
}
