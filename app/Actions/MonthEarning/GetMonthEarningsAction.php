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
//        $monthEarnings = MonthEarning::all();

        $monthEarnings = MonthEarning::where('is_fixed',1)->
                                       orWhere(function ($query){$query->
                                          whereYear('created_at', now()->format('Y'))->
                                          whereMonth('created_at', now()->format('m'));})->
                                       get();
        return MonthEarningResource::collection($monthEarnings)->response()->getData(true);
    }
}
