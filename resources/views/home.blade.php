@extends('layouts.main')
@section('content')
<main class="p-2">
    <x-errors-any></x-errors-any>
    <x-validation-feedback></x-validation-feedback>
    <div class="flex justify-end">
        <a href="{{ route('items.create') }}">
            <button class="bg-emerald-400 text-white p-1 rounded">Add Item</button>
        </a>
    </div>
</main>
@endsection

