@if(Auth::check())
    <nav class="py-4 border-t-4 bg-primary text-foreground border-accent">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Links de Navegação -->
                <div class="flex space-x-8">
                    <!-- Início -->
                    <a href="{{ route('home') }}" class="flex items-center transition hover:text-foreground
                        {{ request()->routeIs('home') ? 'text-foreground font-semibold' : 'text-muted' }}">
                        <x-icon-home class="mr-2" /> Início
                    </a>

                    <!-- Buscar -->
                    <a href="{{ route('search') }}" class="flex items-center transition hover:text-foreground
                        {{ request()->routeIs('search') ? 'text-foreground font-semibold' : 'text-muted' }}">
                        <x-icon-search class="mr-2" /> Buscar
                    </a>

                    <!-- Playlists -->
                    <a href="{{ route('userplaylist') }}" class="flex items-center transition hover:text-foreground
                        {{ request()->routeIs('userplaylist') ? 'text-foreground font-semibold' : 'text-muted' }}">
                        <x-icon-playlist class="mr-2" /> Playlists
                    </a>

                    <!-- Editar Perfil -->
                    <a href="{{ route('profile.edit') }}" class="flex items-center transition hover:text-foreground
                        {{ request()->routeIs('profile.edit') ? 'text-foreground font-semibold' : 'text-muted' }}">
                        <x-icon-user class="mr-2" /> Editar Perfil
                    </a>
                </div>

                <!-- Dropdown de Usuário -->
                <div class="relative">
                    <button class="flex items-center px-4 py-2 text-sm font-medium rounded-lg text-foreground bg-muted hover:bg-muted-dark">
                        <x-icon-user class="mr-2" /> {{ Auth::user()->name }}
                    </button>
                    <div class="absolute right-0 hidden w-48 mt-2 text-black bg-white rounded-lg shadow-md dark:bg-gray-800">
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm hover:bg-muted">Perfil</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full px-4 py-2 text-sm text-left hover:bg-muted">Sair</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <script>
        // Toggle dropdown de usuário
        document.querySelector('.relative button').addEventListener('click', function () {
            const menu = this.nextElementSibling;
            menu.classList.toggle('hidden');
        });

        // Fecha o dropdown se clicar fora dele
        document.addEventListener('click', function(event) {
            const dropdown = document.querySelector('.relative div');
            const button = document.querySelector('.relative button');

            if (!button.contains(event.target) && !dropdown.contains(event.target)) {
                dropdown.classList.add('hidden');
            }
        });
    </script>
@endif
