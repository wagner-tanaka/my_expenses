<?php

namespace App\Actions\MonthExpensesCategory;

use App\Actions\Executable;
use App\Models\MonthExpensesCategory;
use Throwable;

class DeleteMonthExpensesCategoryAction implements Executable
{
    private $monthExpensesCategory;

    /**
     * @param MonthExpensesCategory $monthExpensesCategory
     */
    public function __construct(MonthExpensesCategory $monthExpensesCategory)
    {
        $this->monthExpensesCategory = $monthExpensesCategory;
    }

    /**
     * @return bool
     * @throws Throwable
     */
    public function handle(): bool
    {
        \DB::transaction(function () {
            $this->monthExpensesCategory->delete();
        });

        return true;
    }
}
