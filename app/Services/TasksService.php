<?php

namespace App\Services;

use App\DataTransferObjects\CreateTaskDTO;
use App\DataTransferObjects\ListTasksDTO;
use App\DataTransferObjects\UpdateTaskDTO;
use App\Exceptions\TaskNotFoundException;
use App\Exceptions\UserNotFoundException;
use App\Repositories\TasksRepository;
use App\ValueObjects\TaskVO;
use Illuminate\Support\Collection;

readonly class TasksService
{
    public function __construct(
        private TasksRepository $tasksRepository,
        private UsersService $usersService
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
     */
    public function update(UpdateTaskDTO $dto): void
    {
        $this->usersService->get($dto->getUserId());
        $this->tasksRepository->update($dto);
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
