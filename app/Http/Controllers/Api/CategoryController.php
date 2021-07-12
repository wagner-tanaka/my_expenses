<?php

namespace App\Http\Controllers\Api;

use App\Actions\Category\CreateCategoryAction;
use App\Actions\Category\GetCategoriesAction;
use App\Actions\Category\GetCategoriesForSelectAction;
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
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }

    public function getCategories(): array
    {
        return [
            'categories' => $this->execute(new GetCategoriesForSelectAction())
        ];
    }
}
