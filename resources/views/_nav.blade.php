<div class="p-6 mb-6 shadow fixed bg-white w-full z-10" x-data="{ showMenu: false }">
    <nav class="container mx-auto flex items-center justify-between flex-wrap">
        <div class="flex items-center flex-shrink-0 text-black font-bold mr-6">
            <span class="font-semibold font-mono text-3xl tracking-tight">COVID-19 Tracker</span>
        </div>
        <div class="block lg:hidden">
            <button class="flex items-center px-3 py-2 border text-gray-700 border-gray-700 hover:text-gray-500 hover:border-gray-500" @click="showMenu = !showMenu">
                <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Menu</title><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/></svg>
            </button>
        </div>
        <div class="w-full block flex-grow lg:flex lg:items-center lg:w-auto" @click.away="showMenu = false" x-show="showMenu">
            <div class="text-sm">
                <a href="{{ route('welcome') }}" class="block mt-4 lg:inline-block lg:mt-0 text-gray-800 hover:text-black mr-4">
                    Home
                </a>
                <a href="https://github.com/tonysm/covid-tracker-app" class="block mt-4 lg:inline-block lg:mt-0 text-gray-800 hover:text-black mr-4">
                    Source Code
                </a>
                <a href="https://github.com/ExpDev07/coronavirus-tracker-api" class="block mt-4 lg:inline-block lg:mt-0 text-gray-800 hover:text-black mr-4">
                    Data Source
                </a>
            </div>
        </div>
        <div class="w-full block flex-grow lg:flex lg:items-center lg:w-auto hidden lg:block">
            <div class="text-sm lg:flex-grow">
                <a href="{{ route('welcome') }}" class="block mt-4 lg:inline-block lg:mt-0 text-gray-800 hover:text-black mr-4">
                    Home
                </a>
            </div>
            <div class="lg:flex">
                <a href="https://github.com/tonysm/covid-tracker-app" class="mr-2 flex items-center inline-block text-sm px-4 py-2 leading-none border text-gray-800 border-gray-700 hover:border-transparent hover:bg-gray-800 hover:text-gray-200 mt-4 lg:mt-0">
                    <svg class="mr-1 h-4" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M9.26 13a2 2 0 0 1 .01-2.01A3 3 0 0 0 9 5H5a3 3 0 0 0 0 6h.08a6.06 6.06 0 0 0 0 2H5A5 5 0 0 1 5 3h4a5 5 0 0 1 .26 10zm1.48-6a2 2 0 0 1-.01 2.01A3 3 0 0 0 11 15h4a3 3 0 0 0 0-6h-.08a6.06 6.06 0 0 0 0-2H15a5 5 0 0 1 0 10h-4a5 5 0 0 1-.26-10z"/>
                    </svg>
                    Source Code
                </a>
                <a href="https://github.com/ExpDev07/coronavirus-tracker-api" target="_blank" class="flex items-center inline-block text-sm px-4 py-2 leading-none border text-gray-800 border-gray-700 hover:border-transparent hover:bg-gray-800 hover:text-gray-200 mt-4 lg:mt-0">
                    <svg class="mr-1 h-4" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M9.26 13a2 2 0 0 1 .01-2.01A3 3 0 0 0 9 5H5a3 3 0 0 0 0 6h.08a6.06 6.06 0 0 0 0 2H5A5 5 0 0 1 5 3h4a5 5 0 0 1 .26 10zm1.48-6a2 2 0 0 1-.01 2.01A3 3 0 0 0 11 15h4a3 3 0 0 0 0-6h-.08a6.06 6.06 0 0 0 0-2H15a5 5 0 0 1 0 10h-4a5 5 0 0 1-.26-10z"/>
                    </svg>
                    Data Source
                </a>
            </div>
        </div>
    </nav>
</div>
