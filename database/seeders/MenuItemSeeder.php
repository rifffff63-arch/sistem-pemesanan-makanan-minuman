<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MenuItem;

class MenuItemSeeder extends Seeder
{
    public function run(): void
    {
        $menus = [
            [
                'name' => 'Nasi Goreng',
                'category' => 'Makanan',
                'price' => 15000,
                'preparation_time' => 10,
            ],
            [
                'name' => 'Mie Goreng',
                'category' => 'Makanan',
                'price' => 12000,
                'preparation_time' => 8,
            ],
            [
                'name' => 'Ayam Geprek',
                'category' => 'Makanan',
                'price' => 18000,
                'preparation_time' => 15,
            ],
            [
                'name' => 'Es Teh',
                'category' => 'Minuman',
                'price' => 5000,
                'preparation_time' => 2,
            ],
            [
                'name' => 'Jus Alpukat',
                'category' => 'Minuman',
                'price' => 10000,
                'preparation_time' => 5,
            ],
        ];

        foreach ($menus as $menu) {
            MenuItem::create($menu);
        }
    }
}