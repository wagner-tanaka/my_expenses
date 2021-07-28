<?php

use App\Http\Controllers\Api\MonthExpenseController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ExpenseController;
use App\Http\Controllers\Api\MonthEarningController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
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
    Route::resource('monthExpensesCategories', \App\Http\Controllers\Api\MonthExpensesCategoryController::class)->only(['store']);
    Route::resource('expenses', ExpenseController::class)->only(['store', 'destroy', 'update']);
    Route::resource('monthExpenses', MonthExpenseController::class);
    Route::resource('monthEarnings', MonthEarningController::class);

    Route::get('getDailyExpensesTotal', [CategoryController::class, 'getDailyExpensesTotal'])->name('getDailyExpensesTotal');
});


