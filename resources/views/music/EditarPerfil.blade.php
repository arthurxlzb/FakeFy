@extends ('layouts.app')

@section('title', 'Editar Perfil')

@section('content')
<div class="max-w-xl p-6 mx-auto mt-10 border shadow-lg bg-background border-border rounded-2xl">
    <h1 class="mb-6 text-xl font-bold text-foreground">Editar Perfil</h1>

    <form action="{{ route('profile.update') }}" method="POST" class="space-y-6">
        @method('PUT')
        @csrf

        <div class="space-y-2">
            <label for="name" class="block text-lg font-medium text-foreground">Nome</label>
            <input
                type="text"
                name="name"
                id="name"
                placeholder="Seu nome"
                value="{{ auth()->user()->name }}"
                class="w-full px-4 py-3 text-lg border rounded-lg bg-muted text-foreground border-border focus:outline-none focus:ring-2 focus:ring-ring"
            >
        </div>

        <div class="space-y-2">
            <label for="email" class="block text-xl font-medium text-foreground">Email</label>
            <input
                type="email"
                name="email"
                id="email"
                placeholder="Seu email"
                value="{{ auth()->user()->email }}"
                class="w-full px-4 py-3 text-lg border rounded-lg bg-muted text-foreground border-border focus:outline-none focus:ring-2 focus:ring-ring"
            >
        </div>

        <div class="space-y-2">
            <label for="password" class="block text-xl font-medium text-foreground">Nova Senha</label>
            <input
                type="password"
                name="password"
                id="password"
                placeholder="Deixe em branco para manter a atual"
                class="w-full px-4 py-3 text-lg border rounded-lg bg-muted text-foreground border-border focus:outline-none focus:ring-2 focus:ring-ring"
            >
        </div>

        <div class="flex flex-col justify-between gap-3 sm:flex-row sm:items-center">
            <button type="submit" class="w-full px-6 py-3 text-xl font-medium text-center rounded-lg text-foreground bg-muted hover:bg-muted/80 sm:w-auto">
                Atualizar Perfil
            </button>
            <a href="{{ route('home') }}" class="w-full px-6 py-3 text-xl font-medium text-center rounded-lg text-foreground bg-muted hover:bg-muted/80 sm:w-auto">
                Voltar
            </a>
        </div>
    </form>
</div>
@endsection
