<x-admin-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Event > List') }}
        </h2>
    </x-slot>

    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <a href="{{ route('admin.events.create') }}">
					<x-primary-button type="button" class="mt-4 self-end">
							{{ __('New') }}
					</x-primary-button>
        </a> 

        <div class="mt-6 divide-y">
            @foreach ($events as $event)
            <div class="max-w-md mx-auto my-4 md:max-w-2xl" style="min-height: 160px;">
                <x-event-card :event="$event">
                  <x-dropdown>
                      <x-slot name="trigger">
                          <button>
                              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                  <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                              </svg>
                          </button>
                      </x-slot>
                      <x-slot name="content">
                          <x-dropdown-link :href="route('admin.events.edit', $event)">
                              {{ __('Edit') }}
                          </x-dropdown-link>
                          <form method="POST" action="{{ route('admin.events.destroy', $event) }}">
                              @csrf
                              @method('delete')
                              <x-dropdown-link
                                  :href="route('admin.events.destroy', $event)"
                                  onclick="event.preventDefault(); this.closest('form').submit();">
                                  {{ __('Delete') }}
                              </x-dropdown-link>
                          </form>
                      </x-slot>
                  </x-dropdown>
                </x-event-card>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
</x-admin-app-layout>
