<!-- Modal de Biografia -->
<div x-data="bioModal()" x-init="init()" x-show="open" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
    <div class="w-1/2 p-6 bg-white rounded-lg shadow-lg">
        <h2 class="mb-4 text-2xl font-bold text-indigo-600" x-text="name"></h2>
        <p class="mb-4 text-gray-700 dark:text-gray-300" x-text="bio"></p>
        <button @click="close()" class="px-4 py-2 text-white transition-all duration-200 bg-indigo-600 rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-600">Fechar</button>
    </div>
</div>

<!-- Modal de Álbuns -->
<div x-data="albumModal()" x-init="init()" x-show="open" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
    <div class="w-1/2 p-6 bg-white rounded-lg shadow-lg">
        <h2 class="mb-4 text-2xl font-bold text-indigo-600" x-text="name"></h2>
        <ul class="mb-4 text-gray-700 dark:text-gray-300">
            <template x-for="album in albums" :key="album.id">
                <li x-text="album.title"></li>
            </template>
        </ul>
        <button @click="close()" class="px-4 py-2 text-white transition-all duration-200 bg-green-600 rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-600">Fechar</button>
    </div>
</div>
