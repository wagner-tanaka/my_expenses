<?php

namespace App\Http\Controllers\Api;

use App\Actions\Expense\CreateExpenseAction;
use App\Actions\Expense\DeleteExpenseAction;
use App\Actions\Expense\UpdateExpenseAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\ExpenseRequest;
use App\Models\Expense;

class ExpenseController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param ExpenseRequest $request
     * @return array
     */
    public function store(ExpenseRequest $request): array
    {
        // dd('chegou no dd', $request->all());
        return [
            'daily-expenses' => $this->execute(new CreateExpenseAction($request->validated())),
            'message' => 'Despesa salva!'
        ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ExpenseRequest $request
     * @param Expense $expense
     * @return array
     */
    public function update(ExpenseRequest $request, Expense $expense): array
    {
        // dd($daily-expenses);
        return [
            'daily-expenses' => $this->execute(new UpdateExpenseAction($expense, $request->validated())),
            'message' => 'Despesa atualizada!'
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Expense $expense
     * @return array
     */
    public function destroy(Expense $expense): array
    {
        return [
            $this->execute(new DeleteExpenseAction($expense)),
            'message' => 'Despesa deletada!'
        ];
    }

}
