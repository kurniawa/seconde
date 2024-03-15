<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ItemPhoto;
use App\Models\Menu;
use App\Models\PeminatItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    public function create() {
        $data = [
            'menus' => Menu::get(),
            'route_now' => 'home',
            'profile_menus' => Menu::get_profile_menus(Auth::user()),
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
        $request->validate([
            'nama' => 'required',
            'harga' => 'nullable|numeric'
        ]);

        if ($post['harga'] === null) {
            $post['harga'] = "0";
        }

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
                    sleep(1);
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
        // dd($item->user->id);
        $related_user = null;

        if (Auth::user()) {
            if (Auth::user()->id == $item->user->id) {
                $related_user = Auth::user();
            }
        }

        $peminat_items = PeminatItem::where('item_id', $item->id)->orderBy('created_at')->get();

        $data = [
            'menus' => Menu::get(),
            'route_now' => 'home',
            'profile_menus' => Menu::get_profile_menus(Auth::user()),
            'parent_route' => 'home',
            'spk_menus' => Menu::get_spk_menus(),
            'item' => $item,
            'item_photos' => $item_photos,
            'related_user' => $related_user,
            'peminat_items' => $peminat_items,
        ];
        // dd($data);
        return view('items.show', $data);
    }

    function mau(Item $item, Request $request) {
        $post = $request->post();
        // dump($post);
        // dd($item);
        $user_id = null;
        $nama = "";

        if (isset($post['nama'])) {
            $nama = $post['nama'];
        }

        if (Auth::user()) {
            $user_id = Auth::user()->id;
            $nama = Auth::user()->username;
        } else {
            $request->validate([
                'nama' => 'required'
            ]);
        }

        $success_ = "";

        $peminat_item_exist = null;
        if ($user_id !== null) {
            $peminat_item_exist = PeminatItem::where('item_id', $item->id)->where('user_id', $user_id)->first();
        } else {
            $peminat_item_exist = PeminatItem::where('item_id', $item->id)->where('nama', $nama)->first();
        }

        // $peminat_item_exist = PeminatItem::where('item_id', $item->id)->where(function($query) use ($user_id,$nama){
        //     $query->where('user_id', '<=', $user_id);
        //     $query->orWhere('nama', '>=', $nama);
        // })->first();

        if ($peminat_item_exist !== null) {
            $request->validate(['error' => 'required'],['error.required' => '-Nama peminat sudah terdaftar-']);
        }

        PeminatItem::create([
            'user_id' => $user_id,
            'nama' => $nama,
            'item_id' => $item->id,
        ]);
        $success_ .= "-Peminat baru ditambahkan-";

        $feedback = [
            "success_" => $success_
        ];

        return back()->with($feedback);
    }

    function hapus_peminat(Item $item, PeminatItem $peminat_item, Request $request) {
        $post = $request->post();
        // dump($post);
        // dump($item);
        // dd($peminat_item);
        if (isset($post['user_id'])) {
            if (Auth::user()) {
                if (Auth::user()->id != $post['user_id']) {
                    $request->validate(['error' => 'required'], ['error.required' => '-User terdaftar hanya dapat dihapus oleh user terkait-']);
                }
            } else {
                $request->validate(['error' => 'required'], ['error.required' => '-User yang terdaftar hanya dapat dihapus oleh user tersebut-']);
            }
        }

        $peminat_item->delete();
        $warnings_ = "-$peminat_item->nama dihapus dari daftar peminat-";

        $feedback = [
            "warnings_" => $warnings_,
        ];

        return back()->with($feedback);
    }

    function delete_photo(Item $item, ItemPhoto $item_photo) {
        // dump(Storage::exists($item_photo->photo_path));
        // dd($item_photo);
        $warnings_ = "";
        if (Storage::exists($item_photo->photo_path)) {
            Storage::delete($item_photo->photo_path);
        }
        $warnings_ .= "-File storage dihapus-";

        $item_photo->delete();
        $warnings_ .= "-ItemPhoto dihapus-";

        $feedback = [
            "warnings_" => $warnings_,
        ];

        return back()->with($feedback);
    }

    function add_photo(Item $item, Request $request) {
        $post = $request->post();
        $photo = $request->file('photo');
        // dump($post);
        // dump($photo);
        // dd($item);

        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'photo_index' => 'required|numeric'
        ]);

        $success_ = "";

        $file_name = time() . "." . $photo->extension();
        $photo->storeAs('item_photos/', $file_name);
        $item_photo = ItemPhoto::create([
            "item_id" => $item->id,
            "photo_path" => "item_photos/$file_name",
            "photo_index" => $post['photo_index'],
        ]);

        $success_ .= "-ItemPhoto $item_photo->photo_path created-";

        $feedback = [
            "success_" => $success_
        ];

        return back()->with($feedback);

    }

    function edit(Item $item, Request $request) {
        // dd($item);

        $item_photos = collect();

        for ($i=0 ; $i < 5 ; $i++) {
            $item_photo = ItemPhoto::where('item_id', $item->id)->where('photo_index', $i)->first();

            $item_photos->push($item_photo);
        }
        // dd($item->user->id);
        $related_user = null;

        if (Auth::user()) {
            if (Auth::user()->id == $item->user->id) {
                $related_user = Auth::user();
            } else {
                $request->validate(['error' => 'required'], ['error.required' => '-You are not related user-']);
            }
        }

        $peminat_items = PeminatItem::where('item_id', $item->id)->get();
        // dd($peminat_items);

        $data = [
            'menus' => Menu::get(),
            'route_now' => 'home',
            'profile_menus' => Menu::get_profile_menus(Auth::user()),
            'parent_route' => 'home',
            'spk_menus' => Menu::get_spk_menus(),
            'item' => $item,
            'item_photos' => $item_photos,
            'related_user' => $related_user,
            'peminat_items' => $peminat_items,
        ];

        // dd($data);
        return view('items.edit', $data);
    }

    function update(Item $item, Request $request) {
        $post = $request->post();
        // dump($post);
        // dd($item);

        $request->validate([
            'harga' => 'nullable|numeric',
        ]);

        $success_ = "";

        $harga = $post['harga'];
        if ($post['harga'] === null) {
            $harga = 0;
        }

        $hide = 0;
        if (isset($post['hide'])) {
            if ($post['hide'] === 'yes') {
                $hide = 1;
            }
        }

        $sold = 0;
        $buyer_id = null;
        $buyer = null;
        $status = 'ready';

        if (isset($post['sold'])) {
            if ($post['sold'] === 'yes') {
                if ($post['peminat_item_id']) {
                    $peminat_item = PeminatItem::find($post['peminat_item_id'])->first();
                    if ($peminat_item) {
                        $buyer_id = $peminat_item->id;
                        $buyer = $peminat_item->nama;
                    }
                } elseif ($post['peminat_item_nama']) {
                    $buyer = $post['peminat_item_nama'];
                } else {
                    $request->validate(['error' => 'required'], ['error.required' => '-Sold di set, namun peminat tidak dipilih atau ditulis-']);
                }
                $sold = 1;
                $status = 'sold';
            }
        }

        $item->update([
            "nama" => $post['nama'],
            "deskripsi" => $post['deskripsi'],
            "harga" => (string)$harga,
            "status" => $status,
            "buyer" => $buyer,
            "buyer_id" => $buyer_id,
            "keterangan" => $post['keterangan'],
            "sold" => (string)$sold,
            "hide" => (string)$hide,
        ]);
        $success_ .= "-Item diupdate-";

        $feedback = [
            "success_" => $success_
        ];

        return back()->with($feedback);
    }
}
