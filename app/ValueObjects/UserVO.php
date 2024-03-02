<?php

namespace App\ValueObjects;

use Carbon\Carbon;

readonly class UserVO
{
    public function __construct(
        private int $id,
        private string $name,
        private string $email,
        private ?Carbon $emailVerifiedAt,
        private ?Carbon $createdAt,
        private ?Carbon $updatedAt
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getEmailVerifiedAt(): ?Carbon
    {
        return $this->emailVerifiedAt;
    }

    public function getCreatedAt(): ?Carbon
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?Carbon
    {
        return $this->updatedAt;
    }
}
