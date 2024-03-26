<?php

namespace App\Modules\CrmTasks\Models;

use Illuminate\Database\Eloquent\Model;

class CrmExpirationTime extends Model
{
    protected $fillable = [
        'label',
        'description',
    ];
    protected $table = 'crm_expiration_times';
}
