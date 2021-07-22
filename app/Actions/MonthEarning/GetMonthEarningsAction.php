<?php
namespace App\Actions\MonthEarning;

// use App\Actions\Executable;

use App\Actions\Executable;
use App\Http\Resources\MonthEarningResource;
use App\Models\MonthEarning;

class GetMonthEarningsAction implements Executable
{
    public function handle()
    {
        $monthEarnings = MonthEarning::all();

        return MonthEarningResource::collection($monthEarnings)->response()->getData(true);
    }
}
