<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                'title' => 'Teh Gelas',
                'slug' => Str::slug('Teh Gelas'),
                'image' => 'teh-gelas.jpg',
                'supplier_price' => 600,
                'price' => 1000,
                'stock' => 99,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time()),
            ],
            [
                'title' => 'Mizone Leci',
                'slug' => Str::slug('Mizone Leci'),
                'image' => 'mizone-leci.jpg',
                'supplier_price' => 4000,
                'price' => 6000,
                'stock' =>50,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time()),
            ],
            [
                'title' => 'Panser',
                'slug' => Str::slug('Panser'),
                'image' => 'panser.jpg',
                'supplier_price' => 300,
                'price' => 500,
                'stock' => 80,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time()),
            ],
        ];

        Product::insert($products);
    }
}
