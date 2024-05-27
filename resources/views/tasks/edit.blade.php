<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Update Task') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class=" items-center mb-4">
                @include('components.erros_val')
            </div>

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5 dark:bg-gray-800 shadow">
                <form method="POST" action="{{ route('tasks.update', $task->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <x-input-label for="title" :value="__('Title')" />
                        <x-text-input id="title" name="title" type="text" class="mt-1 block w-full"
                            :value="old('title')" required autofocus autocomplete="title" placeholder="Ex. Fazer compras"
                            value="{{ $task->title }}" />
                        <x-input-error class="mt-2" :messages="$errors->get('title')" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="description" :value="__('Description')" />
                        <x-text-input id="description" name="description" type="text" class="mt-1 block w-full"
                            :value="old('description')" required autofocus autocomplete="description"
                            placeholder="Ex. Comprar pão, leite e ovos" value="{{ $task->description }}" />
                        <x-input-error class="mt-2" :messages="$errors->get('description')" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="recurrence_type" :value="__('Recurrence Type')" />
                        <select id="recurrence_type" name="recurrence_type"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 dark:focus:ring-primary-600 dark:focus:border-primary-600">
                            <option @if($task->recurrence_type == 'daily') selected @endif value="daily">{{ __('Daily') }}</option>
                            <option @if($task->recurrence_type == 'weekly') selected @endif value="weekly">{{ __('Weekly') }}</option>
                            <option @if($task->recurrence_type == 'monthly') selected @endif value="monthly">{{ __('Monthly') }}</option>
                            <option @if($task->recurrence_type == 'yearly') selected @endif value="yearly">{{ __('Yearly') }}</option>
                            <option @if(!$task->recurrence_type) selected @endif value="">{{ __('No') }}</option>
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('recurrence_type')" />
                    </div>


                    <div class="mb-4 mt-4">
                        <x-input-label for="expires_at" :value="__('expires_at')" />
                        <x-text-input id="expires_at" name="expires_at" type="date" class="mt-1 block w-full"
                            value="{{ $task->expires_at ? \Carbon\Carbon::parse($task->expires_at)->format('Y-m-d') : old('expires_at') }}"
                            autofocus autocomplete="expires_at" />
                        <x-input-error class="mt-2" :messages="$errors->get('expires_at')" />

                    </div>

                    <div class="mb-4">
                        <x-input-label for="status" :value="__('Status')" />
                        <select id="status" name="status"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 dark:focus:ring-primary-600 dark:focus:border-primary-600">
                            <option selected value="pending" @if($task->status == 'pending') selected @endif>{{ __('Pending') }}</option>
                            <option value="completed" @if($task->status == 'completed') selected @endif >{{ __('Completed') }}</option>
                            <option value="canceled" @if($task->status == 'canceled') selected @endif>{{ __('Canceled') }}</option>
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('status')" />
                    </div>

                    @if ($task->subTasks->count() > 0)

                        <div class="mb-4">
                            <div class="flex items-center">
                                <input id="subtasks" name="change_subtasks" type="checkbox"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset
                                    dark:bg-gray-700 dark:border-gray-600">
                                    <label for="subtasks" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                        {{ __('Change Subtasks Status') }}
                                    </label>

                                <small 
                                    class= "ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                   {{ __('This changes the statuses of all subtasks related to this task') }}
                                </small>
                            </div>


                        </div>

                    @endif


                    <div class="flex items-center space-x-4">

                        <a href="{{ route('tasks.index') }}"
                            class="bg-gray-100 text-gray-900 font-medium py-2.5 px-5 rounded-lg hover:bg-gray-200"
                            data-modal-toggle="createTask">
                            {{ __('Cancel') }}
                        </a>


                        <button type="submit"
                            class="bg-blue-500 text-white font-medium py-2.5 px-5 rounded-lg hover:bg-blue-600 dark:bg-blue-600 dark:hover:bg-blue-700">
                            {{ __('Update') }}
                        </button>



                    </div>
            </div>


            </form>
        </div>
    </div>


</x-app-layout>
