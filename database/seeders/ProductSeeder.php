<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->detaildata() as $item) {
            for ($x = 0; $x < 15; $x++) {
                $data = Product::create([
                    'title' => $item['title'] . $x,
                    'description' => $item['description'],
                    'price' => $item['price'],
                    'user_id' => $item['user_id'] ?? 1,
                    'photo' => 'product/example.jpeg',
                ]);
            }
        }
    }


    public function detaildata()
    {
        return [
            [
                'title' => 'Example Food',
                'description' => 'Example',
                'price' => 25000,
            ],
        ];
    }
}
