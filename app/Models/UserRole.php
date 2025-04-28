<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class UserRole extends Pivot
{
    protected $table = 'user_role';

    protected $fillable = [
        'user_id',
        'role_id',
    ];

    public $timestamps = false; // karena table pivot biasanya nggak punya created_at/updated_at
}