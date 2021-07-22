<?php

namespace App\Actions\MonthExpense;

use App\Actions\Executable;
use App\Models\MonthExpense;
use Throwable;

class DeleteMonthExpenseAction implements Executable
{
    private $monthExpense;

    /**
     * @param MonthExpense $category
     */
    public function __construct(MonthExpense $monthExpense)
    {
        $this->monthExpense = $monthExpense;
    }

    /**
     * @return bool
     * @throws Throwable
     */
    public function handle(): bool
    {
        
        \DB::transaction(function () {
            $this->monthExpense->delete();
        });

        return true;
    }
}
