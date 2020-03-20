@extends('layouts.app')

@section('content')
    <div class="container px-6 sm:p-0 mx-auto">
        <h2 class="text-lg sm:text-6xl text-center font-sans font-bold py-4">Confirmed Cases Around the World</h2>
        @if(cache()->has('_partials.world-stats'))
            {!! cache()->get('_partials.world-stats', '') !!}
        @else
            <include-fragment src="{{ route('partials.world-stats') }}">
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
