<?php

namespace App\Http\Controllers\Tasks;

use App\DataTransferObjects\ListTasksDTO;
use App\Http\Controllers\Controller;
use App\Http\Transformers\TaskTransformer;
use App\Services\TasksService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ListTasks extends Controller
{
    public function __construct(readonly private TasksService $tasksService)
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $tasks = $this->tasksService->list(new ListTasksDTO(
            $request->get('limit'),
            $request->get('offset'),
            $request->get('user_id'),
        ));

        return $this->collectionResponse($tasks, new TaskTransformer());
    }
}
