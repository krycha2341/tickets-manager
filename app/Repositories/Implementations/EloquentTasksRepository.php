<?php

declare(strict_types=1);

namespace App\Repositories\Implementations;

use App\DataTransferObjects\CreateTaskDTO;
use App\DataTransferObjects\ListTasksDTO;
use App\DataTransferObjects\UpdateTaskDTO;
use App\Exceptions\TaskNotFoundException;
use App\Mappers\TaskVOMapper;
use App\Models\Task;
use App\Repositories\TasksRepository;
use App\ValueObjects\TaskVO;
use Illuminate\Support\Collection;

readonly class EloquentTasksRepository implements TasksRepository
{
    public function __construct(private TaskVOMapper $taskVOMapper)
    {
    }

    public function create(CreateTaskDTO $dto): TaskVO
    {
        $taskModel = Task::query()->create([
            'title' => $dto->getTitle(),
            'description' => $dto->getDescription(),
            'user_id' => $dto->getUserId(),
            'status' => $dto->getStatus(),
        ]);

        return $this->taskVOMapper->fromEloquentModel($taskModel);
    }

    public function get(int $id): TaskVO
    {
        $taskModel = Task::query()->where('id', $id)
            ->first();

        if ($taskModel === null) {
            throw new TaskNotFoundException();
        }

        return $this->taskVOMapper->fromEloquentModel($taskModel);
    }

    public function update(UpdateTaskDTO $dto): void
    {
        Task::query()->where('id', $dto->getId())
            ->update([
                'title' => $dto->getTitle(),
                'description' => $dto->getDescription(),
                'user_id' => $dto->getUserId(),
                'status' => $dto->getStatus(),
            ]);
    }

    public function delete(int $id): void
    {
        Task::query()->where('id', $id)
            ->delete();
    }

    public function list(?ListTasksDTO $dto): Collection
    {
        $query = Task::query();

        if ($dto?->getLimit() !== null) {
            $query->limit($dto->getLimit());
        }
        if ($dto?->getOffset() !== null) {
            $query->offset($dto->getOffset());
        }
        if ($dto?->getUserId() !== null) {
            $query->where('user_id', $dto->getUserId());
        }

        return $query->get()->map(
            fn (Task $task) => $this->taskVOMapper->fromEloquentModel($task)
        );
    }
}
