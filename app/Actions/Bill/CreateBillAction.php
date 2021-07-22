<?php 

namespace App\Actions\Bill;

use App\Actions\Executable;
use App\Models\Bill;
use Throwable;

class CreateBillAction implements Executable
{
    protected $bill;
    protected $data;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
            $this->data = $data;
    }

     /**
     * @return Bill
     * @throws Throwable
     */
    public function handle(): Bill
    {
        \DB::transaction(function () {
            $this->bill = Bill::create($this->data);
        });
        return $this->bill;
    }
}