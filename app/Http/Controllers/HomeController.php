<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ItemPhoto;
use App\Models\Menu;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home() {
        $items = Item::latest()->limit(100)->get();
        // dd($items);
        $item_photos = collect();
        foreach ($items as $item) {
            $item_photo = ItemPhoto::where('item_id', $item->id)->orderBy('photo_index')->first();

            $item_photos->push($item_photo);
        }
        $data = [
            'menus' => Menu::get(),
            'route_now' => 'home',
            'profile_menus' => Menu::get_profile_menus(),
            'parent_route' => 'home',
            'spk_menus' => Menu::get_spk_menus(),
            'items' => $items,
            'item_photos' => $item_photos,
        ];
        // dd($data);
        return view('home', $data);
    }
}
