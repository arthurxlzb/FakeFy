@if(Auth::check())
    <nav class="px-6 py-4 bg-green-700 border-t-4 border-green-500">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex space-x-8">
                    <a href="{{ route('home') }}"
                       class="flex items-center transition hover:text-white
                              {{ request()->routeIs('home') ? 'text-white font-bold' : 'text-gray-200' }}">
                        <i class="fas fa-home"></i> Início
                    </a>

                    <a href="{{ route('search') }}"
                       class="flex items-center transition hover:text-white
                              {{ request()->routeIs('search') ? 'text-white font-bold' : 'text-gray-200' }}">
                        <i class="fas fa-search"></i> Buscar
                    </a>

                    <a href="{{ route('userplaylist') }}"
                       class="flex items-center transition hover:text-white
                              {{ request()->routeIs('userplaylist') ? 'text-white font-bold' : 'text-gray-200' }}">
                        <i class="fas fa-list"></i> Playlists
                    </a>

                    <a href="{{ route('profile.edit') }}"
   class="flex items-center transition hover:text-white
          {{ request()->routeIs('profile.edit') ? 'text-white font-bold' : 'text-gray-200' }}">
    <i class="fas fa-user"></i> Editar Perfil
</a>

                </div>
            </div>
        </div>
    </nav>
@endif
