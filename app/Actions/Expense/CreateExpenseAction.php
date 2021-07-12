<?php
namespace App\Actions\Expense;


use App\Actions\Executable;
use App\Models\Expense;
use Throwable;

class CreateExpenseAction implements Executable
{
    protected $expense;
    protected $data;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @return Expense
     * @throws Throwable
     */
    public function handle(): Expense
    {
        \DB::transaction(function () {
            $this->expense = Expense::create($this->data);
        });

        return $this->expense;
    }
}
