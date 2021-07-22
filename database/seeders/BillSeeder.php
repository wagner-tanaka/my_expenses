<?php

namespace Database\Seeders;

use App\Models\Bill;
use Illuminate\Database\Seeder;

class BillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Bill::create([
            'name' => 'Aluguel',
            'value' => 56000
        ]);
        Bill::create([
            'name' => 'Escola',
            'value' => 7500
        ]);
        Bill::create([
            'name' => 'Luz',
            'value' => 10000
        ]);
    }
}
