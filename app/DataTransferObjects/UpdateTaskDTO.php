<?php

namespace App\DataTransferObjects;

use App\Enums\TaskStatus;

readonly class UpdateTaskDTO extends CreateTaskDTO
{
    public function __construct(
        private int $id,
        string $title,
        ?string $description,
        int $userId,
        TaskStatus $status
    ) {
        parent::__construct($title, $description, $userId, $status);
    }

    public function getId(): int
    {
        return $this->id;
    }
}
