<?php

namespace App\Http\Resources;

use App\Models\Category;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'id' => $this->id,
            // 'expensesNames' => $this->expenses()->orderBy('name', 'asc')->groupBy('name')->pluck('name'),
            // 'groupedExpenses' => $this->expenses()->selectRaw('SUM(value) as value, name as name')->groupBy('name')->get(),
            'groupedExpenses' => $this->groupedExpenses(),
            // 'expensesNames' => [$this->expenses()->orderBy('name', 'asc')->groupBy('name')->get(),
            //                     $this->expenses],
            // 'expensesOther' => DB::table('fees')
            // ->select(DB::raw('YEAR(date) as year'), DB::raw('sum(amount) as total'))
            // ->groupBy(DB::raw('YEAR(date)') )
            // ->get(),
            'expenses' => ExpenseResource::collection($this->expenses)->response()->getData(true),
            'totalCategoryExpenses' => $this->totalCategoryExpenses

        ];
    }
}
