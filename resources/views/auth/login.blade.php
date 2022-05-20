{{-- <x-guest-layout>
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

            <div>
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-jet-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-jet-button class="ml-4">
                    {{ __('Log in') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout> --}}

<x-guest-layout>
    <section class="h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="card-wrapper">
                    <div class="brand bg-white">
                        <img class="p-3" src="{{ asset('img/iot-avocado.png') }}" alt="IOT">
                    </div>
                    <div class="card fat">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Login</h4>
                            {{-- <x-slot name="logo">
                                <x-jet-authentication-card-logo />
                            </x-slot> --}}

                            {{-- <x-jet-validation-errors class="mb-4" /> --}}
                            @if ($errors->has('email'))
                                <div id="email-error" class="error text-danger mb-2" for="email" style="display: block;">
                                    @if ($errors->first('email') != 'El campo email es obligatorio.')
                                        <strong> {{ $errors->first('email') }} </strong>
                                    @endif
                                </div>
                            @endif

                            @if (session('status'))
                                <div class="mb-4 font-medium text-sm text-green-600">
                                    {{ session('status') }}
                                </div>
                            @endif

                            {{-- <form method="POST" class="my-login-validation" novalidate=""> --}}

                            <form method="POST" class="my-login-validation" action="{{ route('login') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="email">{{ __('E-Mail Address') }}</label>
                                    {{-- <input id="email" type="email" class="form-control" name="email" :value="old('email')"
                                        required autofocus> --}}
                                    <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email"
                                        :value="old('email')" />
                                    @if ($errors->has('email'))
                                        <div id="email-error" class="error text-danger pl-3" for="email"
                                            style="display: block;">
                                            @if ($errors->first('email') == 'El campo email es obligatorio.')
                                                <strong> Ingrese un correo </strong>
                                            @endif

                                        </div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="password">{{ __('Password') }}
                                        {{-- <a href="forgot.html" class="float-right">
                                            Forgot Password?
                                        </a> --}}
                                        @if (Route::has('password.request'))
                                            <a class="float-right underline text-sm text-gray-600 hover:text-gray-900"
                                                href="{{ route('password.request') }}">
                                                {{ __('Forgot your password?') }}
                                            </a>
                                        @endif
                                    </label>
                                    {{-- <input id="password" type="password" class="form-control" name="password" required
                                        autocomplete="current-password" data-eye> --}}

                                    <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password"
                                        autofocus autocomplete="new-password" data-eye />
                                    @if ($errors->has('password'))
                                        <div id="password-error" class="error text-danger pl-3" for="password"
                                            style="display: block;">
                                            @if ($errors->first('password') == 'El campo password es obligatorio.')
                                                <strong> Ingrese una contraseña </strong>
                                            @else
                                                <strong> {{ $errors->first('password') }} </strong>
                                            @endif
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <div class="custom-checkbox custom-control">
                                        <input type="checkbox" name="remember_me" id="remember"
                                            class="custom-control-input">
                                        <label for="remember_me"
                                            class="custom-control-label">{{ __('Remember me') }}</label>

                                    </div>
                                </div>

                                <div class="form-group m-0">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        {{ __('Log in') }}
                                    </button>
                                </div>
                        </div>
                    </div>
                    <div class="footer">
                        Copyright &copy; 2021 &mdash; IOT
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-guest-layout>
