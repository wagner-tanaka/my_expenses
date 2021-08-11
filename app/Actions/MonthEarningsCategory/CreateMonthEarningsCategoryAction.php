<?php
namespace App\Actions\MonthEarningsCategory;


use App\Actions\Executable;
use App\Models\MonthEarningsCategory;
use Throwable;

class CreateMonthEarningsCategoryAction implements Executable
{
    protected $monthEarningsCategory;
    protected $data;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @return MonthEarningsCategory
     * @throws Throwable
     */
    public function handle(): MonthEarningsCategory
    {
        \DB::transaction(function () {
            $this->monthEarningsCategory = auth()->user()->monthEarningsCategories()->create($this->data);
        });

        return $this->monthEarningsCategory;
    }
}
