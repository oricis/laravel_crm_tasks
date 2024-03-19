<?php

namespace App\Modules\CrmTasks\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo as BelongsToCollection;

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


    public function group(): BelongsToCollection
    {
        return $this->belongsTo(TaskGroup::class, 'task_group_id');
    }
}
