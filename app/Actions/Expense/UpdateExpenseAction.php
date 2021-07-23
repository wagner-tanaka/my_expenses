<?php

namespace App\Actions\Expense;

use App\Actions\Executable;
use App\Models\Expense;
use Throwable;

class UpdateExpenseAction implements Executable
{
    protected $expense;
    protected $data;

    /**
     * @param Expense $project
     * @param array $data
     */
    public function __construct(Expense $expense, array $data)
    {
        $this->data = $data;
        $this->expense = $expense;
    }

    /**
     * @return Expense
     * @throws Throwable
     */
    public function handle(): Expense
    {
        \DB::transaction(function () {
            $this->expense->update($this->data);
        });

        return $this->expense;
    }
}
