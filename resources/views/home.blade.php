<x-app-layout>
    <!-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> -->

    <!-- <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div> -->

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form method="post" action="{{ route('events.search.submit')}}">
                    <div class="p-6 text-gray-900 flex">
                        @csrf
                        <input class="w-full rounded-full px-6" type="text" name="searchKeyword"
                            placeholder="Search"
                        />
                        <!-- <a href="{{ route('events.search') }}"> -->
                            <button
                                type="submit"
                                class="ml-3 rounded-full w-12 h-12 text-xl text-white bg-indigo-500 hover:bg-indigo-600 justify-center self-end items-center flex"
                            >
                                <!-- <span class="material-symbols-outlined">search</span> -->
                                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><style>svg{fill:#ffffff}</style><path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/></svg>
                            </button>
                        <!-- </a> -->
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="container mx-auto">
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">
            <div
            class="flex justify-center p-6 text-6xl bg-gray-100 border-2 border-gray-300 rounded-xl"
            >
            1
            </div>
            <div
            class="flex justify-center p-6 text-6xl bg-gray-100 border-2 border-gray-300 rounded-xl"
            >
            2
            </div>
            <div
            class="flex justify-center p-6 text-6xl bg-gray-100 border-2 border-gray-300 rounded-xl"
            >
            3
            </div>
            <div
            class="flex justify-center p-6 text-6xl bg-gray-100 border-2 border-gray-300 rounded-xl"
            >
            4
            </div>
            <div
            class="flex justify-center p-6 text-6xl bg-gray-100 border-2 border-gray-300 rounded-xl"
            >
            5
            </div>
        </div>
    </div>
</x-app-layout>
