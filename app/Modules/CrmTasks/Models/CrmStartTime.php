<?php

namespace App\Modules\CrmTasks\Models;

use Illuminate\Database\Eloquent\Model;

class CrmStartTime extends Model
{
    protected $fillable = [
        'label',
        'description',
    ];
    protected $table = 'crm_start_times';
}
