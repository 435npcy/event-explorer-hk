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
                <div class="p-6 text-gray-900 flex">
                    <input class="w-full rounded-full px-6" type="text" name="search"
                        placeholder="Search"
                    />
                    <a href="{{ route('home') }}">
                        <button
                            type="button"
                            class="ml-3 rounded-full w-12 h-12 text-xl text-white bg-indigo-500 hover:bg-indigo-600 justify-center self-end"
                        >
                            {{ __('S') }}
                        </button>
                    </a>
                </div>
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
