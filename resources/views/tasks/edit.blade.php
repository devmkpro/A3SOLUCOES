<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Update Task') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class=" items-center m-5">
                @include('components.erros_val')
            </div>

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
                <form method="POST" action="{{ route('tasks.update', $task->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <x-input-label for="title" :value="__('Title')" />
                        <x-text-input id="title" name="title" type="text" class="mt-1 block w-full"
                            :value="old('title')" required autofocus autocomplete="title" placeholder="Ex. Fazer compras" value="{{ $task->title }}" />
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
                        <x-input-label for="category" :value="__('Completed')" />
                        <select id="completed" name="completed"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option selected value="0" @if ($task->completed == 0) selected @endif>Não</option>
                            <option value="1" @if ($task->completed == 1) selected @endif>Sim</option>
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('completed')" />
                    </div>


                    <div class="flex items-center space-x-4">

                        <a href="{{ route('tasks.index') }}"
                            class="bg-gray-100 text-gray-900 font-medium py-2.5 px-5 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 dark:text-white"
                            data-modal-toggle="createTask">
                            {{ __('Cancel') }}
                        </a>
                        <button type="submit"
                            class="bg-blue-500 text-white font-medium py-2.5 px-5 rounded-lg hover:bg-blue-600">
                            {{ __('Update') }}
                        </button>



                    </div>
            </div>


            </form>
        </div>
    </div>




</x-app-layout>
