<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Seller;
use App\Models\kurir;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name_tmu'=>'admin',
            'phone_tmu'=>'001',
            'password'=>'123',
            'role'=>'admin'
        ]);
    }
}
