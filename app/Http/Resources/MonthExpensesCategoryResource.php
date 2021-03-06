<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MonthExpensesCategoryResource extends JsonResource
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
            'monthExpenses' => MonthExpenseResource::collection($this->monthExpenses()->thisMonth()->isFixed()->get())->response()->getData(true),
            'monthExpensesCategoryTotal' => $this->monthExpensesCategoryTotal,
            'date' => $this->created_at
        ];
    }
}
