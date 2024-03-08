<?php

namespace App\Http\Controllers;

use App\Models\Item;
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
        $file = $request->file('photos');
        // dump($post);
        // dd($file);
        $request->validate([
            'nama' => 'required',
            'harga' => 'required|numeric'
        ]);

        $user = Auth::user();
        if (!$user) {
            dd("User is not logged in!");
        }

        $item_new = Item::create([
            "user_id" => $user->id,
            "nama" => $post['nama'],
            "deskripsi" => $post['deskripsi'],
            "harga" => $post['harga'],
            "status" => "ready",
            "keterangan" => $post['keterangan'],
            "sold" => false,
            "hide" => false,
        ]);

        if ($file) {
            if (count($file) !== 0) {

            }
        }
    }
}
