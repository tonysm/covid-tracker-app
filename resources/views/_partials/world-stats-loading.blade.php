<div class="sm:flex sm:justify-between sm:mb-6">
    @foreach (range(1, 3) as $_i)
        <div class="my-2 sm:my-0 sm:w-1/3">
            <div class="text-center p-6 sm:w-48 mx-auto bg-gray-200 rounded animated-placeholder text-transparent">
                <h3 class="font-bold">&nbsp;</h3>
                <span class="text-4xl">&nbsp;</span>
            </div>
        </div>
    @endforeach
</div>

<div class="sm:grid sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-6 sm:-mx-2">
    @foreach(range(1, 24) as $i)
        <div class="sm:m-2 sm:max-w-sm rounded overflow-hidden shadow-lg animated-placeholder">
            <a class="block h-full flex flex-col" href="#" @click.prevent="">
                <div class="px-6 pt-4 flex-1">
                    <div class="font-bold text-xl mb-2">&nbsp;</div>
                </div>
                <div class="pb-4 text-center text-4xl">
                    &nbsp;
                </div>
            </a>
        </div>
    @endforeach
</div>
