<?php

namespace App\Services\StateManagers\Tasks;

use App\Enums\TaskAction;
use App\Enums\TaskStatus;
use App\Exceptions\CannotPerformActionOnTaskException;
use App\ValueObjects\TaskVO;
use Illuminate\Support\Facades\Log;
use SM\SMException;
use SM\StateMachine\StateMachine;

class TaskStateManager
{
    /**
     * @throws CannotPerformActionOnTaskException
     */
    public function getStatus(TaskAction $action, TaskVO $taskVo): TaskStatus
    {
        $taskState = new TaskState($taskVo->getStatus()->value);
        try {
            $stateMachine = new StateMachine($taskState, config('statemachine.tasks'));
            if (!$stateMachine->apply($action->value, true)) {
                throw new CannotPerformActionOnTaskException();
            }
        } catch (SMException $exception) {
            Log::error('State machine exception!', [
                'message' => $exception->getMessage(),
                'code' => $exception->getCode(),
                'trace' => $exception->getTrace(),
            ]);

            throw new CannotPerformActionOnTaskException();
        }

        return TaskStatus::tryFrom($stateMachine->getState());
    }
}
