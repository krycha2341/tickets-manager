<?php

declare(strict_types=1);

namespace App\Http\Controllers\Tasks;

use App\DataTransferObjects\UpdateTaskDTO;
use App\Enums\TaskStatus;
use App\Exceptions\UserNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tasks\UpdateRequest;
use App\Services\TasksService;
use Illuminate\Http\JsonResponse;

class UpdateTask extends Controller
{
    public function __construct(readonly private TasksService $tasksService)
    {
    }

    /**
     * @throws UserNotFoundException
     */
    public function __invoke(int $id, UpdateRequest $request): JsonResponse
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
