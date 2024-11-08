<?php

namespace App\Modules\CrmTasks\Models;

use Illuminate\Database\Eloquent\Model;

class CrmTaskGroup extends Model
{
    protected $fillable = [
        'title',
        'description',
    ];
    protected $table = 'crm_task_groups';
}
