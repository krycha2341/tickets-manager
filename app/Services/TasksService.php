<?php

declare(strict_types=1);

namespace App\Services;

use App\DataTransferObjects\CreateTaskDTO;
use App\DataTransferObjects\ListTasksDTO;
use App\DataTransferObjects\UpdateTaskDTO;
use App\DataTransferObjects\UpdateTaskRequestDTO;
use App\Exceptions\CannotPerformActionOnTaskException;
use App\Exceptions\TaskNotFoundException;
use App\Exceptions\UserNotFoundException;
use App\Repositories\TasksRepository;
use App\Services\StateManagers\Tasks\TaskStateManager;
use App\ValueObjects\TaskVO;
use Illuminate\Support\Collection;

readonly class TasksService
{
    public function __construct(
        private TasksRepository $tasksRepository,
        private UsersService $usersService,
        private TaskStateManager $taskStateManager
    ) {
    }

    public function create(CreateTaskDTO $dto): TaskVO
    {
        return $this->tasksRepository->create($dto);
    }

    /**
     * @throws TaskNotFoundException
     */
    public function get(int $id): TaskVO
    {
        return $this->tasksRepository->get($id);
    }

    /**
     * @throws UserNotFoundException
     * @throws TaskNotFoundException
     * @throws CannotPerformActionOnTaskException
     */
    public function update(UpdateTaskRequestDTO $dto): void
    {
        $this->usersService->get($dto->getUserId());
        $taskVo = $this->tasksRepository->get($dto->getId());

        $status = $this->taskStateManager->getStatus($dto->getAction(), $taskVo);
        $this->tasksRepository->update(new UpdateTaskDTO(
            $dto->getId(),
            $dto->getTitle(),
            $dto->getDescription(),
            $dto->getUserId(),
            $status
        ));
    }

    public function delete(int $id): void
    {
        $this->tasksRepository->delete($id);
    }

    /**
     * @return Collection<TaskVO>
     */
    public function list(?ListTasksDTO $dto): Collection
    {
        return $this->tasksRepository->list($dto);
    }
}
