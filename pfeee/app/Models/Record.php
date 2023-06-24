<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    protected $table = 'records';

    protected $fillable = [
        'full_name',
        'gender',
        'date_of_birth',
        'mobile',
        'address',
        'name',
        'role_name',
        'email',
        'password', // Added password field
    ];
}
