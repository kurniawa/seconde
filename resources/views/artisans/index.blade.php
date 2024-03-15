@extends('layouts.main')
@section('content')
<header class="bg-white shadow">
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
      <h1 class="text-xl font-bold tracking-tight text-gray-900">Artisan Command Center</h1>
    </div>
  </header>
  <x-errors-any></x-errors-any>
  <x-validation-feedback></x-validation-feedback>
  <main class="p-2">
    <form action="{{ route('artisans.symbolic_link') }}" method="post" class="mt-2">
        @csrf
        <button class="bg-pink-400 text-white font-semibold rounded px-3 py-2">storage:link</button>
    </form>
    <form action="{{ route('artisans.optimize_clear') }}" method="post" class="mt-2">
        @csrf
        <button class="bg-emerald-400 text-white font-semibold rounded px-3 py-2">optimize:clear</button>
    </form>
    <form action="{{ route('artisans.migrate_fresh_seed') }}" method="post" class="mt-2">
        @csrf
        <p>Migration lebih baik setelah storage:link, karena bisa jadi ada file di upload ke storage yang juga seharusnya muncul di public</p>
        <button class="bg-orange-400 text-white font-semibold rounded px-3 py-2">migrate:fresh --seed</button>
    </form>
  </main>
</div>
@endsection
