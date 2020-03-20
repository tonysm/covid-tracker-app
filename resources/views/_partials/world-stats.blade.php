@include('locations._stats', ['stats' => $stats])

<div class="sm:grid sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-6 sm:-mx-2">
    @foreach($locations as $location)
        <div class="sm:m-2 sm:max-w-sm rounded overflow-hidden shadow-lg">
            <a class="block h-full flex flex-col" href="{{ route('locations.show', $location['id']) }}">
                <div class="px-6 pt-4 flex-1">
                    <div class="font-bold text-xl mb-2">
                        {{ $location['country'] }} <span class="text-gray-600">({{ $location['country_code'] }})</span>
                    </div>
                </div>
                <div class="pb-4 text-center text-4xl">
                    {{ number_format($location['latest']['confirmed'], 0, '', ',') }}
                </div>
            </a>
        </div>
    @endforeach
</div>
