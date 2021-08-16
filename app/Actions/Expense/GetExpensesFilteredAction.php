<?php

namespace App\Actions\Expense;


use App\Actions\Executable;
use App\Http\Resources\ExpenseResource;
use App\Models\Expense;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class GetExpensesFilteredAction implements Executable
{
    public function handle()
    {

        $expenses = QueryBuilder::for(Expense::class)
            ->allowedFilters([
                AllowedFilter::scope('for_date'),
            ])->groupBy('category_id')->get();

        return ExpenseResource::collection($expenses)->response()->getData(true);

    }
}
