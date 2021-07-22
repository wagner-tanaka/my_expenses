<?php

namespace App\Actions\MonthExpense;

use App\Actions\Executable;
use App\Models\MonthExpense;
use Throwable;

class UpdateMonthExpenseAction implements Executable
{
    protected $monthExpense;
    protected $data;

    /**
     * @param MonthExpense $project
     * @param array $data
     */
    public function __construct(MonthExpense $monthExpense, array $data)
    {
        $this->data = $data;
        $this->monthExpense = $monthExpense;
    }

    /**
     * @return Project
     * @throws Throwable
     */
    public function handle(): MonthExpense
    {
        \DB::transaction(function () {
            $this->monthExpense->update($this->data);
        });

        return $this->monthExpense;
    }
}
