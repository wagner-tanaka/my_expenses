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
//        $monthExpenses = MonthExpense::all();

        $monthExpenses = MonthExpense::where('is_fixed',1)->
                                       orWhere(function ($query){$query->
                                          whereYear('created_at', now()->format('Y'))->
                                          whereMonth('created_at', now()->format('m'));})->
                                       get();
        return MonthExpenseResource::collection($monthExpenses)->response()->getData(true);
    }
}
