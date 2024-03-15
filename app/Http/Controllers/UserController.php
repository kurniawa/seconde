<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ItemPhoto;
use App\Models\Menu;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    function list_of_items(User $user) {
        // dd($user);

        $items = Item::where('user_id', $user->id)->latest()->limit(500)->get();

        $item_photos = collect();
        foreach ($items as $item) {
            $item_photo = ItemPhoto::where('item_id', $item->id)->orderBy('photo_index')->first();

            $item_photos->push($item_photo);
        }

        $data = [
            'menus' => Menu::get(),
            'route_now' => 'home',
            'profile_menus' => Menu::get_profile_menus($user),
            'parent_route' => 'home',
            'spk_menus' => Menu::get_spk_menus(),
            'items' => $items,
            'item_photos' => $item_photos,
        ];

        return view('users.list_of_items', $data);
    }
}
