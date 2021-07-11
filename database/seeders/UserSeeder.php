<?php

namespace Database\Seeders;

use App\Models\User;
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
        // User::factory()->count(50)->create();
        User::create([
            'name' => 'Wagner',
            'email' => 'wagner@gmail.com',
            'password' => bcrypt('11111111')
        ]);
    }
}
