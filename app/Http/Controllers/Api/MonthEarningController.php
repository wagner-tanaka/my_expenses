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
    public function index(): array
    {
        return [
            'monthEarnings' => $this->execute(new GetMonthEarningsAction),
            'monthEarningsTotal' => MonthEarning::get()->sum('value')
        ];
    }

    /**
     * @param MonthEarningRequest $request
     * @return array
     */
    public function store(MonthEarningRequest $request): array
    {
        return [
            'monthEarning' => $this->execute(new CreateMonthEarningAction($request->validated())),
            'message' => 'Ganho Salvo'
        ];
    }

    /**
     * @param  MonthEarningRequest  $request
     * @param MonthEarning $monthEarning
     * @return array
     */
    public function update(MonthEarningRequest $request, MonthEarning $monthEarning): array
    {
        return [
            'monthEarning' => $this->execute(new UpdateMonthEarningAction($monthEarning, $request->validated())),
            'message' => 'Ganho atualizado!'
        ];
    }

    /**
     * @param MonthEarning $monthEarning
     * @return array
     */
    public function destroy(MonthEarning $monthEarning): array
    {
        return [
            $this->execute(new DeleteMonthEarningAction($monthEarning)),
            'message' => 'Ganho deletado!'
        ];
    }
}
