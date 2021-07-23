<?php

namespace App\Actions\MonthEarning;

use App\Actions\Executable;
use App\Models\MonthEarning;
use Throwable;

class DeleteMonthEarningAction implements Executable
{
    private $monthEarning;

    /**
     * @param MonthEarning $category
     */
    public function __construct(MonthEarning $monthEarning)
    {
        $this->monthEarning = $monthEarning;
    }

    /**
     * @return bool
     * @throws Throwable
     */
    public function handle(): bool
    {
        
        \DB::transaction(function () {
            $this->monthEarning->delete();
        });

        return true;
    }
}
