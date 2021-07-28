<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MonthExpensesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'name' => $this->name,
            'id' => $this->id,
            'monthExpenses' => ExpenseResource::collection($this->monthExpenses()->thisMonth()->get())->response()->getData(true),
            'totalMonthExpensesCategory' => $this->monthExpensesTotal,
            'date' => $this->created_at
        ];
    }
}
