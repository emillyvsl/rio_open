<x-guest-layout>
    <form method="POST" action="{{ route('login') }}" class="space-y-6 w-full px-4 py-6">
        @csrf

        <!-- Título Ampliado -->
        <h3 class="flex justify-center items-center mb-8 text-white text-2xl font-bold">Login</h3>

        <!-- Email Address -->
        <div class="mb-6">
            <x-text-input
                id="email"
                class="block w-full h-14 px-6 text-lg rounded-full bg-white text-black border-2 border-gray-500 focus:border-[#1B1A95] outline-none transition-all duration-200"
                type="email"
                name="email"
                :value="old('email')"
                required
                autofocus
                placeholder="Email"
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-500" />
        </div>

        <!-- Password -->
        <div class="mb-8">
            <x-text-input
                id="password"
                class="block w-full h-14 px-6 text-lg rounded-full bg-white text-black border-2 border-gray-500 focus:border-[#1B1A95] outline-none transition-all duration-200"
                type="password"
                name="password"
                required
                placeholder="Senha"
            />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-500" />
        </div>

        <!-- Botão Ampliado -->
        <div class="flex justify-center items-center">
            <x-primary-button
                style="background-color: #1B1A95;"
                class="justify-center items-center w-full h-14 text-lg rounded-full text-white font-semibold hover:opacity-90 transition-all"
            >
                {{ __('Entrar') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
