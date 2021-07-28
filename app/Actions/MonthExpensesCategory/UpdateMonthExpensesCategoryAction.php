<?php

namespace App\Actions\MonthExpensesCategory;

use App\Actions\Executable;
use App\Models\MonthExpensesCategory;
use Throwable;

class UpdateMonthExpensesCategoryAction implements Executable
{
    protected $monthExpensesCategory;
    protected $data;

    /**
     * @param MonthExpensesCategory $monthExpensesCategory
     * @param array $data
     */
    public function __construct(MonthExpensesCategory $monthExpensesCategory, array $data)
    {
        $this->data = $data;
        $this->monthExpensesCategory = $monthExpensesCategory;
    }

    /**
     * @return MonthExpensesCategory
     * @throws Throwable
     */
    public function handle(): MonthExpensesCategory
    {
        \DB::transaction(function () {
            $this->monthExpensesCategory->update($this->data);
        });

        return $this->monthExpensesCategory;
    }
}
