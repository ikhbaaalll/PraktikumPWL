<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DefaultAccount extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data =
            [
                'name' => 'Muhammad Ikhbal',
                'username' => 'ikhbal.118140123',
                'password' => bcrypt("ikhbal123")
            ];
        User::create($data);
    }
}
