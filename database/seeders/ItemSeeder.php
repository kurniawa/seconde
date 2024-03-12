<?php

namespace Database\Seeders;

use App\Models\Item;
use App\Models\ItemPhoto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            ['user_id' => 2, 'nama' => 'Test Produk', 'harga' => '0'],
            ['user_id' => 2, 'nama' => 'Test Produk 2', 'harga' => '0'],
        ];
        $item_photos = [
            [["item_id" => 1, "photo_path" => "item_photos/1710221416.jpg"],["item_id" => 1, "photo_path" => "item_photos/1710221417.jpg"]],
        ];

        for ($i = 0; $i < count($items); $i++) {
            $item_new = Item::create([
                'user_id' => $items[$i]['user_id'],
                'nama' => $items[$i]['nama'],
                'harga' => $items[$i]['harga'],
            ]);
            // DB::table('items')->insert([
            // ]);
            if (isset($item_photos[$i])) {
                if (count($item_photos[$i]) !== 0) {
                    foreach ($item_photos[$i] as $key => $item_photo) {
                        ItemPhoto::create([
                            "item_id" => $item_photo['item_id'],
                            "photo_path" => $item_photo['photo_path'],
                            "photo_index" => (string)$key,
                        ]);
                    }
                }
            }
        }
    }
}
