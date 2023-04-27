<x-admin-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Event > Edit') }}
        </h2>
    </x-slot>

    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8 border rounded-3xl bg-slate-200 my-8">
        <form method="POST" action="{{ route('admin.events.update', ['event' => $event]) }}">
            @csrf
            @method('patch')

            @include('admin.events.partials.update-form')

            <x-primary-button class="mt-4">{{ __('Update') }}</x-primary-button>
        </form>
    </div>
</x-admin-app-layout>