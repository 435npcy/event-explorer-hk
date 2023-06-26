<x-app-layout>
    <div class="container mx-auto my-8">
      <div class="text-center" style="display: flex;justify-content: center;align-items: center;">
        <p class="font-bold text-xl">
          Purchase success
        </p>
      </div>
      <div class="grid grid-cols-1 p-4 md:mx-24 lg:mx-48 my-12">
        <div class="border-solid border-b-2 border-black mb-4">Event Info</div>
        <!-- EventCard start -->
        <div class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl mb-4">
            <div class="p-6 flex space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 -scale-x-100" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                </svg>
                <div class="flex-1">
                    <div class="flex justify-between items-center">
                        <div>
                            <span class="text-gray-800">{{ $event->title }}</span>
                            <div class="mt-2 flex">
                                <time class="text-sm text-gray-600">{{ $event->start_at->format('j M Y, g:i a') }}</time>
                                <span class="text-sm text-gray-600 mx-2">-</span>
                                <time class="text-sm text-gray-600">{{ $event->end_at->format('j M Y, g:i a') }}</time>
                            </div>
                        </div>
                    </div>
                    <p class="mt-4 text-lg text-gray-900">{{ $event->description }}</p>
                    <p class="mt-4 text-lg text-gray-900">{{ $event->venue }}</p>
                </div>
            </div>
        </div>
        <!-- EventCard end -->
      </div>
      <div class="grid grid-cols-1 border rounded-lg bg-gray-200 p-4 md:mx-24 lg:mx-48 my-12">
          <div class="border-solid border-b-2 border-black mb-4">Ticket Type</div>
            @foreach ($order->items as $item)
                <label class="flex items-center justify-between">
                    <span class="text-gray-700">{{ $item->ticketType->name }}</span>
                    <span class="text-gray-500">{{__('$')}}{{ $item->sub_price }}</span>
                    <span class="text-gray-500">{{__('x')}}{{ $item->quantity }}</span>
                    <span class="text-gray-700">
                      {{__('$')}}{{ number_format((float)($item->sub_price * $item->quantity), 2, '.', '') }}
                    </span>
                </label>
            @endforeach
          
            <div class="border-solid border-b-2 border-black my-2"></div>
            <label class="flex items-center justify-between">
              <span class="text-gray-700">Total amount:</span>
              <span class="text-gray-700">{{__('$')}}{{ $order->total_amount }}</span>
            </label>
          </div>
      </div>
      <div class="p-4 md:mx-24 lg:mx-48 my-12 flex justify-between">
          <a href="{{ url('/tickets') }}">
              <button
                  class="mt-4 w-64 h-12 text-xl text-white bg-indigo-500 hover:bg-indigo-600 justify-center self-end"
                  type="button"
              >
                  {{ __('View Tickets') }}
              </button>
          </a>
          <a href="{{ url('/') }}">
              <button
                  class="mt-4 w-64 h-12 text-xl text-white bg-indigo-500 hover:bg-indigo-600 justify-center self-end"
                  type="button"
              >
                  {{ __('Back to Homepage') }}
              </button>
          </a>
      </div>
    </div>
</x-app-layout>
