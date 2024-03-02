<?php

declare(strict_types=1);

namespace App\ValueObjects;

use App\Enums\TaskStatus;
use Carbon\Carbon;

readonly class TaskVO
{
    public function __construct(
        private int $id,
        private string $title,
        private ?string $description,
        private int $userId,
        private TaskStatus $status,
        private Carbon $createdAt,
        private Carbon $updatedAt
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

    public function getCreatedAt(): Carbon
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): Carbon
    {
        return $this->updatedAt;
    }
}
