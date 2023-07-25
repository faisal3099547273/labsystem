<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
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
        //

        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'phone_number' => '+36521458',
            'is_admin' => 1,
            'password' => Hash::make('123456'),
            'status' => 1,
        ]);
    }
}
