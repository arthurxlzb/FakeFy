<nav class="bg-white border-b-4 border-purple-500 dark:bg-gray-800 dark:border-gray-700">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex flex-col">
            <div class="flex justify-between h-16">
                <div class="flex space-x-8">
                    <a href="{{ route('home') }}">
                        <x-application-logo class="block w-auto text-gray-800 fill-current h-9 dark:text-gray-200" />
                    </a>

                    @auth
                        @if(auth()->user()->isAdm())
                            <!-- Menu de admins -->
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
                        @endif
                    @endauth
                </div>
            </div>

            <!-- Agora o menu de usuários aparece claramente abaixo do de admins -->
            @auth
                <div class="mt-4">
                    @include('layouts.NavUser')
                </div>
            @endauth
        </div>
    </div>
</nav>
