<?php

namespace App\Actions\MonthEarningsCategory;

use App\Actions\Executable;
use App\Models\MonthEarningsCategory;
use Throwable;

class UpdateMonthEarningsCategoryAction implements Executable
{
    protected $monthEarningsCategory;
    protected $data;

    /**
     * @param MonthEarningsCategory $monthEarningsCategory
     * @param array $data
     */
    public function __construct(MonthEarningsCategory $monthEarningsCategory, array $data)
    {
        $this->data = $data;
        $this->monthEarningsCategory = $monthEarningsCategory;
    }

    /**
     * @return MonthEarningsCategory
     * @throws Throwable
     */
    public function handle(): MonthEarningsCategory
    {
        \DB::transaction(function () {
            $this->monthEarningsCategory->update($this->data);
        });

        return $this->monthEarningsCategory;
    }
}
