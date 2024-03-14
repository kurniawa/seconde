@extends('layouts.main')
@section('content')
<main class="p-2">
    <x-errors-any></x-errors-any>
    <x-validation-feedback></x-validation-feedback>
    <div>
        <form action="{{ route('login') }}" method="POST" onsubmit="showLoadingSpinner()">
            @csrf
            <div class="">
                <label for="username" class="block text-sm font-medium leading-6 text-gray-900">Username</label>
                <div class="mt-2">
                    <input type="text" name="username" id="username" autocomplete="given-name" class="block w-full rounded-md border-0 p-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>
            <div class="">
                <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
                <div class="mt-2">
                    <input type="password" name="password" id="password" autocomplete="given-name" class="block w-full rounded-md border-0 p-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>
            <div class="mt-3 flex justify-center">
                <button type="submit" class="rounded px-3 py-2 font-semibold bg-indigo-400 border-2 border-indigo-500 text-white hover:bg-indigo-600 active:bg-indigo-700 focus:ring focus:ring-indigo-300" type="submit">Log in</button>
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

