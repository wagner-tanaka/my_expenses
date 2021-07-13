<?php

namespace App\Actions\Category;

use App\Actions\Executable;
use App\Models\Category;
use Throwable;

class DeleteCategoryAction implements Executable
{
    private $category;

    /**
     * @param Category $category
     */
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    /**
     * @return bool
     * @throws Throwable
     */
    public function handle(): bool
    {
        \DB::transaction(function () {
            $this->category->expenses()->delete();
            $this->category->delete();
        });

        return true;
    }
}
