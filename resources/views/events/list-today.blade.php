<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Happening Today') }}
        </h2>
    </x-slot>

    <div class="container mx-auto my-8">
        <!-- <div class="mb-6 ml-8 xs:ml-0 sm:ml-24 md:ml-0">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Happening Today') }}
            </h2>
        </div> -->

        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">
            @foreach ($events as $event)
                <div
                    class="flex justify-center text-6xl bg-gray-100 border-gray-300 rounded-xl"
                >
                    <a href="{{ route('events.show', ['event' => $event->id]) }}">
                        <x-event-card :event="$event"/>
                    </a>
                </div>
            @endforeach
        </div>
    </div>

    <!-- <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Happening Today') }}
            </h2>
        </div>
        <div class="mt-6 shadow-sm rounded-lg divide-y">
        <div class="container mx-auto">
            @foreach ($events as $event)
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">
                <div
                    class="flex justify-center p-6 text-6xl bg-gray-100 border-2 border-gray-300 rounded-xl"
                >
                    <a href="{{ route('events.show', ['event' => $event->id]) }}">
                        <div
                            class="flex justify-center p-6 text-6xl bg-gray-100 border-2 border-gray-300 rounded-xl"
                        >
                            <x-event-card :event="$event"/>
                        </div>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div> -->
</div>
</x-app-layout>
