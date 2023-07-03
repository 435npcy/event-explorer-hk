<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
            @if (count($tickets) > 0)
                @foreach ($tickets as $ticket)
                <div class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl mb-4">
                    <div class="grid grid-cols-1 border rounded-lg bg-gray-200 p-2 md:mx-24 lg:mx-36 my-4">
                    <div class="border-solid border-b-2 border-black mb-4">
                            Event Name: {{ $ticket->event->title }}
                        </div>
                        <div class="border-solid border-b-2 border-black mb-4">
                            Ticket ID: {{ $ticket->id }}
                        </div>
                        <div class="border-solid border-b-2 border-black mb-4 justify-center">QR Code</div>
                        <div class="flex justify-center">
                            <img src="{{$ticket->qrcode}}" alt="QR Code" />
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                <div class="max-w-md mx-auto rounded-xl overflow-hidden md:max-w-2xl mb-4 h-24 flex justify-center">
                    <div class="self-center">No Tickets</div>
                </div>
            @endif
        </div>
    </div>

</div>
</x-app-layout>
