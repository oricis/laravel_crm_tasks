<?php

namespace App\Modules\CrmTasks\Models;

use Illuminate\Database\Eloquent\Model;

class CrmTimeFilter extends Model
{
    protected $fillable = [
        'label',
        'description',
    ];
    protected $table = 'crm_time_filters';
}
