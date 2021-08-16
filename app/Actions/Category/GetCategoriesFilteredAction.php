<?php

namespace App\Actions\Category;

use App\Actions\Executable;
use App\Http\Resources\CategoryResource;
use App\Models\Category;

class GetCategoriesFilteredAction implements Executable
{
    public function handle()
    {
        $date = request()->filter['for_date'];
        $categories = $this->getCategories($date);

        return CategoryResource::collection($categories)->response()->getData(true);
    }

    private function getCategories($date)
    {
        $year = explode('-', $date)[0];
        $month = explode('-', $date)[1];

        return Category::with('expenses')->
        whereHas('expenses', function ($query) use ($month, $year) {
            $query->
            whereYear('created_at', $year)->
            whereMonth('created_at', $month);
        })->get();
    }
}
