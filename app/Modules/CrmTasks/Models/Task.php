<?php

namespace App\Modules\CrmTasks\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo as BelongsToCollection;

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


    public function group(): BelongsToCollection
    {
        return $this->belongsTo(TaskGroup::class, 'task_group_id');
    }
}
