@extends('layouts.app')

@section('content')
    <div class="container px-6 sm:p-0 mx-auto">
        <h2 class="text-lg sm:text-6xl text-center font-sans font-bold py-4">Confirmed Cases Around the World</h2>
        <div class="flex justify-center mb-6">
            <div class="inline-flex">
                <a
                    href="?sort=country_code"
                    class="text-gray-800 font-bold py-2 px-4 rounded-l {{ request()->query('sort', 'country_code') === 'country_code' ? 'bg-gray-400 hover:bg-gray-300' : 'bg-gray-300 hover:bg-gray-400' }}"
                >
                    Sort by Country
                </a>
                <a
                    href="?sort=-confirmed"
                    class="text-gray-800 font-bold py-2 px-4 rounded-r {{ request()->query('sort', '') === '-confirmed' ? 'bg-gray-400 hover:bg-gray-300' : 'bg-gray-300 hover:bg-gray-400' }}"
                >
                    Sort by Confirmed
                </a>
            </div>
        </div>

        @if(cache()->has("_partials.world-stats.{$sort}"))
            {!! cache()->get("_partials.world-stats.{$sort}", '') !!}
        @else
            <include-fragment src="{{ route('partials.world-stats', ['sort' => $sort]) }}">
                @include('_partials.world-stats-loading')
            </include-fragment>
        @endif
    </div>

    <footer class="mt-6 bg-gray-200 border-t border-gray-400 h-20 flex items-center justify-center font-mono">
        <p class="text-gray-900">
            Stay safe. Wash your hands.
        </p>
    </footer>
@endsection
