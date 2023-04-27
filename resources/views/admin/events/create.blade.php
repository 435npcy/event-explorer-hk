<x-admin-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Event > Create') }}
        </h2>
    </x-slot>

    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('admin.events.store') }}">
            @csrf

            @include('admin.events.partials.create-form')

            <x-primary-button class="mt-4">{{ __('Create') }}</x-primary-button>
        </form>
  </div>
</x-admin-app-layout>