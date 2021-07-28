<?php
namespace App\Actions\MonthExpensesCategory;


use App\Actions\Executable;
use App\Models\MonthExpensesCategory;
use Throwable;

class CreateMonthExpensesCategoryAction implements Executable
{
    protected $monthExpensesCategory;
    protected $data;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @return MonthExpensesCategory
     * @throws Throwable
     */
    public function handle(): MonthExpensesCategory
    {
        \DB::transaction(function () {
            $this->monthExpensesCategory = auth()->user()->monthExpensesCategories()->create($this->data);
        });

        return $this->monthExpensesCategory;
    }
}
