<?php 

namespace App\Actions\MonthEarning;

use App\Actions\Executable;
use App\Models\MonthEarning;
use Throwable;

class CreateMonthEarningAction implements Executable
{
    protected $monthEarning;
    protected $data;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
            $this->data = $data;
    }

     /**
     * @return MonthEarning
     * @throws Throwable
     */
    public function handle(): MonthEarning
    {
        \DB::transaction(function () {
            $this->monthEarning = MonthEarning::create($this->data);
        });
        return $this->monthEarning;
    }
}