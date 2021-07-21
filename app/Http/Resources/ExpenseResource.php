<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ExpenseResource extends JsonResource
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
            'description' => $this->description,
            'value' => $this->value,
            'date' => substr($this->created_at, 6, -9),
            'time' => substr($this->created_at, 11, -3),
        ];
    }
}