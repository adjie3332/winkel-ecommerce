<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Menjalankan proses seeding database.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                'id' => 1,
                'category_id' => 1,
                'name' => 'Baju Koko',
                'description' => 'Baju koko untuk pria dewasa',
                'price' => 150000,
                'stock' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'category_id' => 2,
                'name' => 'Gaun',
                'description' => 'Gaun untuk wanita dewasa',
                'price' => 50000,
                'stock' => 50,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 1,
                'name' => 'Celana Panjang',
                'description' => 'Celana panjang untuk pria dewasa',
                'price' => 100000,
                'stock' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 2,
                'name' => 'Rok',
                'description' => 'Rok untuk wanita dewasa',
                'price' => 75000,
                'stock' => 30,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 1,
                'name' => 'Kemeja',
                'description' => 'Kemeja untuk pria dewasa',
                'price' => 125000,
                'stock' => 15,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 2,
                'name' => 'Blouse',
                'description' => 'Blouse untuk wanita dewasa',
                'price' => 100000,
                'stock' => 25,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('products')->insert($products);
    }
}
