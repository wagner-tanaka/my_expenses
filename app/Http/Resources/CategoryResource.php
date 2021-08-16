<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        if ($request->filter) {

            $date = $request->filter['for_date'];
            $year = explode('-', $date)[0];
            $month = explode('-', $date)[1];

            return [
                'name' => $this->name,
                'id' => $this->id,
                'groupedExpenses' => $this->groupedExpensesFiltered($year, $month),
//                'expenses' => ExpenseResource::collection($this->expenses()->previousMonth($date)->get())->response()->getData(true),
                'totalCategoryExpenses' => $this->expenses()->monthFiltered($year,$month)->sum('value'),
//                'date' => $this->created_at
            ];
        }
        return [
            'name' => $this->name,
            'id' => $this->id,
            'groupedExpenses' => $this->groupedExpenses(),
            'expenses' => ExpenseResource::collection($this->expenses()->thisMonth()->get())->response()->getData(true),
            'totalCategoryExpenses' => $this->totalCategoryExpenses,
            'date' => $this->created_at
        ];
    }
}
