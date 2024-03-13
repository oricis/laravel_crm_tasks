<?php

namespace App\Modules\CrmTasks\Models;

use Illuminate\Database\Eloquent\Model;

class StartTime extends Model
{
    protected $fillable = [
        'label',
        'description',
    ];
    protected $table = 'start_times';
}
