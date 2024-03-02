<?php

declare(strict_types=1);

namespace App\Http\Controllers\Tasks;

use App\Exceptions\TaskNotFoundException;
use App\Http\Controllers\Controller;
use App\Services\TasksService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;

class DeleteTask extends Controller
{
    public function __construct(readonly private TasksService $tasksService)
    {
    }

    /**
     * @throws AuthorizationException
     * @throws TaskNotFoundException
     */
    public function __invoke(int $id): JsonResponse
    {
        $taskVo = $this->tasksService->get($id);
        $this->authorize('delete', [$taskVo]);

        $this->tasksService->delete($id);

        return $this->emptyResponse();
    }
}
