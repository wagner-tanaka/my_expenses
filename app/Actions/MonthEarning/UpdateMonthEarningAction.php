<?php

namespace App\Actions\MonthEarning;

use App\Actions\Executable;
use App\Models\MonthEarning;
use Throwable;

class UpdateMonthEarningAction implements Executable
{
    protected $monthEarning;
    protected $data;

    /**
     * @param MonthEarning $project
     * @param array $data
     */
    public function __construct(MonthEarning $monthEarning, array $data)
    {
        $this->data = $data;
        $this->monthEarning = $monthEarning;
    }

    /**
     * @return Project
     * @throws Throwable
     */
    public function handle(): MonthEarning
    {
        \DB::transaction(function () {
            $this->monthEarning->update($this->data);
        });

        return $this->monthEarning;
    }
}
