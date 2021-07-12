<?php


namespace App\Traits;


use App\Actions\Executable;
use Exception;
use Throwable;

trait ActionHandler
{
    public function execute(Executable $action)
    {
        try {
            return $action->handle();
        } catch (Exception | Throwable $e) {
            abort(500, $e->getMessage());
        }
    }
}
