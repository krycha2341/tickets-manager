<?php

declare(strict_types=1);

namespace App\Http\Controllers\Tasks;

use App\DataTransferObjects\UpdateTaskDTO;
use App\Enums\TaskStatus;
use App\Http\Controllers\Controller;
use App\Services\TasksService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UpdateTask extends Controller
{
    public function __construct(readonly private TasksService $tasksService)
    {
    }

    public function __invoke(int $id, Request $request): JsonResponse
    {
        $userId = $request->get('user_id');
        if ($userId === null) {
            $userId = $request->user()->id;
        }

        $dto = new UpdateTaskDTO(
            $id,
            $request->get('title'),
            $request->get('description'),
            $userId,
            TaskStatus::tryFrom($request->get('status'))
        );

        $this->tasksService->update($dto);

        return $this->emptyResponse();
    }
}
