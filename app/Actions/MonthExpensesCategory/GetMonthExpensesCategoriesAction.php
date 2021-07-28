<?php

namespace App\Actions\MonthExpensesCategory;

use App\Actions\Executable;
use App\Http\Resources\MonthExpenseResource;
use App\Models\MonthExpensesCategory;

class GetMonthExpensesCategoriesAction implements Executable
{
    public function handle()
    {
        $monthExpensesCategories = $this->getMonthExpensesCategories();

        if ($monthExpensesCategories->isEmpty()) {
            MonthExpensesCategory::generateMonthExpensesForThisCategory();
            $monthExpensesCategories = $this->getMonthExpensesCategories();
        }

        return MonthExpenseResource::collection($monthExpensesCategories)->response()->getData(true);
    }

    private function getMonthExpensesCategories()
    {
        return MonthExpensesCategory::with('monthExpenses')->
        whereHas('monthExpenses', function ($query) {$query->
        whereYear('created_at', now()->format('Y'))->
        whereMonth('created_at', now()->format('m'));})->
        orWhere(function ($query) {$query->
        whereYear('created_at', now()->format('Y'))->
        whereMonth('created_at', now()->format('m'));})->
        get();
    }
}
