<?php

declare(strict_types=1);

namespace App\DataTransferObjects;

use App\Enums\TaskStatus;

readonly class UpdateTaskDTO
{
    public function __construct(
        private int $id,
        private string $title,
        private ?string $description,
        private int $userId,
        private TaskStatus $status
    ) {
    }

    public function getId(): int
    {
        return $this->id;
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
