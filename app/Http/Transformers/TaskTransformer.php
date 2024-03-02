<?php

namespace App\Http\Transformers;

use App\ValueObjects\TaskVO;
use League\Fractal\TransformerAbstract;

class TaskTransformer extends TransformerAbstract
{
    public function transform(TaskVO $taskVO): array
    {
        return [
            'id' => $taskVO->getId(),
            'title' => $taskVO->getTitle(),
            'description' => $taskVO->getDescription(),
            'user_id' => $taskVO->getUserId(),
            'status' => $taskVO->getStatus()->value,
            'created_at' => $taskVO->getCreatedAt()->toDateTimeString(),
            'updated_at' => $taskVO->getUpdatedAt()->toDateTimeString()
        ];
    }
}
