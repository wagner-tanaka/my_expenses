<?php


namespace App\Traits;


use App\Actions\Executable;
use App\Exceptions\CustomException;
use Exception;
use Throwable;

trait ActionHandler
{
    public function execute(Executable $action, string $success_message = ''): array
    {
        $data = [];
        try {
            $data = [
                'data' => $action->handle(),
                'message' => $success_message
            ];
        } catch (CustomException $e) {
            abort(422, $e->getMessage());
        } catch (Exception | Throwable $e) {
            abort(500, $e->getMessage());
        }

        return $data;
    }
}
