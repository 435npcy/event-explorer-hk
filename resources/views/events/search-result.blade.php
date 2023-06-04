<x-app-layout>
    <div class="container mx-auto my-8">
        <div class="mb-6 ml-8 xs:ml-0 sm:ml-24 md:ml-0">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Search Result') }}
            </h2>
        </div>
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">
            @if(count($events) === 0)
                <p class="font-semibold text-xl text-gray-500 leading-tight">{{ __('No result.') }}</p>
            @endif
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
</x-app-layout>
