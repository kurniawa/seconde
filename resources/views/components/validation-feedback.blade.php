<div class="fixed bottom-10 left-1/2 -translate-x-1/2 text-sm animate-pulse w-full px-2">
<!-- He who is contented is rich. - Laozi -->
    @if (session()->has('success_') && session('success_')!=="")
    <div id="alert-success" class="font-semibold px-3 py-2 rounded bg-emerald-200 text-emerald-600 opacity-70 flex items-center">
        <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
        </svg>
        <div class="w-full">{{ session('success_') }}</div>
        <div>
            <button class="text-red-400 font-bold" onclick="$('#alert-success').hide(300)">X</button>
        </div>
    </div>
    @endif
    @if (session()->has('warnings_') && session('warnings_')!=="")
    <div id="alert-warnings" class="font-semibold px-3 py-2 rounded bg-yellow-200 text-yellow-600 opacity-70 flex items-center">
        <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
        </svg>
        <div class="w-full">{{ session('warnings_') }}</div>
        <div>
            <button class="text-red-400 font-bold" onclick="$('#alert-warnings').hide(300)">X</button>
        </div>
    </div>
    @endif
    @if (session()->has('danger_') && session('danger_')!=="")
    <div id="alert-danger" class="font-semibold px-3 py-2 rounded bg-red-200 text-red-600 opacity-70 flex items-center">
        <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
        </svg>
        <div class="w-full">{{ session('danger_') }}</div>
        <div>
            <button class="text-red-400 font-bold" onclick="$('#alert-danger').hide(300)">X</button>
        </div>
    </div>
    @endif
    @if (session()->has('errors_') && session('errors_')!=="")
    <div id="alert-errors" class="font-semibold px-3 py-2 rounded bg-red-200 text-red-600 opacity-70 flex items-center">
        <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
        </svg>
        <div class="w-full">{{ session('errors_') }}</div>
        <div>
            <button class="text-red-400 font-bold" onclick="$('#alert-errors').hide(300)">X</button>
        </div>
    </div>
    @endif
    @if (session()->has('failed_') && session('failed_')!=="")
    <div id="alert-failed" class="font-semibold px-3 py-2 rounded bg-red-200 text-red-600 opacity-70 flex items-center">
        <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
        </svg>
        <div class="w-full">{{ session('failed_') }}</div>
        <div>
            <button class="text-red-400 font-bold" onclick="$('#alert-failed').hide(300)">X</button>
        </div>
    </div>
    @endif
</div>
