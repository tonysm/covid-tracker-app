<div class="flex justify-between mb-6">
    @foreach ($stats as $key => $value)
        <div class="w-1/3 ">
            <div class="text-center p-6 w-48 mx-auto bg-gray-200 rounded">
                <h3 class="font-bold">{{ \Illuminate\Support\Str::of($key)->title() }}</h3>
                <span class="text-4xl">{{ number_format($value, 0, '', ',') }}</span>
            </div>
        </div>
    @endforeach
</div>
