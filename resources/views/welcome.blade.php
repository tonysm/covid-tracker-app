@extends('layouts.app')

@section('content')
    <div class="container px-6 sm:p-0 mx-auto">
        <h2 class="text-lg sm:text-6xl text-center font-sans font-bold py-4">Confirmed Cases Around the World</h2>
        <div class="sm:grid sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-6 sm:-mx-2">
            @foreach(range(1, 20) as $index)
                <div class="sm:m-2 sm:max-w-sm rounded overflow-hidden shadow-lg">
                    <div class="px-6 pt-4">
                        <div class="font-bold text-xl mb-2">{{ rand(0, 1) ? 'Brazil' : 'Belgium' }}</div>
                    </div>
                    <div class="pb-4 text-center text-5xl">
                        {{ rand(100, 90000) }}
                    </div>
                </div>
            @endforeach
        </div>
        <h2 class="text-lg sm:text-6xl text-center font-sans font-bold py-4">Deaths Around the World</h2>
        <div class="sm:grid sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-6 sm:-mx-2">
            @foreach(range(1, 20) as $index)
                <div class="sm:m-2 sm:max-w-sm rounded overflow-hidden shadow-lg">
                    <div class="px-6 pt-4">
                        <div class="font-bold text-xl mb-2">{{ rand(0, 1) ? 'Brazil' : 'Belgium' }}</div>
                    </div>
                    <div class="pb-4 text-center text-5xl">
                        {{ rand(100, 200) }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <footer class="mt-6 bg-gray-200 border-t border-gray-400 h-20 flex items-center justify-center font-mono">
        <p class="text-gray-900">
            By: Tony Messias
        </p>
    </footer>
@endsection
