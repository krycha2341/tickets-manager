<?php

namespace App\DataTransferObjects;

use App\Enums\TaskAction;

readonly class UpdateTaskRequestDTO
{
    public function __construct(
        private int $id,
        private string $title,
        private ?string $description,
        private int $userId,
        private TaskAction $action
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

    public function getAction(): TaskAction
    {
        return $this->action;
    }
}
