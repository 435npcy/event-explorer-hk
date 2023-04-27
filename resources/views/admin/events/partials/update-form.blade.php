<div class="px-4 py-2">
    <x-input-label for="title" class="mb-2" :value="__('Title')" />
    <x-text-input id="title" type="text" name="title" required
        class="mt-1 block w-full"
        :value="old('title', $event->title)" />
    <x-input-error class="mt-2" :messages="$errors->get('title')" />
</div>

<div class="px-4 py-2">
    <x-input-label class="mb-2" for="start_at" :value="__('Start at')" />
    <x-text-input id="start_at" name="start_at" type="text" required
        :value="old('start_at', $event->start_at)" />
    <x-input-error class="mt-2" :messages="$errors->get('start_at')" />
</div>

<div class="px-4 py-2">
    <x-input-label class="mb-2" for="end_at" :value="__('End at')" />
    <x-text-input id="end_at" name="end_at" type="text" required
        :value="old('end_at', $event->end_at)" />
    <x-input-error class="mt-2" :messages="$errors->get('end_at')" />
</div>

<div class="px-4 py-2">
    <x-input-label class="mb-2" for="description" :value="__('Description')" />
    <textarea id="description" name="description"
        class="block w-full h-48 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
    >{{ old('description', $event->description) }}</textarea>                
    <x-input-error class="mt-2" :messages="$errors->get('description')" />
</div>

<div class="px-4 py-2">
    <x-input-label class="mb-2" for="venue" :value="__('Venue')" />
    <x-text-input id="venue" name="venue" type="text" required
        class="mt-1 block w-full"
        :value="old('venue', $event->venue)" />
    <x-input-error class="mt-2" :messages="$errors->get('venue')" />
</div>

<div class="px-4 py-2">
    <x-input-label class="mb-2" for="lat" :value="__('Latitude')" />
    <x-text-input id="lat" name="lat" type="number" step="0.0000001" required
        class="mt-1 block w-1/3"
        :value="old('lat', $event->lat)" />
    <x-input-error class="mt-2" :messages="$errors->get('lat')" />
</div>

<div class="px-4 py-2">
    <x-input-label class="mb-2" for="lng" :value="__('Longitude')" />
    <x-text-input id="lng" name="lng" type="number" required
        class="mt-1 block w-1/3"
        :value="old('lng', $event->lng)" />
    <x-input-error class="mt-2" :messages="$errors->get('lng')" />
</div>

<div class="px-4 py-2">
    <x-input-label class="mb-2" for="image_url" :value="__('Image URL')" />
    <x-text-input id="image_url" name="image_url" type="text" required
        class="mt-1 block w-full"
        :value="old('image_url', $event->image_url)" />
    <x-input-error class="mt-2" :messages="$errors->get('Image URL')" />
</div>