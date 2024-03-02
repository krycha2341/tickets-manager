<?php

namespace App\DataTransferObjects;

readonly class ListTasksDTO
{
    public function __construct(
        private ?int $limit = null,
        private ?int $offset = null,
        private ?int $userId = null
    ) {
    }

    public function getLimit(): ?int
    {
        return $this->limit;
    }

    public function getOffset(): ?int
    {
        return $this->offset;
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }
}
