<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="input-container">
                <x-jet-label for="name" value="{{ __('Name') }}" />
                <x-jet-input id="name" class="input-field" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="input-container mt-4">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="input-field" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="input-container mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="input-field" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="input-container mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-jet-input id="password_confirmation" class="input-field" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="remember-container mt-4">
                    <label for="terms" class="flex items-center">
                        <x-jet-checkbox name="terms" id="terms" required />
                        <span class="ml-2 text-sm text-teal-400">
                            {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                    'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-teal-400 hover:text-teal-600">'.__('Terms of Service').'</a>',
                                    'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-teal-400 hover:text-teal-600">'.__('Privacy Policy').'</a>',
                            ]) !!}
                        </span>
                    </label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="forgot-password hover:text-teal-100 text-sm" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>
                <x-jet-button class="login-button ml-4">
                    {{ __('Register') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>

    <style>
        /* Reuse same CSS from the login page */
        body {
            font-family: 'Montserrat', sans-serif;
            background-image: url('{{ asset('assets/img/background.jpg') }}');
            background-size: cover;
            background-position: center;
            color: #333;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .input-container {
            margin-bottom: 20px;
        }

        .input-field {
            width: 100%;
            padding: 12px 15px;
            margin-top: 5px;
            border-radius: 30px;
            border: 1px solid #ddd;
            background-color: rgba(255, 255, 255, 0.8);
            font-size: 14px;
            color: #3a827f;
            transition: border 0.3s ease;
        }

        .input-field:focus {
            border-color: #7cecd5;
            outline: none;
        }

        .remember-container {
            display: flex;
            align-items: center;
        }

        .login-button {
            background-color: #0e8382;
            color: #fff;
            padding: 12px 20px;
            width: 100%;
            border-radius: 30px;
            border: none;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .login-button:hover {
            background-color: #4f8781;
        }

        .forgot-password {
            color: #2ecbb7;
            text-decoration: none;
        }

        .forgot-password:hover {
            text-decoration: underline;
        }
    </style>
</x-guest-layout>
