<?php

namespace Database\Seeders;

use App\Models\MonthExpensesCategory;
use Illuminate\Database\Seeder;

class MonthExpensesCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MonthExpensesCategory::create([
            'name' => 'Necessarios',
            'user_id' => 1
        ]);
        MonthExpensesCategory::create([
            'name' => 'Lazer',
            'user_id' => 1
        ]);
    }
}
