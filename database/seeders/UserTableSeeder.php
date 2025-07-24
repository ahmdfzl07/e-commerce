<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Fadli Aji',
            'email' => 'admin@admin.com',
            'role' => 'admin',
            'password' => bcrypt('admin123')
        ]);
    }
}
