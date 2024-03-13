<?php

namespace App\Modules\CrmTasks\Models;

use Illuminate\Database\Eloquent\Model;

class UserTask extends Model
{
    protected $fillable = [
        'title',
        'description',
        'assigned_to',
        'task_group_id',
        'created_at',
        'ended_at',
        'expired_at',
    ];
    protected $table = 'user_task';
}
