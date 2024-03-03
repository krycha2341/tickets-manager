<?php

namespace App\Services\StateManagers\Tasks;

class TaskState
{
    public function __construct(private string $statusString)
    {
    }

    public function getStatusString(): string
    {
        return $this->statusString;
    }

    public function setStatusString(string $status): self
    {
        $this->statusString = $status;

        return $this;
    }
}
