<nav x-data="{ open: false, dropdownOpen: false }" class="bg-black border-b border-blue-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="shrink-0">
                <a href="/">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-14">
                </a>
            </div>

            <!-- Navigation Links -->
            <div class="hidden sm:flex space-x-8">
                <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    {{ __('Cadastro de usuários') }}
                </x-nav-link>
                <a href="#" class="text-white text-lg hover:text-blue-400 font-semibold transition-all border-b-2 border-transparent hover:border-blue-400">
                    Estoque de brindes
                </a>
            </div>

            <!-- Dropdown Configurações -->
            <div class="relative hidden sm:flex items-center">
                <button @click="dropdownOpen = !dropdownOpen" class="text-white flex items-center space-x-2 hover:text-blue-400">
                    <span>{{ Auth::user()->name }}</span>
                    <svg class="w-5 h-5 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                </button>

                <!-- Dropdown Menu -->
                <div x-show="dropdownOpen" @click.away="dropdownOpen = false" class="absolute right-0 mt-2 w-48 bg-gray-900 text-white rounded-md shadow-lg z-50 overflow-hidden">
                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm hover:bg-gray-700">Perfil</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm hover:bg-gray-700">
                            Sair
                        </button>
                    </form>
                </div>
            </div>

            <!-- Responsive Menu Button -->
            <div class="-me-2 flex sm:hidden">
                <button @click="open = !open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:bg-gray-700 focus:text-white transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open}" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        <path :class="{'hidden': !open, 'inline-flex': open}" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': !open}" class="hidden sm:hidden bg-black">
        <div class="space-y-1">
            <a href="#" class="block text-white hover:text-blue-400 px-3 py-2 rounded-md text-base font-medium">
                Cadastro de usuários
            </a>
            <a href="#" class="block text-white hover:text-blue-400 px-3 py-2 rounded-md text-base font-medium">
                Estoque de brindes
            </a>
        </div>

        <!-- Dropdown Configurações Responsivo -->
        <div class="mt-2 border-t border-gray-700 pt-2">
            {{--  <a href="{{ route('profile.edit') }}" class="block px-3 py-2 text-sm text-white hover:bg-gray-700">
                Perfil
            </a>  --}}
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="block w-full text-left px-3 py-2 text-sm text-white hover:bg-gray-700">
                    Sair
                </button>
            </form>
        </div>
    </div>
</nav>
