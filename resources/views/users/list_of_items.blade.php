@extends('layouts.main')
@section('content')
<main class="px-2">
    <x-errors-any></x-errors-any>
    <x-validation-feedback></x-validation-feedback>
    @if (count($items) !== 0)
    <div class="grid grid-cols-2 gap-2 mt-1">
        @foreach ($items as $key => $item)
            <a href="{{ route('items.show', $item->id) }}" class="p-2 bg-white rounded shadow drop-shadow relative" onclick="showLoadingSpinner()">
                @if ($item->sold)
                <div class="absolute top-0 right-0 bottom-0 left-0 bg-slate-300 opacity-25">
                    <div class="absolute text-5xl font-bold top-1/4 left-1/2 -translate-x-1/2 -translate-y-1/2">sold</div>
                </div>
                @endif
                @if ($item->hide)
                <div class="absolute top-0 right-0 bottom-0 left-0 bg-slate-300 opacity-25">
                    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-16 h-16">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                        </svg>
                    </div>
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
    @else
    <div>
        <p>- Anda belum memiliki item yang terpasang. -</p>
    </div>
    @endif
</main>
@endsection

