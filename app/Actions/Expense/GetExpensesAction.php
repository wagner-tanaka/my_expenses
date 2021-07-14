<?php
namespace App\Actions\Expense;

// use App\Actions\Executable;

use App\Actions\Executable;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ExpenseResource;
use App\Models\Category;

class GetExpensesAction implements Executable
{

    private $category;
    
    public function __construct(Category $category)

    {
        $this->category = $category;
    }

    public function handle()
    {
        $expenses = $this->category->expenses()->get();
        
        return ExpenseResource::collection($expenses)->response()->getData(true);
    }
}
