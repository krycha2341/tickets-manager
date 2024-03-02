<?php

declare(strict_types=1);

namespace App\Http\Controllers\Tasks;

use App\Exceptions\TaskNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Transformers\TaskTransformer;
use App\Services\TasksService;
use Illuminate\Http\JsonResponse;

class GetTask extends Controller
{
    public function __construct(readonly private TasksService $tasksService)
    {
    }

    /**
     * @throws TaskNotFoundException
     */
    public function __invoke(int $id): JsonResponse
    {
        $taskVO = $this->tasksService->get($id);

        return $this->itemResponse($taskVO, new TaskTransformer());
    }
}
