<?php

namespace App\Http\Controllers\Api;

use App\Actions\Category\CreateCategoryAction;
use App\Actions\Category\DeleteCategoryAction;
use App\Actions\Category\GetCategoriesAction;
use App\Actions\Category\UpdateCategoryAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function index(): array
    {
        return [
            'categories' => $this->execute(new GetCategoriesAction),
            'categoriesAmountTotal' => Category::get()->sum('totalCategoryExpenses')
        ];
    }

    public function getDailyExpensesTotal()
    {
        // TODO retornar com nome
        return Category::get()->sum('totalCategoryExpenses');
    }

    /**
     * @param CategoryRequest $request
     * @return array
     */
    public function store(CategoryRequest $request): array
    {
        return [
            'category' => $this->execute(new CreateCategoryAction($request->validated())),
            'message' => 'Categoria salva!'
        ];
    }

    /**
     * @param CategoryRequest $request
     * @param Category $category
     * @return array
     */
    public function update(CategoryRequest $request, Category $category): array
    {
        return [
            'category' => $this->execute(new UpdateCategoryAction($category, $request->validated())),
            'message' => 'Categoria atualizada!'
        ];
    }

    /**
     * @param Category $category
     * @return array
     */
    public function destroy(Category $category): array
    {
        return [
            $this->execute(new DeleteCategoryAction($category)),
            'message' => 'Categoria deletada!'
        ];
    }
}
