<?php

declare(strict_types=1);

namespace App\Http\Controllers\Tasks;

use App\DataTransferObjects\CreateTaskDTO;
use App\Enums\TaskStatus;
use App\Http\Controllers\Controller;
use App\Http\Transformers\TaskTransformer;
use App\Services\TasksService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CreateTask extends Controller
{
    public function __construct(readonly private TasksService $tasksService)
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $userId = $request->get('user_id');
        if ($userId === null) {
            $userId = $request->user()->id;
        }
        $taskStatus = TaskStatus::OPEN;
        if ($request->has('status')) {
            $taskStatus = TaskStatus::tryFrom($request->get('status'));
        }

        $dto = new CreateTaskDTO(
            $request->get('title'),
            $request->get('description'),
            $userId,
            $taskStatus
        );

        $taskVO = $this->tasksService->create($dto);

        return $this->itemResponse($taskVO, new TaskTransformer());
    }
}
