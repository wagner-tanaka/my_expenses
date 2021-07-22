<?php
namespace App\Actions\MonthExpense;

// use App\Actions\Executable;

use App\Actions\Executable;
use App\Http\Resources\MonthExpenseResource;
use App\Models\MonthExpense;

class GetMonthExpensesAction implements Executable
{
    public function handle()
    {
        $monthExpenses = MonthExpense::all();

        return MonthExpenseResource::collection($monthExpenses)->response()->getData(true);
    }
}
