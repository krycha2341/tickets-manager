<?php

declare(strict_types=1);

namespace App\Http\Controllers\Tasks;

use App\Http\Controllers\Controller;
use App\Services\TasksService;
use Illuminate\Http\JsonResponse;

class DeleteTask extends Controller
{
    public function __construct(readonly private TasksService $tasksService)
    {
    }

    public function __invoke(int $id): JsonResponse
    {
        $this->tasksService->delete($id);

        return $this->emptyResponse();
    }
}
