<?php

namespace App\Http\Controllers\Api;

use App\Actions\Expense\CreateExpenseAction;
use App\Actions\Expense\DeleteExpenseAction;
use App\Actions\Expense\GetExpensesAction;
use App\Actions\Expense\UpdateExpenseAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\ExpenseRequest;
use App\Models\Category;
use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param ExpenseRequest $request
     * @return array
     */
    public function store(ExpenseRequest $request)
    {
        // dd('chegou no dd', $request->all());
        return [
            'expense' => $this->execute(new CreateExpenseAction($request->validated())),
            'message' => 'Despesa salva!'
        ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(ExpenseRequest $request, Expense $expense)
    {
        // dd($expense);
        return [
            'expense' => $this->execute(new UpdateExpenseAction($expense, $request->validated())),
            'message' => 'Despesa atualizada!'
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expense $expense)
    {
        return [
            $this->execute(new DeleteExpenseAction($expense)),
            'message' => 'Despesa deletada!'
        ];
    }

}
