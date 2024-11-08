<?php

namespace App\Modules\CrmTasks\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo as BelongsToCollection;
use Illuminate\Database\Eloquent\Relations\HasOne as HasOneCollection;

class CrmTask extends Model
{
    protected $fillable = [
        'title',
        'description',
        'crm_task_group_id',
        'crm_start_time_id',
        'crm_expiration_time_id',
        'start_at',
        'expired_at',
    ];
    protected $table = 'crm_tasks';


    public function expirationTime(): HasOneCollection
    {
        return $this->hasOne(CrmExpirationTime::class, 'id', 'crm_expiration_time_id');
    }

    public function group(): BelongsToCollection
    {
        return $this->belongsTo(CrmTaskGroup::class, 'crm_task_group_id');
    }

    public function startTime(): HasOneCollection
    {
        return $this->hasOne(CrmStartTime::class, 'id', 'crm_start_time_id');
    }
}
