<?php

namespace App\Modules\CrmTasks\Models;

use Illuminate\Database\Eloquent\Model;

class TaskGroup extends Model
{
    protected $fillable = [
        'title',
        'description',
    ];
    protected $table = 'task_groups';
}
