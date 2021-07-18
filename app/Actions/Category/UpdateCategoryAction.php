<?php

namespace App\Actions\Category;

use App\Actions\Executable;
use App\Models\Category;
use Throwable;

class UpdateCategoryAction implements Executable
{
    protected $category;
    protected $data;

    /**
     * @param Category $project
     * @param array $data
     */
    public function __construct(Category $category, array $data)
    {
        $this->data = $data;
        $this->category = $category;
    }

    /**
     * @return Project
     * @throws Throwable
     */
    public function handle(): Category
    {
        \DB::transaction(function () {
            $this->category->update($this->data);
        });

        return $this->category;
    }
}
