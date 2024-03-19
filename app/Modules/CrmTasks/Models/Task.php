<?php

namespace App\Modules\CrmTasks\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo as BelongsToCollection;
use Illuminate\Database\Eloquent\Relations\HasOne as HasOneCollection;

class Task extends Model
{
    protected $fillable = [
        'title',
        'description',
        'task_group_id',
        'start_time_id',
        'expiration_time_id',
        'start_at',
        'expired_at',
    ];
    protected $table = 'tasks';


    public function expirationTime(): HasOneCollection
    {
        return $this->hasOne(ExpirationTime::class, 'id', 'expiration_time_id');
    }

    public function group(): BelongsToCollection
    {
        return $this->belongsTo(TaskGroup::class, 'task_group_id');
    }

    public function startTime(): HasOneCollection
    {
        return $this->hasOne(StartTime::class, 'id', 'start_time_id');
    }
}
