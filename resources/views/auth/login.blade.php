<x-guest-layout>
    <x-jet-authentication-card>
        
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="input-container">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="input-field" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="input-container mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="input-field" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="remember-container block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-jet-checkbox id="remember_me" name="remember" class="remember-checkbox" />
                    <span class="ml-2 text-sm text-teal-400">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="forgot-password text-sm text-gray-600 hover:text-teal-100 href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
                <x-jet-button class="login-button ml-4">
                    {{ __('Log in') }}
                </x-jet-button>
            </div>
            <div class="flex items-center  mt-12">

            <span class=" text-teal-100 text-sm hover:text-teal-100  mx-4">
                {{ __("Not registered yet?") }}
            </span>
        
            @if (Route::has('register'))
                <a class="register-link text-sm text-teal-100 hover:text-teal-500 underline" href="{{ route('register') }}">
                    {{ __('Register now!') }}
                </a>
            @endif
        </div>

        </form>
    </x-jet-authentication-card>

    <style>
        /* Basic Styling */
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
            min-height: 0vh !important;

        }


        

        /* Form Styling */
        .input-container {
            margin-bottom: 20px;
        }

        .input-field {
            width: 100%;
            padding: 12px 15px;
            margin-top: 5px;
            border-radius: 30px; /* Rounded inputs */
            border: 1px solid #ddd;
            background-color: rgba(255, 255, 255, 0.8); /* Slightly transparent background */
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

        .remember-checkbox {
            margin-right: 8px;
        }

        /* Button Styling */
        .login-button {
            background-color: #0e8382;
            color: #fff;
            padding: 12px 20px;
            width: 100%;
            border-radius: 30px; /* Rounded button */
            border: none;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .login-button:hover {
            background-color: #4f8781;
        }

        /* Links */
        .forgot-password {
            color: #2ecbb7;
            text-decoration: none;
        }

        .forgot-password:hover {
            text-decoration: underline;
        }
       
    </style>
</x-guest-layout>
