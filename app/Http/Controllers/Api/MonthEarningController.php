<?php

namespace App\Http\Controllers\Api;

use App\Actions\MonthEarning\CreateMonthEarningAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\MonthEarningRequest;
use App\Models\MonthEarning;
use Illuminate\Http\Request;

class MonthEarningController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(MonthEarningRequest $request)
    {
        return [
            'monthEarning' => $this->execute(new CreateMonthEarningAction($request->validated())),
            'message' => 'Ganho Salva'
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MonthEarning  $monthEarning
     * @return \Illuminate\Http\Response
     */
    public function show(MonthEarning $monthEarning)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MonthEarning  $monthEarning
     * @return \Illuminate\Http\Response
     */
    public function edit(MonthEarning $monthEarning)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MonthEarning  $monthEarning
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MonthEarning $monthEarning)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MonthEarning  $monthEarning
     * @return \Illuminate\Http\Response
     */
    public function destroy(MonthEarning $monthEarning)
    {
        //
    }
}
