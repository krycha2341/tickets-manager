<?php

namespace App\DataTransferObjects;

readonly class ExternalUserDTO
{
    public function __construct(
        private string $id,
        private string $firstName,
        private string $lastName,
        private string $email,
        private ?string $password = null
    ) {
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }
}
