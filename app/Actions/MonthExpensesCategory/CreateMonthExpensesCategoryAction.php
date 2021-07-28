<?php
namespace App\Actions\Category;


use App\Actions\Executable;
use App\Models\Category;
use Throwable;

class CreateCategoryAction implements Executable
{
    protected $category;
    protected $data;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @return Category
     * @throws Throwable
     */
    public function handle(): Category
    {
        \DB::transaction(function () {
            $this->category = auth()->user()->categories()->create($this->data);
        });

        return $this->category;
    }
}
