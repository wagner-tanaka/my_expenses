<?php

namespace Database\Seeders;

use App\Models\MonthEarning;
use Illuminate\Database\Seeder;

class MonthEarningSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MonthEarning::create([
            'name' => 'Salario Wagner',
            'value' => 300000,
            'user_id' => 1
        ]);
        MonthEarning::create([
            'name' => 'Salario Bruna',
            'value' => 100000,
            'user_id' => 1
        ]);
        MonthEarning::create([
            'name' => 'Jidou Teate',
            'value' => 40000,
            'user_id' => 1
        ]);
    }
}
