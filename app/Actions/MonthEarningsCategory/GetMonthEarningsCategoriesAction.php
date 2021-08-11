<?php

namespace App\Actions\MonthEarningsCategory;

use App\Actions\Executable;
use App\Http\Resources\MonthEarningsCategoryResource;
use App\Models\MonthEarningsCategory;

class GetMonthEarningsCategoriesAction implements Executable
{
    public function handle()
    {
        $monthEarningsCategories = $this->getMonthEarningsCategories();

        if ($monthEarningsCategories->isEmpty()) {
            MonthEarningsCategory::generateMonthEarningsForThisCategory();
            $monthEarningsCategories = $this->getMonthEarningsCategories();
        }

        return MonthEarningsCategoryResource::collection($monthEarningsCategories)->response()->getData(true);
    }

    private function getMonthEarningsCategories()
    {
        return MonthEarningsCategory::with('monthEarnings')->
        whereHas('monthEarnings', function ($query) {
            $query->
            whereYear('created_at', now()->format('Y'))->
            whereMonth('created_at', now()->format('m'));
        })->
        orWhere(function ($query) {
            $query->
            whereYear('created_at', now()->format('Y'))->
            whereMonth('created_at', now()->format('m'));
        })->
        get();
    }
}
