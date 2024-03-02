<?php

namespace App\Mappers;

use App\ValueObjects\TaskVO;

class TaskVOMapper
{
    public function fromEloquentModel($task): TaskVO
    {
        return new TaskVO(
            $task->id,
            $task->title,
            $task->description,
            $task->user_id,
            $task->status,
            $task->created_at,
            $task->updated_at
        );
    }
}
