@extends('layouts.main')
@section('content')
<main class="px-2">
    <x-errors-any></x-errors-any>
    <x-validation-feedback></x-validation-feedback>
    @if (Auth::user())
    <div class="flex justify-end mt-1">
        <a href="{{ route('items.create') }}" onclick="showLoadingSpinner()">
            <button class="bg-emerald-400 text-white p-1 rounded">Add Item</button>
        </a>
    </div>
    @endif
    <div class="grid grid-cols-2 gap-2 mt-1">
        @foreach ($items as $key => $item)
            <a href="{{ route('items.show', $item->id) }}" class="p-2 bg-white rounded shadow drop-shadow relative" onclick="showLoadingSpinner()">
                @if ($item->sold)
                <div class="absolute top-0 right-0 bottom-0 left-0 bg-slate-300 opacity-25">
                    <div class="absolute text-5xl font-bold top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2">sold</div>
                </div>
                @endif
                <div>
                    @if (isset($item_photos[$key]->photo_path))
                    <img src="{{ asset("storage/" . $item_photos[$key]->photo_path) }}" alt="item_photo" class="w-full">
                    @else
                    <div class="bg-indigo-100 text-indigo-400">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-full">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                        </svg>
                    </div>
                    @endif
                </div>
                <div><span class="font-bold text-slate-500">{{ $item->nama }}</span></div>
                <div class="text-xl font-bold text-slate-600"><span>Rp </span><span>{{ number_format(((int)$item->harga / 100), 2, ',', '.') }}</span></div>
                <div class="text-slate-500">By: {{ $item->user->username }}</div>
            </a>
        @endforeach
    </div>
</main>
@endsection

