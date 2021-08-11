<?php

namespace App\Http\Controllers\Api;

use App\Actions\MonthEarningsCategory\CreateMonthEarningsCategoryAction;
use App\Actions\MonthEarningsCategory\DeleteMonthEarningsCategoryAction;
use App\Actions\MonthEarningsCategory\GetMonthEarningsCategoriesAction;
use App\Actions\MonthEarningsCategory\UpdateMonthEarningsCategoryAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\MonthEarningsCategoryRequest;
use App\Models\MonthEarningsCategory;

class MonthEarningsCategoryController extends Controller
{
    /**
     * @return array
     */
    public function index(): array
    {
        return [
            'monthEarningsCategories' => $this->execute(new GetMonthEarningsCategoriesAction()),
            'monthEarningsTotal' => MonthEarningsCategory::get()->sum('monthEarningsTotal')
        ];
    }

    /**
     * @param MonthEarningsCategoryRequest $request
     * @return array
     */
    public function store(MonthEarningsCategoryRequest $request): array
    {
        return [
            'monthEarningsCategory' => $this->execute(new CreateMonthEarningsCategoryAction($request->validated())),
            'message' => 'Categoria salva!'
        ];
    }

    /**
     * @param MonthEarningsCategoryRequest $request
     * @param MonthEarningsCategory $monthEarningsCategory
     * @return array
     */
    public function update(MonthEarningsCategoryRequest $request, MonthEarningsCategory $monthEarningsCategory): array
    {
        return [
            'monthEarningsCategory' => $this->execute(new UpdateMonthEarningsCategoryAction($monthEarningsCategory, $request->validated())),
            'message' => 'Categoria atualizada!'
        ];
    }

    /**
     * @param MonthEarningsCategory $monthEarningsCategory
     * @return array
     */
    public function destroy(MonthEarningsCategory $monthEarningsCategory): array
    {
        return [
            $this->execute(new DeleteMonthEarningsCategoryAction($monthEarningsCategory)),
            'message' => 'Categoria deletada!'
        ];
    }
}
