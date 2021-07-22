<?php

namespace Database\Seeders;

use App\Models\MonthExpense;
use Illuminate\Database\Seeder;

class MonthExpenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MonthExpense::create([
            'name' => 'Aluguel',
            'value' => 56000
        ]);
        MonthExpense::create([
            'name' => 'Escola',
            'value' => 7500
        ]);
        MonthExpense::create([
            'name' => 'Luz',
            'value' => 10000
        ]);
    }
}
