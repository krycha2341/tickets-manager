<?php

namespace App\Models;

use App\Enums\TaskStatus;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Task
 *
 * @package App\Models
 *
 * @property int $id
 * @property string $title
 * @property string|null $description
 * @property int $user_id
 * @property TaskStatus $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'user_id',
        'status',
    ];

    protected $casts = [
        'status' => TaskStatus::class,
    ];

    protected $table = 'tasks';
}
