<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 dark:bg-gray-800 dark:border-gray-700">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex items-center shrink-0">
                    <a href="{{ route('home') }}">
                        <x-application-logo class="block w-auto text-gray-800 fill-current h-9 dark:text-gray-200" />
                    </a>
                </div>

                <!-- Admin Navigation Links -->
                @auth
                    @if (auth()->user()->isAdm())
                        <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                            <x-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')">
                                {{ __('Users') }}
                            </x-nav-link>
                            <x-nav-link :href="route('admin.singers.index')" :active="request()->routeIs('admin.singers.*')">
                                {{ __('Singers') }}
                            </x-nav-link>
                            <x-nav-link :href="route('admin.albums.index')" :active="request()->routeIs('admin.albums.*')">
                                {{ __('Albums') }}
                            </x-nav-link>
                            <x-nav-link :href="route('admin.songs.index')" :active="request()->routeIs('admin.songs.*')">
                                {{ __('Songs') }}
                            </x-nav-link>
                            <x-nav-link :href="route('playlists.index')" :active="request()->routeIs('playlists.*')">
                                {{ __('Playlists') }}
                            </x-nav-link>
                        </div>
                    @endif
                @endauth
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out bg-white border border-transparent rounded-md dark:text-gray-400 dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ms-1">
                                    <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="flex items-center -me-2 sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 text-gray-400 rounded-md hover:text-gray-500 focus:outline-none">
                    <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Rodapé fixo visível para todos os usuários comuns (mobile e desktop) -->
    @auth
            <div class="fixed bottom-0 left-0 right-0 z-50 flex justify-around bg-white border-t border-gray-300 dark:bg-gray-800 dark:border-gray-700">
                <a href="{{ route('home') }}" class="flex flex-col items-center justify-center flex-1 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">
                    <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l9-9 9 9v9a2 2 0 01-2 2h-4a2 2 0 01-2-2V13H9v8a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
                    </svg>
                    <span class="text-xs">Início</span>
                </a>
                <a href="{{ route('search') }}" class="flex flex-col items-center justify-center flex-1 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">
                    <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <span class="text-xs">Buscar</span>
                </a>
                <a href="{{ route('userplaylist') }}" class="flex flex-col items-center justify-center flex-1 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">
                    <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 7h14M3 12h10m-10 5h6M17 7h2a2 2 0 012 2v10a2 2 0 01-2 2h-2"/>
                    </svg>
                    <span class="text-xs">Playlists</span>
                </a>
            </div>
    @endauth
</nav>
