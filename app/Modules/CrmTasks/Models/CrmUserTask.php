<?php

namespace App\Modules\CrmTasks\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo as BelongsToCollection;

class CrmUserTask extends Model
{
    protected $fillable = [
        'title',
        'description',
        'assigned_to',
        'crm_task_group_id',
        'created_at',
        'ended_at',
        'expired_at',
    ];
    protected $table = 'crm_user_task';


    public function group(): BelongsToCollection
    {
        return $this->belongsTo(CrmTaskGroup::class, 'crm_task_group_id');
    }
}
