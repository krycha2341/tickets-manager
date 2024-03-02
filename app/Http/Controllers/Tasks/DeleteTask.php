<?php

declare(strict_types=1);

namespace App\Http\Controllers\Tasks;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class DeleteTask extends Controller
{
    public function __invoke(int $id): JsonResponse
    {
        return $this->emptyResponse();
    }
}
