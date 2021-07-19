<?php

namespace App\Http\Controllers\Api;

use App\Actions\Category\CreateCategoryAction;
use App\Actions\Category\DeleteCategoryAction;
use App\Actions\Category\GetCategoriesAction;
use App\Actions\Category\GetCategoriesForSelectAction;
use App\Actions\Category\UpdateCategoryAction;
use App\Actions\Expense\GetExpensesAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function index()
    {
        return [
            'categories' => $this->execute(new GetCategoriesAction)
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryRequest $request
     * @return array
     */
    public function store(CategoryRequest $request)
    {
        return [
            'category' => $this->execute(new CreateCategoryAction($request->validated())),
            'message' => 'Categoria salva!'
        ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, Category $category)
    {
        return [
            'category' => $this->execute(new UpdateCategoryAction($category, $request->validated())),
            'message' => 'Categoria atualizada!'
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        return [
            $this->execute(new DeleteCategoryAction($category)),
            'message' => 'Categoria deletada!'
        ];
    }

   
}
