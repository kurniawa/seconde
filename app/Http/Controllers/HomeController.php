<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home() {
        $data = [
            'menus' => Menu::get(),
            'route_now' => 'home',
            'profile_menus' => Menu::get_profile_menus(),
            'parent_route' => 'home',
            'spk_menus' => Menu::get_spk_menus(),
        ];
        return view('home', $data);
    }
}
