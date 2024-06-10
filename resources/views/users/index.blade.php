<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="py-12">


        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class=" items-center m-5">
                @include('components.erros_val')
            </div>



            <div class="m-5">

                <form class="max-w-md mx-auto" action="{{ route('users.search') }}">
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
                            placeholder="{{ __('Search for users') }}" value="{{ $search ?? '' }}" required />
                        <button type="submit"
                            class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            {{ __('Search') }}</button>
                    </div>


                    <div class="mt-2 text-center">
                        @if (isset($search))
                            <a href="{{ route('users.index') }}"
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
                                {{ __('Name') }}
                            </th>

                            <th scope="col" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                {{ __('Email') }}
                            </th>

                            <th scope="col" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                {{ __('CPF') }}
                            </th>

                            <th scope="col" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                {{ __('Actions') }}
                            </th>

                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 border-t border-gray-100 dark:border-gray-700">

                        @if ($users->count() > 0)
                            @foreach ($users as $user)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800">
                                    <td class="px-6 py-4">{{ $user->name }}</td>
                                    <td class="px-6 py-4">{{ $user->email }}</td>
                                    <td class="px-6 py-4 cpf">
                                        {{ $user->cpf }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex justify-start gap-2">
                                            <button data-modal-target="popup-modal" data-task-id="{{ $user->id }}"
                                                data-modal-toggle="popup-modal" class="delete-btn">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="h-6 w-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                </svg>
                                            </button>
                                            <a x-data="{ tooltip: 'Edit' }"
                                                href="  {{ route('users.edit', ['user' => $user->id]) }}">
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
                                <td class="px-6 py-4 text-center" colspan="4">
                                    {{ __('No users found') }}
                                </td>
                            </tr>
                        @endif

                    </tbody>
                </table>

                <div class="m-5">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>


    @if ($users->count() > 0)
        <div id="popup-modal" tabindex="-1"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 dark:text-white">
                    <button type="button"
                        class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center "
                        data-modal-hide="popup-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
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

                            {{ __('Are you sure you want to delete this user?') }}
                        </h3>

                        <form action="{{ route('users.destroy', ['user' => 'user_id']) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="user_id" value="">
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
                    form.action = form.action.replace('user_id', taskId);
                    form.querySelector('input[name="user_id"]').value = taskId;
                });
            });
        </script>
        @section('scripts')
            <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
                crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
            <script>
                $(document).ready(function() {
                    $('.cpf').mask('000.000.000-00', {
                        reverse: true
                    });
                });
            </script>
        @endsection
    @endif

</x-app-layout>
