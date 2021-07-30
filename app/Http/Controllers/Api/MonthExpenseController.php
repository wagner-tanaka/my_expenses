<?php

namespace App\Http\Controllers\Api;

use App\Actions\MonthExpense\UpdateMonthExpenseAction;
use App\Actions\MonthExpense\CreateMonthExpenseAction;
use App\Actions\MonthExpense\DeleteMonthExpenseAction;
use App\Actions\MonthExpense\GetMonthExpensesAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\MonthExpenseRequest;
use App\Models\MonthExpense;

class MonthExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function index()
    {
        return [
            'monthExpenses' => $this->execute(new GetMonthExpensesAction),
            'monthExpensesTotal' => MonthExpense::get()->sum('value')
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function store(MonthExpenseRequest $request)
    {
        return [
            'monthExpense' => $this->execute(new CreateMonthExpenseAction($request->validated())),
            'message' => 'Conta Salva'
        ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  MonthExpenseRequest  $request
     * @param MonthExpense $monthExpense
     * @return array
     */
    public function update(MonthExpenseRequest $request, MonthExpense $monthExpense)
    {
        return [
            'monthExpense' => $this->execute(new UpdateMonthExpenseAction($monthExpense, $request->validated())),
            'message' => 'Conta atualizado!'
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param MonthExpense $monthExpense
     * @return array
     */
    public function destroy(MonthExpense $monthExpense)
    {
        return [
            $this->execute(new DeleteMonthExpenseAction($monthExpense)),
            'message' => 'Despesa deletada!'
        ];
    }
}
