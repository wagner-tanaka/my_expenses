<?php
namespace App\Actions\MonthEarning;

// use App\Actions\Executable;

use App\Actions\Executable;
use App\Http\Resources\MonthEarningResource;
use App\Models\MonthEarning;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class GetMonthEarningsFilteredAction implements Executable
{
    public function handle()
    {

        $monthEarnings = QueryBuilder::for(MonthEarning::class)
            ->allowedFilters([
                AllowedFilter::scope('for_date'),
            ])->get();

        return MonthEarningResource::collection($monthEarnings)->response()->getData(true);

    }
}

