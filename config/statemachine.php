<?php

use App\Enums\TaskAction;
use App\Enums\TaskStatus;

return [
    'tasks' => [
        'graph' => 'task_status',
        'property_path' => 'statusString',
        'states' => TaskStatus::values(),
        'transitions' => [
            TaskAction::START->value => [
                'from' => [TaskStatus::OPEN->value],
                'to' => TaskStatus::IN_PROGRESS->value,
            ],
            TaskAction::CODE_REVIEW->value => [
                'from' => [TaskStatus::OPEN->value, TaskStatus::IN_PROGRESS->value],
                'to' => TaskStatus::TO_VERIFY->value,
            ],
            TaskAction::REVERT->value => [
                'from' => [TaskStatus::TO_VERIFY->value, TaskStatus::DONE->value],
                'to' => TaskStatus::OPEN->value,
            ],
            TaskAction::RELEASE->value => [
                'from' => [TaskStatus::TO_VERIFY->value],
                'to' => TaskStatus::DONE->value,
            ],
            TaskAction::CLOSE->value => [
                'from' => TaskStatus::values(),
                'to' => TaskStatus::DONE->value,
            ],
        ],
    ],
];
