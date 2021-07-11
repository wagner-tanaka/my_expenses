<?php

namespace App\Actions\Category;

use App\Actions\Executable;
use App\Models\Category;

class GetCategoriesForSelectAction implements Executable
{
    public function handle()
    {
        return  Category::orderBy('name')->get()->map(function ($project) {
            return [
                'value' => $project->id,
                'text' => $project->name
            ];
        });
    }
}
