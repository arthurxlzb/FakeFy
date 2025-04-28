@if(session()->has('success'))
<div class = "pg-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400">
  {{session('success')}}
  </div>
@endif
    
@if(session()->has('message'))
<div class = "pg-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="aler">
  {{session('message')}}
</div>
@endif

@if(session()->has('error'))
<div class = "pg-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400">
  {{session('error')}}
</div>
@endif

@if($errors->any())
<ul>
    @foreach ($errors->all() as $error)
    <li class ="pg-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400">{{ $error }}</li>
    @endforeach
</ul>
@endif