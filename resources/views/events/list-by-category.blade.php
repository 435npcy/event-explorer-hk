<x-app-layout>
    <div class="container mx-auto my-8">
        <div class="mb-6 ml-8 xs:ml-0 sm:ml-24 md:ml-0">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __($category->name) }}
            </h2>
        </div>
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
                {{ __($category->name) }}
            </h2>
        </div>
        <div class="mt-6 shadow-sm rounded-lg divide-y">
            @foreach ($events as $event)
                <a href="{{ route('events.show', ['event' => $event->id]) }}">
                    <x-event-card :event="$event"/>
                </a>
            @endforeach
        </div>
    </div> -->
</x-app-layout>
