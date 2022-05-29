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
                'name' => 'Teh Gelas',
                'slug' => Str::slug('Teh Gelas'),
                'image' => 'teh-gelas.jpg',
                'price' => 1000,
                'stock' => 99,
                'category_id' => 1,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time()),
            ],
            [
                'name' => 'Mizone Leci',
                'slug' => Str::slug('Mizone Leci'),
                'image' => 'mizone-leci.jpg',
                'price' => 6000,
                'stock' =>50,
                'category_id' => 2,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time()),
            ],
            [
                'name' => 'Lux',
                'slug' => Str::slug('Lux'),
                'image' => 'Lux.jpg',
                'price' => 5000,
                'stock' => 80,
                'category_id' => 3,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time()),
            ],
        ];

        Product::insert($products);
    }
}