<?php 

namespace App\Actions\MonthExpense;

use App\Actions\Executable;
use App\Models\MonthExpense;
use Throwable;

class CreateMonthExpenseAction implements Executable
{
    protected $monthExpense;
    protected $data;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
            $this->data = $data;
    }

     /**
     * @return MonthExpense
     * @throws Throwable
     */
    public function handle(): MonthExpense
    {
        \DB::transaction(function () {
            $this->monthExpense = MonthExpense::create($this->data);
        });
        return $this->monthExpense;
    }
}