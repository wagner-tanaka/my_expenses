<?php

namespace App\Actions\Category;

use App\Actions\Executable;
use App\Http\Resources\CategoryResource;
use App\Models\Category;

class GetCategoriesAction implements Executable
{
    public function handle()
    {
        $categories = $this->getCategories();

        if ($categories->isEmpty()) {
            Category::generateExpensesForThisCategory();
            $categories = $this->getCategories();
        }

        return CategoryResource::collection($categories)->response()->getData(true);
    }

    private function getCategories()
    {
        return Category::with('expenses')->
                         whereHas('expenses', function ($query) {$query->
                            whereYear('created_at', now()->format('Y'))->
                            whereMonth('created_at', now()->format('m'));})->
                         orWhere(function ($query) {$query->
                            whereYear('created_at', now()->format('Y'))->
                            whereMonth('created_at', now()->format('m'));})->
                         get();
    }
}
