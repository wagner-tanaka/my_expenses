<?php

namespace App\Http\Controllers\Api;

use App\Actions\MonthExpense\GetMonthExpensesFilteredAction;
use App\Actions\MonthExpense\UpdateMonthExpenseAction;
use App\Actions\MonthExpense\CreateMonthExpenseAction;
use App\Actions\MonthExpense\DeleteMonthExpenseAction;
use App\Actions\MonthExpense\GetMonthExpensesAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\MonthExpenseRequest;
use App\Models\MonthExpense;

class MonthExpenseController extends Controller
{
    public function index(): array
    {
        return [
            'monthExpenses' => $this->execute(new GetMonthExpensesAction),
            'monthExpensesTotal' => MonthExpense::get()->sum('value')
        ];
    }

    public function getMonthExpensesFiltered(): array
    {
        return [
          'monthExpensesFiltered' =>  $this->execute(new GetMonthExpensesFilteredAction)
        ];
    }

    /**
     * @param MonthExpenseRequest $request
     * @return array
     */
    public function store(MonthExpenseRequest $request): array
    {
        return [
            'monthExpense' => $this->execute(new CreateMonthExpenseAction($request->validated())),
            'message' => 'Conta Salva'
        ];
    }

    /**
     * @param  MonthExpenseRequest  $request
     * @param MonthExpense $monthExpense
     * @return array
     */
    public function update(MonthExpenseRequest $request, MonthExpense $monthExpense): array
    {
        return [
            'monthExpense' => $this->execute(new UpdateMonthExpenseAction($monthExpense, $request->validated())),
            'message' => 'Conta atualizado!'
        ];
    }

    /**
     * @param MonthExpense $monthExpense
     * @return array
     */
    public function destroy(MonthExpense $monthExpense): array
    {
        return [
            $this->execute(new DeleteMonthExpenseAction($monthExpense)),
            'message' => 'Despesa deletada!'
        ];
    }
}
