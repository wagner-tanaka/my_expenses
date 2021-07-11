<?php
namespace App\Actions\Category;

// use App\Actions\Executable;

use App\Actions\Executable;
use App\Http\Resources\CategoryResource;
use App\Models\Category;

class GetCategoriesAction implements Executable
{
    public function handle()
    {
        $categories = Category::all();

        return CategoryResource::collection($categories)->response()->getData(true);
    }
}
