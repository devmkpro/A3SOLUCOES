<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

         <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required
                autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)"
                required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

        </div>

        <div>
            <x-input-label for="cpf" :value="__('CPF')" />
            <x-text-input id="cpf" name="cpf" type="text" class="mt-1 block w-full" :value="old('cpf', $user->cpf)"
                required autocomplete="cpf" />
            <x-input-error class="mt-2" :messages="$errors->get('cpf')" />
        </div>

        <div>
            <x-input-label for="birth_date" :value="__('Birth Date')" />
            <x-text-input id="birth_date" name="birth_date" type="date" class="mt-1 block w-full" :value="old('birth_date', \Carbon\Carbon::parse($user->birth_date)->format('Y-m-d'))"
                required autocomplete="birth_date" />
            <x-input-error class="mt-2" :messages="$errors->get('birth_date')" />

            <small class="block font-medium text-sm text-gray-700 dark:text-gray-300 mt-1">
                {{ __('Ager') }} : {{ \Carbon\Carbon::parse($user->birth_date)->age }}
            </small>
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
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
        </script>
    @endsection
</section>
