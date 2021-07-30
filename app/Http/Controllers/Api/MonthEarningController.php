<?php

namespace App\Http\Controllers\Api;

use App\Actions\MonthEarning\UpdateMonthEarningAction;
use App\Actions\MonthEarning\CreateMonthEarningAction;
use App\Actions\MonthEarning\DeleteMonthEarningAction;
use App\Actions\MonthEarning\GetMonthEarningsAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\MonthEarningRequest;
use App\Models\MonthEarning;

class MonthEarningController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function index()
    {
        return [
            'monthEarnings' => $this->execute(new GetMonthEarningsAction),
            'monthEarningsTotal' => MonthEarning::get()->sum('value')
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function store(MonthEarningRequest $request)
    {
        return [
            'monthEarning' => $this->execute(new CreateMonthEarningAction($request->validated())),
            'message' => 'Ganho Salva'
        ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MonthEarning  $monthEarning
     * @return array
     */
    public function update(MonthEarningRequest $request, MonthEarning $monthEarning)
    {
        return [
            'monthEarning' => $this->execute(new UpdateMonthEarningAction($monthEarning, $request->validated())),
            'message' => 'Ganho atualizado!'
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MonthEarning  $monthEarning
     * @return array
     */
    public function destroy(MonthEarning $monthEarning)
    {
        return [
            $this->execute(new DeleteMonthEarningAction($monthEarning)),
            'message' => 'Ganho deletado!'
        ];
    }
}

