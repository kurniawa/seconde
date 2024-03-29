<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ItemPhoto;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home() {
        try {
            $items = Item::where('hide', false)->latest()->limit(100)->orderBy('sold')->get();
        } catch (\Throwable $th) {
            //throw $th;
            $items = collect();
        }
        // dd($items);
        $item_photos = collect();
        foreach ($items as $item) {
            $item_photo = ItemPhoto::where('item_id', $item->id)->orderBy('photo_index')->first();

            $item_photos->push($item_photo);
        }

        $data = [
            'menus' => Menu::get(),
            'route_now' => 'home',
            'profile_menus' => Menu::get_profile_menus(Auth::user()),
            'parent_route' => 'home',
            'spk_menus' => Menu::get_spk_menus(),
            'items' => $items,
            'item_photos' => $item_photos,
        ];
        // dd($data);
        // dump(isset($data['profile_menus'][0]['params']));
        // dump(isset($data['profile_menus'][1]['params']));
        // dd($data['profile_menus'][0]['params']);
        return view('home', $data);
    }
}
