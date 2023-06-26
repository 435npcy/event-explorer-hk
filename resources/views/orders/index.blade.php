<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
            @foreach ($orders as $order)
            <div class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl mb-4">
                <a href="{{ route('orders.index', ['order' => $order->id]) }}">
                <div class="grid grid-cols-1 border rounded-lg bg-gray-200 p-4 md:mx-24 lg:mx-48 my-12">
                    <div class="border-solid border-b-2 border-black mb-4">
                        Order ID: {{ $order->id }}
                    </div>
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
                </a>
            </div>
            @endforeach
        </div>
    </div>
</div>
</x-app-layout>
