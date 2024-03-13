<?php

namespace App\Modules\CrmTasks\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'title',
        'description',
        'task_group_id',
        'started_at',
        'expired_at',
    ];
    protected $table = 'tasks';
}
