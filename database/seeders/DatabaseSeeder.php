<?php

namespace Database\Seeders;

use App\Models\MonthEarning;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            ExpenseSeeder::class,
            MonthExpenseSeeder::class,
            MonthEarningSeeder::class,
        ]);
        // \App\Models\User::factory(10)->create();
        // $this->call(UserSeeder::class);
        // $this->call(CategorySeeder::class);
    }
}
