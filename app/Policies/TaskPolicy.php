<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\User;
use App\ValueObjects\TaskVO;

class TaskPolicy
{
    public function update(User $user, TaskVO $task): bool
    {
        // user roles can be implemented to extend the capabilities of the policy
        return $user->id === $task->getUserId();
    }

    public function delete(User $user, TaskVO $task): bool
    {
        return $user->id === $task->getUserId();
    }
}
