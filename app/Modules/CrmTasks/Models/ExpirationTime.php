<?php

namespace App\Modules\CrmTasks\Models;

use Illuminate\Database\Eloquent\Model;

class ExpirationTime extends Model
{
    protected $fillable = [
        'label',
        'description',
    ];
    protected $table = 'expiration_times';
}
