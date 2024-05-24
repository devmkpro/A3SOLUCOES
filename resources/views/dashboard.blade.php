<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mt-4">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-lg font-semibold mb-2">{{ __('Tasks') }}</h2>
                    <p>{{ __('You have :count tasks pending', ['count' => auth()->user()->tasks()->where('status', '=', 'pending')->count()]) }}
                    </p>

                    </p>
                </div>

                <a href="{{ route('tasks.index') }}"
                    class="block w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">{{ __('View Tasks') }}</a>
                    
            </div>
        </div>
    </div>
</x-app-layout>
