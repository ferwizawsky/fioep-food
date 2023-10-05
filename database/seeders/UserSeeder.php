<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->detaildata() as $item) {
            $user = User::create([
                'username' => $item['username'],
                'password' => Hash::make($item['password']),
            ]);
        }
    }


    public function detaildata()
    {
        return [
            [
                'username' => 'tester',
                'password' => 'testerea',
            ],
            [
                'username' => 'admoon',
                'password' => 'admooner',
            ],
        ];
    }
}
