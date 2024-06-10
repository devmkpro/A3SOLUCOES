<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @if (auth()->user()->is_admin)
                    <div class="p-6 bg-white dark:bg-gray-800 dark:text-gray-200 rounded-lg shadow">
                        <div class="flex items center">
                            <div class="ml-4">
                                <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                    {{ __('Users') }}
                                </h2>
                                <p class="text-sm text-gray-600 dark:text-gray-300">
                                    {{ __('The system has :count users', ['count' => \App\Models\User::count()]) }}
                                </p>
                            </div>

                        </div>
                        <div class="flex justify-end mt-4">
                            <a type="button"
                                href="{{ route('users.index') }}"class="ml-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                {{ __('View Users') }}
                            </a>
                        </div>
                    </div>
                @endif

                <div class="p-6 bg-white dark:bg-gray-800 dark:text-gray-200 rounded-lg shadow">
                    <div class="flex items center">

                        <div class="ml-4">
                            <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Tarefas Pendentes</h2>
                            <p class="text-sm text-gray-600 dark:text-gray-300">
                                {{ __('You have :count tasks pending', ['count' => \App\Models\Task::where('status', 'pending')->count()]) }}
                            </p>
                        </div>
                    </div>


                    <div class="flex justify-end mt-4">
                        <a type="button"
                            href="{{ route('tasks.index') }}"class="ml-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            {{ __('View Tasks') }}
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
