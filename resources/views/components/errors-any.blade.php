@if ($errors->any())
<div class="fixed bottom-10 left-1/2 -translate-x-1/2 animate-pulse w-full px-2">
    <div id="alert-danger" class="font-semibold px-3 py-2 rounded bg-red-200 text-red-600 opacity-70 flex items-center">
        <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
        </svg>
        <div class="w-full">
        @foreach ($errors->all() as $error)
        {{ $error }}
        @endforeach
        </div>
        <div>
            <button class="text-red-400 font-bold" onclick="$('#alert-danger').hide(300)">X</button>
        </div>
    </div>
</div>
@endif
