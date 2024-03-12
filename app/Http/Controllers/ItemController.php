<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ItemPhoto;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    public function create() {
        $data = [
            'menus' => Menu::get(),
            'route_now' => 'home',
            'profile_menus' => Menu::get_profile_menus(),
            'parent_route' => 'home',
            'spk_menus' => Menu::get_spk_menus(),
        ];
        return view('items.create', $data);
    }

    function store(Request $request) {
        $post = $request->post();
        $photos = $request->file('photos');
        // dump($post);
        // dd($photos);

        if ($post['harga'] === null) {
            $post['harga'] = "0";
        }

        $request->validate([
            'nama' => 'required',
            'harga' => 'numeric'
        ]);

        $harga = ((int)$post['harga'] * 100);
        $user = Auth::user();
        if (!$user) {
            dd("User is not logged in!");
        }

        $success_ = "";

        $item_new = Item::create([
            "user_id" => $user->id,
            "nama" => $post['nama'],
            "deskripsi" => $post['deskripsi'],
            "harga" => (string)$harga,
            "keterangan" => $post['keterangan'],
        ]);
        $success_ .= "-New item created-";

        if ($photos) {
            if (count($photos) !== 0) {
                $request->validate([
                    'photos.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
                ]);
                foreach ($photos as $key => $photo) {
                    $file_name = time() . "." . $photo->extension();
                    $photo->storeAs('item_photos/', $file_name);
                    $item_photo = ItemPhoto::create([
                        "item_id" => $item_new->id,
                        "photo_path" => "item_photos/$file_name",
                        "photo_index" => (string)$key,
                    ]);
                    $success_ .= "-ItemPhoto $item_photo->photo_path created-";
                }
            }
        }

        $feedback = [
            "success_" => $success_
        ];

        return redirect()->route('home')->with($feedback);

    }

    function show(Item $item) {
        // dd($item);
        $item_photos = ItemPhoto::where('item_id', $item->id)->orderBy('photo_index')->get();

        $data = [
            'menus' => Menu::get(),
            'route_now' => 'home',
            'profile_menus' => Menu::get_profile_menus(),
            'parent_route' => 'home',
            'spk_menus' => Menu::get_spk_menus(),
            'item' => $item,
            'item_photos' => $item_photos,
        ];
        // dd($data);
        return view('items.show', $data);
    }
}
