<?php

namespace Database\Seeders;

use App\Models\Expense;
use Illuminate\Database\Seeder;

class ExpenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('expenses')->truncate();
        Expense::create([
            'name' => 'Mercado',
            'category_id' => 1,
            'description' => '',
            'value' => 2000,
            'user_id' => 1
        ]);
        Expense::create([
            'name' => 'Farmacia',
            'category_id' => 1,
            'description' => '',
            'value' => 3000,
            'user_id' => 1

        ]);
        Expense::create([
            'name' => 'Outros',
            'category_id' => 1,
            'description' => 'Outra conta',
            'value' => 3000,
            'user_id' => 1

        ]);
    }
}
