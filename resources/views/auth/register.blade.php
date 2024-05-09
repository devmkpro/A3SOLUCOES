<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                autofocus autocomplete="name" :placeholder="__('Name')" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                required autocomplete="username" :placeholder="__('Email')" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Date -->
        <div class="mt-4">
            <x-input-label for="birth_date" :value="__('Birth Date')" />

            <x-text-input id="birth_date" class="block mt-1 w-full" type="date" value="{{ old('birth_date') }}"
                name="birth_date" required />

            <x-input-error :messages="$errors->get('birth_date')" class="mt-2" />
        </div>


        <!-- CPF -->
        <div class="mt-4">
            <x-input-label for="cpf" :value="__('CPF')" />

            <x-text-input id="cpf" class="block mt-1 w-full" type="text" :value="old('cpf')" name="cpf"
                :placeholder="__('000.000.000-00')" required />

            <x-input-error :messages="$errors->get('cpf')" class="mt-2" />
        </div>

        <small class="text-gray-500">
            {{ __('Generate a') }} <button href="https://www.4devs.com.br/gerador_de_cpf" 
                class="text-blue-500" type="button" onclick="GerarCpf()">
                {{ __('valid CPF') }}
            </button></small>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Senha')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" :placeholder="__('Senha')" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirmar Senha')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" :placeholder="__('Confirmar Senha')" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>


        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>


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

            function GerarCpfAleatorio() {
                const parte1 = GerarNumeroAleatorio();
                const parte2 = GerarNumeroAleatorio();
                const parte3 = GerarNumeroAleatorio();
                const verificador1 = CalculaDigitoVerificador(parte1, parte2, parte3);
                const verificador2 = CalculaDigitoVerificador(parte1, parte2, parte3, verificador1);

                return `${parte1}.${parte2}.${parte3}-${verificador1}${verificador2}`;
            }

            function CalculaDigitoVerificador(parte1, parte2, parte3, primeiroDigitoVerificador) {
                const numeros = `${parte1}${parte2}${parte3}`.split("");

                if (primeiroDigitoVerificador !== undefined) {
                    numeros[9] = primeiroDigitoVerificador;
                }

                let soma = 0;
                let indice = 0;
                let inicial = primeiroDigitoVerificador !== undefined ? 11 : 10

                for (let numero = inicial; numero >= 2; numero--) {
                    soma += parseInt(numeros[indice]) * numero;
                    indice++;
                }

                const resto = soma % 11;
                return resto < 2 ? 0 : 11 - resto;
            }

            function GerarNumeroAleatorio() {
                return Math.floor(Math.random() * 999).toString().padStart(3, '0');
            }

            function GerarCpf() {
                const cpf = document.getElementById('cpf');
                cpf.value = GerarCpfAleatorio();
            }
        </script>
    @endsection
</x-guest-layout>
