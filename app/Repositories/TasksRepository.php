<?php

namespace App\Repositories;

use App\DataTransferObjects\CreateTaskDTO;
use App\DataTransferObjects\ListTasksDTO;
use App\DataTransferObjects\UpdateTaskDTO;
use App\Exceptions\TaskNotFoundException;
use App\ValueObjects\TaskVO;
use Illuminate\Support\Collection;

interface TasksRepository
{
    public function create(CreateTaskDTO $dto): TaskVO;

    /**
     * @throws TaskNotFoundException
     */
    public function get(int $id): TaskVO;

    public function update(UpdateTaskDTO $dto): void;

    public function delete(int $id): void;

    /**
     * @return Collection<TaskVO>
     */
    public function list(?ListTasksDTO $dto): Collection;
}
