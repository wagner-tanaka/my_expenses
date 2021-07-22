<?php

namespace App\Http\Controllers\Api;

use App\Actions\Expense\CreateExpenseAction;
use App\Actions\Expense\DeleteExpenseAction;
use App\Actions\Expense\GetExpensesAction;
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
        return [
            'expense' => $this->execute(new CreateExpenseAction($request->validated())),
            'message' => 'Despesa salva!'
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
