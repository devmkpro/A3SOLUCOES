<x-app-layout>
    @section('styles')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @endsection

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tasks') }}
        </h2>
    </x-slot>

    <div class="py-12">


        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class=" items-center m-5">
                @include('components.erros_val')
            </div>

            <div class="flex justify-end mb-5">
                <button data-modal-target="createSubTask" data-modal-toggle="createSubTask"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                </button>
            </div>

            <div class="m-5">

                <form class="max-w-md mx-auto" action="{{ route('subtasks.search') }}">
                    <label for="default-search"
                        class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>
                        <input type="search" id="default-search" name="search"
                            class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="{{ __('Search for subtasks') }}" value="{{ $search ?? '' }}" required />
                        <button type="submit"
                            class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            {{ __('Search') }}</button>
                    </div>


                    <div class="mt-2 text-center">
                        @if (isset($search))
                            <a href="{{ route('subtasks.index') }}"
                                class="text-blue-500 hover:text-blue-700 font-medium text-sm dark:text-blue-400 dark:hover:text-blue-500">
                                {{ __('Clear search') }}
                            </a>
                        @endif

                    </div>
                </form>


            </div>


            <div class="relative  overflow-x-auto overflow-hidden rounded-lg border border-gray-200 shadow-md m-5">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-200">
                        <tr>

                            <th scope="col" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                {{ __('Task') }}
                            </th>

                            <th scope="col" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                {{ __('Title') }}
                            </th>

                            <th scope="col" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                {{ __('Description') }}
                            </th>

                            <th scope="col" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                {{ __('Expires at') }}
                            </th>

                            <th scope="col" class="px-6 py-4 font-medium text-gray-900 dark:text-white text-center">
                                {{ __('Status') }}
                            </th>

                            <th scope="col" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                {{ __('Actions') }}
                            </th>

                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 border-t border-gray-100 dark:border-gray-700">

                        @if ($subtasks->count() > 0)
                            @foreach ($subtasks as $subtask)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800">
                                    <td class="px-6 py-4">{{ $subtask->task->title }}</td>
                                    <td class="px-6 py-4">{{ $subtask->title }}</td>
                                    <td class="px-6 py-4">{{ $subtask->description }}</td>
                                    <td class="px-6 py-4">
                                        @if ($subtask->expires_at)
                                            {{ \Carbon\Carbon::parse($subtask->expires_at)->format('d/m/Y') }}
                                        @else
                                            {{ __('No date') }}
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        @if ($subtask->status == 'completed')
                                            <span
                                                class="text-green-500 bg-green-100 font-semibold px-2.5 py-1.5 rounded-full dark:bg-green-900 dark:text-green-200">
                                                {{ __('Completed') }}
                                            </span>
                                        @elseif ( $subtask->status == 'expired' || $subtask->expires_at < now())
                                            <span
                                                class="text-red-500 bg-red-100 font-semibold px-2.5 py-1.5 rounded-full">
                                                {{ __('Expired') }}
                                            </span>
                                        @elseif ($subtask->status == 'canceled')
                                            <span
                                                class="text-red-500 bg-red-100 font-semibold px-2.5 py-1.5 rounded-full">
                                                {{ __('Canceled') }}
                                            </span>
                                        @elseif ($subtask->status == 'pending')
                                            <span
                                                class="text-yellow-500 bg-yellow-100 font-semibold px-2.5 py-1.5 rounded-full">
                                                {{ __('Pending') }}
                                            </span>
                                        @endif
                                    </td>


                                    <td class="px-6 py-4">
                                        <div class="flex justify-start gap-2">
                                            <button data-modal-target="popup-modal" data-task-id="{{ $subtask->id }}"
                                                data-modal-toggle="popup-modal" class="delete-btn">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="h-6 w-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                </svg>
                                            </button>
                                            <a x-data="{ tooltip: 'Edit' }"
                                                href="  {{ route('subtasks.edit', ['subtask' => $subtask->id]) }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="h-6 w-6" x-tooltip="tooltip">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                                </svg>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="px-6 py-4 text-center" colspan="6">
                                    {{ __('No subtasks found') }}
                                </td>
                            </tr>
                        @endif

                    </tbody>
                </table>
            </div>
        </div>
    </div>



    <!-- modals -->
    <div id="createSubTask" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full dark:bg-gray-900 dark:bg-opacity-50 dark:text-white">
        <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
            <!-- Modal content -->
            <div class="relative p-4 bg-white rounded-lg shadow  sm:p-5 dark:bg-gray-800">
                <!-- Modal header -->
                <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 ">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        {{ __('Create SubTask') }}
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center "
                        data-modal-toggle="createSubTask">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form action="{{ route('subtasks.store') }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="grid gap-4 mb-4 grid-cols-1 ">

                        <small class="text-gray-500 dark:text-gray-400">
                            {{ __('Fields with') }} <span class="text-red-600">*</span> {{ __('are required') }}
                        </small>

                        <div>
                            <x-input-label for="title" :value="__('Title')" :required=true />
                            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full"
                                :value="old('title')" required autofocus autocomplete="title"
                                placeholder="Ex. Pesquisar sobre Laravel" />
                            <x-input-error class="mt-2" :messages="$errors->get('title')" />

                        </div>
                        <div>
                            <x-input-label for="description" :value="__('Description')" :required=true />
                            <x-text-input id="description" name="description" type="text"
                                class="mt-1 block w-full" :value="old('description')" required autofocus
                                autocomplete="description"
                                placeholder="Ex. Realizar a pesquisa em fontes confiáveis" />
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />

                        </div>

                        <div>
                            <x-input-label for="expires_at" :value="__('expires_at')" />
                            <x-text-input id="expires_at" name="expires_at" type="date" class="mt-1 block w-full"
                                :value="old('expires_at')" autofocus autocomplete="expires_at" />
                            <x-input-error class="mt-2" :messages="$errors->get('expires_at')" />

                        </div>

                        <select class="task_id_selelect" name="task_id">
                            @foreach ($tasks as $task)
                                <option value="{{ $task->id }}">{{ $task->title }}</option>
                            @endforeach
                        </select>

                        <div>
                            <x-input-label for="status" :value="__('Status')" />
                            <select id="status" name="status"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 dark:focus:ring-primary-600 dark:focus:border-primary-600">
                                <option selected value="pending">{{ __('Pending') }}</option>
                                <option value="completed">{{ __('Completed') }}</option>
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('status')" />
                        </div>

                    </div>
                    <div class="flex items-center space-x-4">

                        <button type="button"
                            class="bg-gray-100 text-gray-900 font-medium py-2.5 px-5 rounded-lg hover:bg-gray-200 "
                            data-modal-toggle="createSubTask">
                            {{ __('Cancel') }}
                        </button>
                        <button type="submit"
                            class="bg-blue-500 text-white font-medium py-2.5 px-5 rounded-lg hover:bg-blue-600">
                            {{ __('Create') }}
                        </button>



                    </div>
                </form>
            </div>
        </div>
    </div>



    @if ($subtasks->count() > 0)
        <div id="popup-modal" tabindex="-1"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 dark:text-white">
                    <button type="button"
                        class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center "
                        data-modal-hide="popup-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div class="p-4 md:p-5 text-center">
                        <svg class="mx-auto mb-4 text-gray-400 w-12 h-12" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-white">

                            {{ __('Are you sure you want to delete this subtask?') }}
                        </h3>

                        <form action="{{ route('subtasks.destroy', ['subtask' => 'subtask_id']) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="subtask_id" value="">
                            <button data-modal-hide="popup-modal" type="submit"
                                class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300  font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 ">
                                {{ __('Yes, delete') }}
                            </button>
                            <button data-modal-hide="popup-modal" type="button"
                                class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 ">
                                {{ __('No, cancel') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.querySelectorAll('.delete-btn').forEach(button => {
                button.addEventListener('click', () => {
                    const taskId = button.dataset.taskId;
                    const modal = document.querySelector('#popup-modal');
                    const form = modal.querySelector('form');
                    form.action = form.action.replace('subtask_id', taskId);
                    form.querySelector('input[name="subtask_id"]').value = taskId;
                });
            });

        </script>
    @endif

    @section('scripts')
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
            $(document).ready(function() {
                $('.task_id_selelect').select2({
                    theme: "classic"
                });
                
            });
        </script>
    @endsection

</x-app-layout>
