<x-guest-layout>
    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Título -->
        <h3 class="flex justify-center items-center mt-6 text-white text-xl font-bold">Login</h3>

        <!-- Email Address -->
        <div>
            <x-text-input
                id="email"
                class="block w-full h-12 px-4 py-2 rounded-full md:rounded-full lg:rounded-full xl:rounded-full bg-black text-white border-2 border-gray-500 focus:border-[#1B1A95] outline-none transition-all duration-200 [:-webkit-autofill]:bg-black [:-webkit-autofill]:text-white"
                type="email"
                name="email"
                :value="old('email')"
                required
                autofocus
                autocomplete="username"
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-500" />
        </div>

        <!-- Password -->
        <div>
            <x-text-input
                id="password"
                class="block w-full h-12 px-4 py-2 rounded-full md:rounded-full lg:rounded-full xl:rounded-full bg-black text-white border-2 border-gray-500 focus:border-[#1B1A95] outline-none transition-all duration-200 [:-webkit-autofill]:bg-black [:-webkit-autofill]:text-white"
                type="password"
                name="password"
                required
                autocomplete="current-password"
            />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-500" />
        </div>

        <!-- Login Button -->
        <div class="flex justify-center items-center mt-6">
            <x-primary-button
                style="background-color: #1B1A95;"
                class="justify-center items-center w-full h-12 rounded-full md:rounded-full lg:rounded-full xl:rounded-full text-white font-semibold shadow-lg hover:opacity-90"
            >
                {{ __('Entrar') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
