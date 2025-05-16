<nav class="border-b bg-primary text-foreground border-muted">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            {{-- Logo + Botões de Menu --}}
            <div class="flex items-center space-x-4">
                <a href="{{ route('home') }}" class="flex items-center space-x-2">
                    <x-application-logo class="h-10 text-background" />
                    <span class="text-xl font-semibold text-black">Fakefy</span>
                </a>

                {{-- Botão de Menu Comum (sempre visível) --}}
                <div class="relative">
                    <button id="userMenuBtn" class="flex items-center justify-center w-10 h-10 transition-colors duration-200 rounded-md hover:bg-gray-600 focus:outline-none">
                        <i data-lucide="more-vertical" class="w-5 h-5 text-black"></i>
                    </button>

                    <div id="userMenuDropdown"
                         class="absolute left-0 z-50 hidden w-48 mt-2 text-white border rounded-md shadow-lg bg-primary border-muted">
                        <ul class="py-2 text-sm">
                            @auth
                                @if(!auth()->user()->isAdm())
                                    <li><a href="{{ route('search') }}" class="block px-4 py-2 hover:bg-background">Search</a></li>
                                    <li><a href="{{ route('UserPlaylists') }}" class="block px-4 py-2 hover:bg-background">Playlists</a></li>
                                @else
                                    <li><a href="{{ route('search') }}" class="block px-4 py-2 hover:bg-background">Search</a></li>
                                    <li><a href="{{ route('UserPlaylists') }}" class="block px-4 py-2 hover:bg-background">Playlists</a></li>
                                @endif
                            @endauth
                        </ul>
                    </div>
                </div>

                {{-- Botão de Menu Admin (apenas se for admin) --}}
                @auth
                    @if(auth()->user()->isAdm())
                        <div class="relative">
                            <button id="adminMenuBtn" class="flex items-center justify-center w-10 h-10 transition-colors duration-200 bg-red-600 rounded-md hover:bg-red-700 focus:outline-none">
                                <i data-lucide="more-vertical" class="w-5 h-5 text-black"></i>
                            </button>

                            <div id="adminMenuDropdown"
                                 class="absolute left-0 z-50 hidden w-48 mt-2 text-white border rounded-md shadow-lg bg-primary border-background">
                                <ul class="py-2 text-sm">
                                    <li><a href="{{ route('admin.users.index') }}" class="block px-4 py-2 hover:bg-background">Users</a></li>
                                    <li><a href="{{ route('admin.singers.index') }}" class="block px-4 py-2 hover:bg-background">Singers</a></li>
                                    <li><a href="{{ route('admin.albums.index') }}" class="block px-4 py-2 hover:bg-background">Albums</a></li>
                                    <li><a href="{{ route('admin.songs.index') }}" class="block px-4 py-2 hover:bg-background">Songs</a></li>
                                    <li><a href="{{ route('playlists.index') }}" class="block px-4 py-2 hover:bg-background">Playlists</a></li>
                                </ul>
                            </div>
                        </div>
                    @endif
                @endauth
            </div>

            {{-- Usuário Autenticado (perfil/sair) --}}
            <div class="relative">
                @auth
                    <button id="userDropdownBtn" class="flex items-center px-4 py-2 text-lg font-medium rounded-lg text-primary bg-muted hover:bg-muted focus:outline-none">
                        <i data-lucide="user" class="w-4 h-4 mr-2"></i> {{ Auth::user()->name }}
                    </button>
                    <div id="userDropdownMenu" class="absolute right-0 hidden w-48 mt-2 text-black rounded-lg shadow-md bg-primary dark:bg-muted">
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm hover:bg-white">Perfil</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full px-4 py-2 text-sm text-left hover:bg-white">Sair</button>
                        </form>
                    </div>
                @endauth

                @guest
                    <script>window.location.href = "{{ route('login') }}";</script>
                @endguest
            </div>
        </div>
    </div>
</nav>


{{-- Script para mostrar/esconder os menus dropdown --}}
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Lucide icons
        if (typeof lucide !== "undefined") {
            lucide.createIcons();
        }

        // User Menu
        const userBtn = document.getElementById("userMenuBtn");
        const userDropdown = document.getElementById("userMenuDropdown");
        if (userBtn && userDropdown) {
            userBtn.addEventListener("click", () => {
                userDropdown.classList.toggle("hidden");
            });
            document.addEventListener("click", (event) => {
                if (!userBtn.contains(event.target) && !userDropdown.contains(event.target)) {
                    userDropdown.classList.add("hidden");
                }
            });
        }

        // Admin Menu
        const adminBtn = document.getElementById("adminMenuBtn");
        const adminDropdown = document.getElementById("adminMenuDropdown");
        if (adminBtn && adminDropdown) {
            adminBtn.addEventListener("click", () => {
                adminDropdown.classList.toggle("hidden");
            });
            document.addEventListener("click", (event) => {
                if (!adminBtn.contains(event.target) && !adminDropdown.contains(event.target)) {
                    adminDropdown.classList.add("hidden");
                }
            });
        }

        // Profile Dropdown
        const profileBtn = document.getElementById("userDropdownBtn");
        const profileDropdown = document.getElementById("userDropdownMenu");
        if (profileBtn && profileDropdown) {
            profileBtn.addEventListener("click", () => {
                profileDropdown.classList.toggle("hidden");
            });
            document.addEventListener("click", (event) => {
                if (!profileBtn.contains(event.target) && !profileDropdown.contains(event.target)) {
                    profileDropdown.classList.add("hidden");
                }
            });
        }
    });
</script>

