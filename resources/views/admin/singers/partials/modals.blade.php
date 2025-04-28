<!-- Modal de Biografia -->
<div x-data="bioModal()" x-init="init()" x-show="open" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
    <div class="w-1/2 p-6 bg-white rounded-lg">
        <h2 class="mb-4 text-2xl font-bold" x-text="name"></h2>
        <p class="mb-4" x-text="bio"></p>
        <button @click="close()" class="px-4 py-2 text-white bg-blue-600 rounded">Fechar</button>
    </div>
</div>

<!-- Modal de Álbuns -->
<div x-data="albumModal()" x-init="init()" x-show="open" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
    <div class="w-1/2 p-6 bg-white rounded-lg">
        <h2 class="mb-4 text-2xl font-bold" x-text="name"></h2>
        <ul class="mb-4">
            <template x-for="album in albums" :key="album.id">
                <li x-text="album.title"></li>
            </template>
        </ul>
        <button @click="close()" class="px-4 py-2 text-white bg-green-600 rounded">Fechar</button>
    </div>
</div>

<script>
    function bioModal() {
        return {
            open: false,
            name: '',
            bio: '',
            init() {
                window.addEventListener('show-bio', event => {
                    this.name = event.detail.name;
                    this.bio = event.detail.bio;
                    this.open = true;
                });
            },
            close() {
                this.open = false;
            }
        }
    }

    function albumModal() {
        return {
            open: false,
            name: '',
            albums: [],
            init() {
                window.addEventListener('show-albums', event => {
                    this.name = event.detail.name;
                    this.albums = event.detail.albums;
                    this.open = true;
                });
            },
            close() {
                this.open = false;
            }
        }
    }
</script>
