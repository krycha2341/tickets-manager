<?php

declare(strict_types=1);

namespace App\Http\Controllers\Tasks;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class UpdateTask extends Controller
{
    public function __invoke(): JsonResponse
    {
        return $this->emptyResponse();
    }
}
