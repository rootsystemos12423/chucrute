<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-100">
        <div class="w-full max-w-md bg-white shadow-lg rounded-lg p-8">
            <div class="flex justify-center mb-6">
                <x-authentication-card-logo />
            </div>

            <h2 class="text-2xl font-semibold text-center text-gray-700">Entre na sua conta</h2>
            <p class="text-center text-gray-500 mb-6">Para acessar sua conta, informe seu e-mail e senha.</p>

            <x-validation-errors class="mb-4" />

            @session('status')
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ $value }}
                </div>
            @endsession

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div>
                    <x-label for="email" value="{{ __('E-mail') }}" class="text-gray-600" />
                    <x-input id="email" class="block mt-1 w-full border-gray-300 rounded-lg" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                </div>

                <div class="mt-4">
                    <x-label for="password" value="{{ __('Senha') }}" class="text-gray-600" />
                    <x-input id="password" class="block mt-1 w-full border-gray-300 rounded-lg" type="password" name="password" required autocomplete="current-password" />
                </div>

                <div class="block mt-4">
                    <label for="remember_me" class="flex items-center">
                        <x-checkbox id="remember_me" name="remember" class="text-pink-500" />
                        <span class="ms-2 text-sm text-gray-600">{{ __('Lembrar de mim') }}</span>
                    </label>
                </div>

                <div class="flex items-center justify-between mt-4">
                    @if (Route::has('password.request'))
                        <a class="text-sm text-gray-600 hover:text-pink-500" href="{{ route('password.request') }}">
                            {{ __('Esqueci minha senha') }}
                        </a>
                    @endif

                    <x-button class="bg-pink-500 hover:bg-pink-600 text-white font-bold py-2 px-4 rounded-lg">
                        {{ __('Fazer login') }}
                    </x-button>
                </div>
            </form>

            <div class="text-center mt-6">
                <p class="text-gray-600">Ainda não tem conta? <a href="{{ route('register') }}" class="text-pink-500 hover:underline">Cadastre-se</a></p>
            </div>
        </div>
    </div>
</x-guest-layout>
