<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use app\Models\User;
class Formation extends Model
{
    protected $fillable = ['formation_name', 'description', 'start_date', 'end_date', 'teacher_id'];

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }
}
