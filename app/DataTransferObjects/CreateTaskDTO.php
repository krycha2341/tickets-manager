<?php

namespace App\DataTransferObjects;

use App\Enums\TaskStatus;

readonly class CreateTaskDTO
{
    public function __construct(
        private string $title,
        private ?string $description,
        private int $userId,
        private TaskStatus $status
    ) {
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getStatus(): TaskStatus
    {
        return $this->status;
    }
}
