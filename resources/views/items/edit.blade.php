@extends('layouts.main')
@section('content')
<main class="p-2">
    <x-errors-any></x-errors-any>
    <x-validation-feedback></x-validation-feedback>
    <div>
        @for ($i = 0; $i < 5; $i++)
        @if ($item_photos[$i])
        <div class="flex gap-2">
            <div class="w-28 max-h-28 mb-2">
                <img src="{{ asset("storage/" . $item_photos[$i]->photo_path) }}" alt="item_photo" class="w-full">
            </div>
            <form action="{{ route('items.delete_photo', [$item->id, $item_photos[$i]->id]) }}" method="POST" onsubmit="return confirm('Anda yakin ingin hapus photo_item ini?')" class="flex items-center">
                @csrf
                <button type="submit" class="bg-pink-300 text-pink-500 rounded p-1">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                    </svg>
                </button>
            </form>
        </div>
        @else
        <form method="POST" action="{{ route('items.add_photo', $item->id) }}" class="mb-1" enctype="multipart/form-data">
            @csrf
            <label for="input-photo-{{ $i }}" class="inline-block">
                <div class="text-white bg-sky-300 rounded p-1">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-20 h-20">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0ZM18.75 10.5h.008v.008h-.008V10.5Z" />
                    </svg>
                </div>
            </label>
            <input id="input-photo-{{ $i }}" type="file" name="photo" onchange="previewImage(this.files[0], 'div-preview-photo-{{ $i }}', 'preview-photo-{{ $i }}')" class="hidden">
            <input type="hidden" name="photo_index" value="{{ $i }}">
            <div id="div-preview-photo-{{ $i }}" class="hidden">
                <div class="flex justify-end">
                    <button type="button" class="text-red-400" onclick="removeImage('input-photo-{{ $i }}', 'div-preview-photo-{{ $i }}', 'preview-photo-{{ $i }}')">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-7 h-7">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <img id="preview-photo-{{ $i }}"></img>
                <div class="flex justify-center mt-1">
                    <button type="submit" class="bg-emerald-300 text-emerald-500 font-bold rounded px-3 py-1 text-sm">Tambah</button>
                </div>
            </div>
        </form>
        @endif
        @endfor
        <form id="form-edit-item" action="{{ route('items.update', $item->id) }}" method="POST">
            @csrf
            <div class="">
                <label for="nama" class="block text-sm font-medium leading-6 text-gray-900">Nama/Judul</label>
                <div class="mt-2">
                    <input type="text" name="nama" id="nama" autocomplete="given-name" class="block w-full rounded-md border-0 p-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" value="{{ $item->nama }}">
                </div>
            </div>
            <div class="mt-2">
                <label for="deskripsi" class="block text-sm font-medium leading-6 text-gray-900">Deskripsi</label>
                <div class="mt-2">
                    <textarea id="deskripsi" name="deskripsi" rows="3" class="block w-full rounded-md border-0 p-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" value="{{ $item->deskripsi }}"></textarea>
                </div>
            </div>
            <div class="mt-2 grid grid-cols-1">
                <div class="col-span-3">
                    <label for="harga" class="block text-sm font-medium leading-6 text-gray-900">Harga</label>
                    <div class="mt-2">
                        <input type="text" name="harga-formatted" id="harga-formatted" autocomplete="given-name" onchange="formatNumber(this, 'harga')" class="block w-full rounded-md border-0 p-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" value="{{ number_format((int)$item->harga / 100, 0,',','.') }}">
                        <input type="hidden" name="harga" id="harga" value="{{ $item->harga / 100 }}">
                    </div>
                </div>
            </div>
            <div class="mt-2">
                <label for="harga" class="block text-sm font-medium leading-6 text-gray-900">Keterangan (opt.)</label>
                <div class="mt-2">
                    <input type="text" name="keterangan" id="keterangan" class="block w-full rounded-md border-0 p-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" value="{{ $item->keterangan }}">
                </div>
            </div>
            <div class="mt-3 flex justify-center text-xs">
                <button type="submit" class="rounded px-3 py-2 font-semibold bg-emerald-400 border-2 border-emerald-500 text-white hover:bg-emerald-600 active:bg-emerald-700 focus:ring focus:ring-emerald-300" type="submit">Konfirmasi edit</button>
            </div>
        </form>
    </div>
</main>

<script>
    // const input_image_element_test = document.getElementById('input-photo-0');
    // console.log(input_image_element_test.value)
    function previewImage(image_file, div_preview_photo, preview_photo) {
        if (image_file) {
            // console.log(image_file)
            document.getElementById(preview_photo).src = URL.createObjectURL(image_file);
            $(`#${div_preview_photo}`).show();
        }
    }

    function removeImage(input_image, div_preview_photo, preview_photo) {
        document.getElementById(preview_photo).src = "";
        $(`#${div_preview_photo}`).hide(300);
        const input_image_element = document.getElementById(input_image);
        // console.log(input_image_element);
        // console.log(input_image_element.value);
        input_image_element.value = null;
        // console.log(input_image_element.value);
    }
</script>
@endsection

