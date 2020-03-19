@extends('layouts.app')

@section('content')
    <div class="container px-6 sm:p-0 mx-auto">
        <h2 class="text-lg sm:text-6xl text-center font-sans font-bold py-4">Confirmed Cases Around the World</h2>
        <div class="flex justify-between mb-6">
            @foreach ($stats as $key => $value)
                <div class="w-1/3 ">
                    <div class="text-center p-6 w-48 mx-auto bg-gray-200 rounded">
                        <h3 class="font-bold">{{ \Illuminate\Support\Str::of($key)->title() }}</h3>
                        <span class="text-4xl">{{ $value }}</span>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="sm:grid sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-6 sm:-mx-2">
            @foreach($locations as $location)
                <div class="sm:m-2 sm:max-w-sm rounded overflow-hidden shadow-lg">
                    <a class="block h-full flex flex-col" href="{{ route('locations.show', $location->country_code) }}">
                        <div class="px-6 pt-4 flex-1">
                            <div class="font-bold text-xl mb-2">
                                {{ $location->country }} <span class="text-gray-600">({{ $location->country_code }})</span>
                            </div>
                        </div>
                        <div class="pb-4 text-center text-4xl">
                            {{ $location->latest_cases_count }}
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>

    <footer class="mt-6 bg-gray-200 border-t border-gray-400 h-20 flex items-center justify-center font-mono">
        <p class="text-gray-900">
            Stay safe. Wash your hands.
        </p>
    </footer>
@endsection
