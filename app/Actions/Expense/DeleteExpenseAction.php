<?php

namespace App\Actions\Expense;

use App\Actions\Executable;
use App\Models\Expense;
use Throwable;

class DeleteExpenseAction implements Executable
{
    private $expense;

    /**
     * @param Expense $expense
     */
    public function __construct(Expense $expense)
    {
        $this->expense = $expense;
    }

    /**
     * @return bool
     * @throws Throwable
     */
    public function handle(): bool
    {
        \DB::transaction(function () {
            $this->expense->delete();
        });

        return true;
    }
}
