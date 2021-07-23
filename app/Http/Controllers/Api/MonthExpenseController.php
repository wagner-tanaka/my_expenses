<?php

namespace App\Http\Controllers\Api;

use App\Actions\MonthExpense\UpdateMonthExpenseAction;
use App\Actions\MonthExpense\CreateMonthExpenseAction;
use App\Actions\MonthExpense\DeleteMonthExpenseAction;
use App\Actions\MonthExpense\GetMonthExpensesAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\MonthExpenseRequest;
use App\Models\MonthExpense;
use Illuminate\Http\Request;

class MonthExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return [
            'monthExpenses' => $this->execute(new GetMonthExpensesAction),
            'monthExpensesTotal' => MonthExpense::get()->sum('value')
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MonthExpenseRequest $request)
    {
        return [
            'monthExpense' => $this->execute(new CreateMonthExpenseAction($request->validated())),
            'message' => 'Conta Salva'
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MonthExpense  $monthExpense
     * @return \Illuminate\Http\Response
     */
    public function show(MonthExpense $monthExpense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MonthExpense  $monthExpense
     * @return \Illuminate\Http\Response
     */
    public function edit(MonthExpense $monthExpense)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MonthExpense  $monthExpense
     * @return \Illuminate\Http\Response
     */
    public function update(MonthExpenseRequest $request, MonthExpense $monthExpense)
    {
        // dd('update month', $request->all());
        return [
            'monthExpense' => $this->execute(new UpdateMonthExpenseAction($monthExpense, $request->validated())),
            'message' => 'Gasto atualizado!'
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MonthExpense  $monthExpense
     * @return \Illuminate\Http\Response
     */
    public function destroy(MonthExpense $monthExpense)
    {
        return [
            $this->execute(new DeleteMonthExpenseAction($monthExpense)),
            'message' => 'Despesa deletada!'
        ];
    }
}
