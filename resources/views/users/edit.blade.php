<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-200">
            {{ __('Update User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class=" items-center mb-4">
                @include('components.erros_val')
            </div>

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5 dark:bg-gray-800 shadow">
                <form method="POST" action="{{ route('users.update', $user->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                            :value="old('name')" required autofocus autocomplete="name"
                            placeholder="Digite o nome do usuário" value="{{ $user->name }}" />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                            :value="old('email')" required autofocus autocomplete="email"
                            placeholder="Digite o email do usuário" value="{{ $user->email }}" />
                        <x-input-error class="mt-2" :messages="$errors->get('email')" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="cpf" :value="__('CPF')" />
                        <x-text-input id="cpf" name="cpf" type="text" class="mt-1 block w-full"
                            :value="old('cpf')" required autofocus autocomplete="cpf" placeholder="Ex. 123.456.789-00"
                            value="{{ $user->cpf }}" />
                        <x-input-error class="mt-2" :messages="$errors->get('cpf')" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="birth_date" :value="__('Birth Date')" />
                        <x-text-input id="birth_date" name="birth_date" type="date" class="mt-1 block w-full"
                            :value="old('birth_date')" required autofocus autocomplete="birth_date"
                            placeholder="Digite a data de nascimento" value="{{ \Carbon\Carbon::parse($user->birth_date)->format('Y-m-d') }}" />
                        <x-input-error class="mt-2" :messages="$errors->get('birth_date')" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input id="password" name="password" type="password" class="mt-1 block w-full"
                            :value="old('password')" autofocus autocomplete="password" placeholder="Digite uma nova senha" />
                        <x-input-error class="mt-2" :messages="$errors->get('password')" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                        <x-text-input id="password_confirmation" name="password_confirmation" type="password"
                            class="mt-1 block w-full" :value="old('password_confirmation')" autofocus autocomplete="password_confirmation"
                            placeholder="Confirme a nova senha" />
                        <x-input-error class="mt-2" :messages="$errors->get('password_confirmation')" />
                    </div>




                    <div class="flex items-center space-x-4">

                        <a href="{{ route('users.index') }}"
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

    @section('scripts')
        <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
            crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#cpf').mask('000.000.000-00', {
                    reverse: true
                });
            });
        </script>
    @endsection

</x-app-layout>
