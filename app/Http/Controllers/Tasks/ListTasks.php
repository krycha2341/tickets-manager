<?php

namespace App\Http\Controllers\Tasks;

use App\DataTransferObjects\ListTasksDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tasks\ListRequest;
use App\Http\Transformers\TaskTransformer;
use App\Services\TasksService;
use Illuminate\Http\JsonResponse;

class ListTasks extends Controller
{
    public function __construct(readonly private TasksService $tasksService)
    {
    }

    public function __invoke(ListRequest $request): JsonResponse
    {
        $tasks = $this->tasksService->list(new ListTasksDTO(
            $request->get('limit'),
            $request->get('offset'),
            $request->get('user_id'),
        ));

        return $this->collectionResponse($tasks, new TaskTransformer());
    }
}
