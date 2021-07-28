<?php

namespace App\Http\Controllers\Api;

use App\Actions\MonthExpensesCategory\CreateMonthExpensesCategoryAction;
use App\Actions\MonthExpensesCategory\DeleteMonthExpensesCategoryAction;
use App\Actions\MonthExpensesCategory\GetMonthExpensesCategoriesAction;
use App\Actions\MonthExpensesCategory\UpdateMonthExpensesCategoryAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\MonthExpensesCategoryRequest;
use App\Models\Category;
use App\Models\MonthExpensesCategory;

class MonthExpensesCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function index(): array
    {
        return [
            'monthExpensesCategories' => $this->execute(new GetMonthExpensesCategoriesAction()),
            'monthExpensesTotal' => MonthExpensesCategory::get()->sum('monthExpensesTotal')
        ];
    }

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
    public function update(MonthExpensesCategoryRequest $request, MonthExpensesCategory $monthExpensesCategory): array
    {
        return [
            'monthExpensesCategory' => $this->execute(new UpdateMonthExpensesCategoryAction($monthExpensesCategory, $request->validated())),
            'message' => 'Categoria atualizada!'
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return array
     */
    public function destroy(MonthExpensesCategory $monthExpensesCategory): array
    {
        return [
            $this->execute(new DeleteMonthExpensesCategoryAction($monthExpensesCategory)),
            'message' => 'Categoria deletada!'
        ];
    }


}
