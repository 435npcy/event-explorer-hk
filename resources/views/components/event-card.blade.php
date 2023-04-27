@props(['event'])

@if ($event)
<div class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-2md mb-4 p-3">

    <div class="flex space-x-2">
      <img class="mb-4 w-320 h-160" src={{ $event->image_url }} />
    </div>
    <div>
        <div class="mb-1 text-sm font-light text-gray-500 flex justify-between">
          <span>{{ $event->category->name }}</span>
          {{ $slot }}
        </div>
        <div class="flex justify-between">
            <h2 class="text-xl font-bold text-gray-800">{{ $event->title }}</h2>
        </div>
        <div class="mt-2 flex">
          <time class="text-sm text-gray-600">{{ $event->start_at->format('j M Y, g:i a') }}</time>
          <span class="text-sm text-gray-600 mx-2">-</span>
          <time class="text-sm text-gray-600">{{ $event->end_at->format('j M Y, g:i a') }}</time>
        </div>
        <p class="mt-2 text-lg text-gray-900">
          <span class="text-indigo-400">@ </span>{{ $event->venue }}
        </p>
    </div>
    
</div>
@endif
