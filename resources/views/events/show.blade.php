<x-app-layout>
    <div class="flex max-w-6xl mx-auto p-4 sm:p-6 lg:p-8">
        <div class="flex-1">
            <div class="bg-white shadow-sm rounded-lg divide-y">
                <div
                    class="px-6 py-4 mx-auto bg-white rounded-xl shadow-md overflow-hidden"
                >
                    <div class="text-lg font-light text-gray-500">
                        <small>{{ $event->category->name }}</small>
                    </div>
                    <h1 class="text-2xl font-bold">{{ $event->title }}</h1>
                    <div class="my-4">
                        <img class="w-full" src={{ $event->image_url }} />
                    </div>
                    <div class="pb-4 flex space-x-2">
                        <div class="flex-1">
                            <div class="flex">
                                <time class="text-lg text-gray-600"
                                    >{{ $event->start_at->format('j M Y, g:i:a')
                                    }}</time
                                >
                                <span class="text-lg text-gray-600 mx-2">-</span>
                                <time class="text-lg text-gray-600"
                                    >{{ $event->end_at->format('j M Y, g:i:a')
                                    }}</time
                                >
                            </div>
                            <div class="mt-2">
                                <h2 class="text-lg font-semibold">{{ __('Description') }}</h2>
                                <hr />
                            </div>
                            <p class="mt-4 text-lg text-gray-900">
                                {{ $event->description }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="my-4 p-4 bg-white shadow-sm rounded-lg divide-y">
                <div class="mt-2">
                    <h2 class="text-lg font-semibold">{{ __('Location') }}</h2>
                    <hr />
                </div>
                <div>
                    <p class="mt-4 text-lg text-gray-900">
                        {{ $event->venue }}
                    </p>
                </div>
                <div id="map" class="mt-4 w-full" style="height: 580px"></div>
            </div>
        </div>
        <div class="flex-none mx-8">
            <!-- <div class="bg-gray-500 h-96"></div> -->
            <div class="grid grid-cols-1 border rounded-lg bg-gray-200 p-4">
                <div class="border-solid border-b-2 border-black mb-4">Ticket Type</div>
                    @if (count($event->ticketTypes) > 0)
                        <form class="grid gap-2"
                            method="POST"
                            action="{{ route('orders.store', ['eventId' => $event->id]) }}"
                        >
                            @csrf
                            @if (count($errors) > 0)
                            <div class="text-red-500">
                                @foreach ($errors->all() as $error) {{ $error }}<br />
                                @endforeach
                            </div>
                            @endif
                            @foreach ($event->ticketTypes as $ticketType)
                                <label class="flex items-center justify-between">
                                    <span class="text-gray-700">{{ $ticketType->name }}</span>
                                    <span class="text-gray-500">{{__('$')}}{{ $ticketType->price }}</span>
                                    <input class="form-number rounded disabled:bg-zinc-200"
                                        type="number"
                                        name="items[{{ $ticketType->id }}]"
                                        value="0" min="0" max="10"
                                        @guest
                                            disabled
                                        @endguest
                                    />
                                </label>
                            @endforeach
                            @auth
                                <div class="">
                                    <button
                                        class="mt-4 w-64 h-12 text-xl text-white bg-indigo-500 hover:bg-indigo-600 justify-center self-end"
                                        type="submit"
                                    >
                                        {{ __('Buy') }}
                                    </button>
                                </div>
                            @endauth
                            @guest
                                <div class="">
                                    <a href="{{ route('login') }}">
                                        <button
                                            class="mt-4 w-64 h-12 text-xl text-white bg-indigo-500 hover:bg-indigo-600 justify-center self-end"
                                            type="button"
                                        >
                                            {{ __('Login to Buy') }}
                                        </button>
                                    </a>
                                </div>
                            @endguest
                        </form>
                    @else
                        <div class="grid grid-cols-1 gap-6 border rounded-lg bg-gray-200 p-4 w-64">
                            <p class="text-lg font-light text-gray-500 text-center">Not available</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- <x-primary-button
        type="button"
        id="find-me"
        class="mt-4 w-48 justify-center self-end"
    >
        Show my location
    </x-primary-button>
    <br />
    <p id="status"></p>
    <a id="map-link" target="_blank"></a> -->
    <script>
        // Creating map options
        var mapOptions = {
            center: [{{ $event->lat }}, {{ $event->lng }}],
            zoom: 15,
        };

        // Creating a map object
        var map = new L.map("map", mapOptions);

        // Creating a Layer object
        var layer = new L.TileLayer(
            "http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
        );

        // Adding layer to the map
        map.addLayer(layer);

        L.marker([{{ $event->lat }}, {{ $event->lng }}]).addTo(map).openPopup();
    </script>
    <!-- <script>
        function geoFindMe() {
            const status = document.querySelector("#status");
            const mapLink = document.querySelector("#map-link");

            mapLink.href = "";
            mapLink.textContent = "";

            function success(position) {
                const latitude = position.coords.latitude;
                const longitude = position.coords.longitude;

                status.textContent = "";
                mapLink.href = `https://www.openstreetmap.org/#map=18/${latitude}/${longitude}`;
                mapLink.textContent = `Latitude: ${latitude} °, Longitude: ${longitude} °`;
            }

            function error() {
                status.textContent = "Unable to retrieve your location";
            }

            if (!navigator.geolocation) {
                status.textContent =
                    "Geolocation is not supported by your browser";
            } else {
                status.textContent = "Locating…";
                navigator.geolocation.getCurrentPosition(success, error);
            }
        }

        document.querySelector("#find-me").addEventListener("click", geoFindMe);
    </script>

<div class="container">
<div class="row justify-content-center">
<div class="col-md-8">
<div class="card">
<div class="card-header">{{ __('Dashboard') }}</div>
<div class="card-body">
@if (session('status'))
<div class="alert alert-success" role="alert">
{{ session('status') }}
</div>
@endif
{{ __('You are logged in!') }} <br><br>
<h3>Products</h3>

</div>
</div>
</div>
</div>
</div> -->


</x-app-layout>