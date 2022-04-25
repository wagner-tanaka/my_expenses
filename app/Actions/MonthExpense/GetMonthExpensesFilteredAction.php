<?php
namespace App\Actions\MonthExpense;

// use App\Actions\Executable;

use App\Actions\Executable;
use App\Http\Resources\MonthExpenseResource;
use App\Models\MonthExpense;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class GetMonthExpensesFilteredAction implements Executable
{
    public function handle()
    {

        // dd(MonthExpense::all());
        $monthExpenses = QueryBuilder::for(MonthExpense::class)
            ->allowedFilters([
                AllowedFilter::scope('for_date'),
            ])->get();


        return MonthExpenseResource::collection($monthExpenses)->response()->getData(true);

    }
}
