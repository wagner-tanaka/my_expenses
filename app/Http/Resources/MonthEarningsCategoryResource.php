<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MonthEarningsCategoryResource extends JsonResource
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
            'monthEarnings' => MonthEarningResource::collection($this->monthEarnings()->thisMonth()->get())->response()->getData(true),
            'monthEarningsCategoryTotal' => $this->monthEarningsCategoryTotal,
            'date' => $this->created_at
        ];
    }
}
