<nav class="border-b bg-primary text-foreground border-muted">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">

            {{-- Logo + Botão de Menu --}}
            <div class="flex items-center space-x-4">
                <a href="{{ route('home') }}" class="flex items-center space-x-2">
                    <x-application-logo class="h-10 text-foreground" />
                    <span class="text-xl font-semibold">Fakefy</span>
                </a>

                {{-- Botão de Menu Expansivo --}}
<div class="relative">
    <button id="adminMenuBtn" class="flex items-center justify-center w-10 h-10 rounded-md hover:bg-gray-100 focus:outline-none">
        <i data-lucide="more-vertical" class="w-5 h-5 text-gray-700"></i>
    </button>

    {{-- Menu suspenso (desktop) --}}
    <div id="adminMenuDropdown"
         class="absolute left-0 z-50 hidden w-48 mt-2 text-gray-900 bg-white border border-gray-200 rounded-md shadow-lg">
        <ul class="py-2 text-sm">
            @auth
                @if(auth()->user()->isAdm())
                    <li><a href="{{ route('admin.users.index') }}" class="block px-4 py-2 hover:bg-gray-100">Users</a></li>
                    <li><a href="{{ route('admin.singers.index') }}" class="block px-4 py-2 hover:bg-gray-100">Singers</a></li>
                    <li><a href="{{ route('admin.albums.index') }}" class="block px-4 py-2 hover:bg-gray-100">Albums</a></li>
                    <li><a href="{{ route('admin.songs.index') }}" class="block px-4 py-2 hover:bg-gray-100">Songs</a></li>
                    <li><a href="{{ route('playlists.index') }}" class="block px-4 py-2 hover:bg-gray-100">Playlists</a></li>
                @else
                    <li><a href="{{ route('search') }}" class="block px-4 py-2 hover:bg-gray-100">Search</a></li>
                    <li><a href="{{ route('UserPlaylists') }}" class="block px-4 py-2 hover:bg-gray-100">Playlists</a></li>
                    <li><a href="{{ route('profile.edit') }}" class="block px-4 py-2 hover:bg-gray-100">Perfil</a></li>
                @endif
            @endauth
        </ul>
    </div>
</div>

            </div>

            {{-- Usuário Autenticado --}}
            <div class="relative">
                @auth
                    <button id="userDropdownBtn" class="flex items-center px-4 py-2 text-lg font-medium rounded-lg text-foreground bg-muted hover:bg-muted-dark focus:outline-none">
                        <i data-lucide="user" class="w-4 h-4 mr-2"></i> {{ Auth::user()->name }}
                    </button>
                    <div id="userDropdownMenu" class="absolute right-0 hidden w-48 mt-2 text-black bg-white rounded-lg shadow-md dark:bg-gray-800">
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm hover:bg-muted">Perfil</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full px-4 py-2 text-sm text-left hover:bg-muted">Sair</button>
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
        // Ícones Lucide
        if (typeof lucide !== "undefined") {
            lucide.createIcons();
        }

        // Toggle Menu Admin
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

        // Toggle Dropdown de Usuário
        const userBtn = document.getElementById("userDropdownBtn");
        const userDropdown = document.getElementById("userDropdownMenu");

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
    });
</script>
