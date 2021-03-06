<?php

use App\Http\Controllers\Api\MonthEarningsCategoryController;
use App\Http\Controllers\Api\MonthExpenseController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ExpenseController;
use App\Http\Controllers\Api\MonthEarningController;
use App\Http\Controllers\Api\MonthExpensesCategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|-----------------------------API---------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['auth:sanctum'], 'as' => 'api.'], function () {
    Route::resource('categories', CategoryController::class)->only(['index','store','update','destroy']);
    Route::resource('expenses', ExpenseController::class)->only(['store', 'destroy', 'update']);
    Route::resource('monthExpensesCategories', MonthExpensesCategoryController::class)->only(['store','index','update','destroy']);
    Route::resource('monthEarningsCategories', MonthEarningsCategoryController::class)->only(['store','index','update','destroy']);
    Route::resource('monthExpenses', MonthExpenseController::class)->only(['index', 'store', 'update', 'destroy']);
    Route::resource('monthEarnings', MonthEarningController::class)->only(['index', 'store', 'update', 'destroy']);

    Route::get('getDailyExpensesTotal', [CategoryController::class, 'getDailyExpensesTotal'])->name('getDailyExpensesTotal');

    Route::get('get_month_expenses_filtered', [MonthExpenseController::class, 'getMonthExpensesFiltered'])->name('get_month_expenses_filtered');
    Route::get('get_categories_filtered', [CategoryController::class, 'getCategoriesFiltered'])->name('get_categories_filtered');

    Route::get('get_month_earnings_filtered', [MonthEarningController::class, 'getMonthEarningsFiltered'])->name('get_month_earnings_filtered');



});


