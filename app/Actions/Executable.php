<?php

namespace App\Actions;

use App\Exceptions\CustomException;

interface Executable
{
    /**
     * @return mixed
     * @throws CustomException
     */
    public function handle();
}
