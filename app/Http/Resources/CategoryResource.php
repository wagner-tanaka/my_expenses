<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'groupedExpenses' => $this->groupedExpenses(),
            'expenses' => ExpenseResource::collection($this->expenses()->thisMonth()->get())->response()->getData(true),
            'totalCategoryExpenses' => $this->totalCategoryExpenses,
            'date' => $this->created_at
        ];
    }
}
