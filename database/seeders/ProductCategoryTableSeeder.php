<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productCategories = [
            [
                'product_id' => 1,
                'name' => 'Minuman'
            ],
            [
                'product_id' => 2,
                'name' => 'Minuman'
            ],
            [
                'product_id' => 3,
                'name' => 'Makanan'
            ],
        ];

        ProductCategory::insert($productCategories);
    }
}
