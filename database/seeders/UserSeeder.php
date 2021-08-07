<?php

namespace Database\Seeders;

use App\Models\User;
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
        User::create([
            'nim' => '1000000000',
            'email' => 'admin@admin.com',
            'status' => 1,
            'role' => 1,
            'password' => Hash::make('admin')
        ]);
    }
}
