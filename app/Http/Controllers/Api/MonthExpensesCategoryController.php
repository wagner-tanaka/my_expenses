<?php

namespace App\Http\Controllers\Api;

use App\Actions\MonthExpensesCategory\CreateMonthExpensesCategoryAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\MonthExpensesCategoryRequest;
use App\Models\Category;

class MonthExpensesCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return array
     */
//    public function index(): array
//    {
//
//        return [
//            'categories' => $this->execute(new GetCategoriesAction),
//            'categoriesAmountTotal' => Category::get()->sum('totalCategoryExpenses')
//        ];
//    }

//    public function getDailyExpensesTotal(){
//        return Category::get()->sum('totalCategoryExpenses');
//    }
    /**
     * Store a newly created resource in storage.
     *
     * @param MonthExpensesCategoryRequest $request
     * @return array
     */
    public function store(MonthExpensesCategoryRequest $request): array
    {
        return [
            'monthExpensesCategory' => $this->execute(new CreateMonthExpensesCategoryAction($request->validated())),
            'message' => 'Categoria salva!'
        ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CategoryRequest $request
     * @param Category $category
     * @return array
     */
//    public function update(CategoryRequest $request, Category $category): array
//    {
//        return [
//            'category' => $this->execute(new UpdateCategoryAction($category, $request->validated())),
//            'message' => 'Categoria atualizada!'
//        ];
//    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return array
     */
//    public function destroy(Category $category): array
//    {
//        return [
//            $this->execute(new DeleteCategoryAction($category)),
//            'message' => 'Categoria deletada!'
//        ];
//    }


}
