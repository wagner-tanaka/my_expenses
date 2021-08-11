<?php

namespace App\Actions\MonthEarningsCategory;

use App\Actions\Executable;
use App\Models\MonthEarningsCategory;
use Throwable;

class DeleteMonthEarningsCategoryAction implements Executable
{
    private $monthEarningsCategory;

    /**
     * @param MonthEarningsCategory $monthEarningsCategory
     */
    public function __construct(MonthEarningsCategory $monthEarningsCategory)
    {
        $this->monthEarningsCategory = $monthEarningsCategory;
    }

    /**
     * @return bool
     * @throws Throwable
     */
    public function handle(): bool
    {
        \DB::transaction(function () {
            $this->monthEarningsCategory->delete();
        });

        return true;
    }
}
