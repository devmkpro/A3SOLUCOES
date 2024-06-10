<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-200">
            {{ __('Update SubTask') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class=" items-center mb-4">
                @include('components.erros_val')
            </div>

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5 dark:bg-gray-800 shadow">
                <form method="POST" action="{{ route('subtasks.update', $subtask->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <x-input-label for="title" :value="__('Title')" />
                        <x-text-input id="title" name="title" type="text" class="mt-1 block w-full"
                            :value="old('title')" required autofocus autocomplete="title" placeholder="Ex. Fazer compras"
                            value="{{ $subtask->title }}" />
                        <x-input-error class="mt-2" :messages="$errors->get('title')" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="description" :value="__('Description')" />
                        <x-text-input id="description" name="description" type="text" class="mt-1 block w-full"
                            :value="old('description')" required autofocus autocomplete="description"
                            placeholder="Ex. Comprar pão, leite e ovos" value="{{ $subtask->description }}" />
                        <x-input-error class="mt-2" :messages="$errors->get('description')" />
                    </div>

                    <div class="mb-4 mt-4">
                        <x-input-label for="expires_at" :value="__('expires_at')" />
                        <x-text-input id="expires_at" name="expires_at" type="date" class="mt-1 block w-full"
                            value="{{ $subtask->expires_at ? \Carbon\Carbon::parse($subtask->expires_at)->format('Y-m-d') : old('expires_at') }}"
                            autofocus autocomplete="expires_at" />
                        <x-input-error class="mt-2" :messages="$errors->get('expires_at')" />

                    </div>

                    <div class="mb-4">
                        <x-input-label for="status" :value="__('Status')" />
                        <select id="status" name="status"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 dark:focus:ring-primary-600 dark:focus:border-primary-600">
                            <option selected value="pending">{{ __('Pending') }}</option>
                            <option value="completed">{{ __('Completed') }}</option>
                            <option value="canceled">{{ __('Canceled') }}</option>
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('status')" />
                    </div>


                    <div class="flex items-center space-x-4">

                        <a href="{{ route('subtasks.index') }}"
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
