<x-alert/>

@csrf()

<input type="text" name="name" placeholder="Nome"
       value="{{ isset($user) ? $user->name : old('name') }}"
       class="w-full p-2 text-gray-700 bg-white border rounded-lg dark:bg-gray-800 dark:text-white">

<input type="email" name="email" placeholder="Email"
       value="{{ isset($user) ? $user->email : old('email') }}"
       class="w-full p-2 text-gray-700 bg-white border rounded-lg dark:bg-gray-800 dark:text-white">


<input type="password" name="password" placeholder="Senha"
class="w-full p-2 text-gray-700 bg-white border rounded-lg dark:bg-gray-800 dark:text-white">


<button type="submit" class="w-full p-2 text-gray-700 bg-white border rounded-lg dark:bg-gray-800 dark:text-white">Cadastrar</button>
<a href="/admin/users" class="block w-full p-2 text-center text-gray-700 bg-white border rounded-lg dark:bg-gray-800 dark:text-white">
    Voltar
  </a>

