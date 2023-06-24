<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentFormation extends Model
{
    protected $fillable = ['formation_id', 'student_id'];
    // Add any other properties or methods you need for student formations

    // Define the relationship with Formation
    public function formation()
    {
        return $this->belongsTo(Formation::class);
    }

    // Define the relationship with Student
    public function student()
    {
        return $this->belongsTo(User::class);
    }
}
