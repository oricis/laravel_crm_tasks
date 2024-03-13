<?php

namespace App\Modules\CrmTasks\Models;

use Illuminate\Database\Eloquent\Model;

class TimeFilter extends Model
{
    protected $fillable = [
        'label',
        'description',
    ];
    protected $table = 'time_filters';
}
