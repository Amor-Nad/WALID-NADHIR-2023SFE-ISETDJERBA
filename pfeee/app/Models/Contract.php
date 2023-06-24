<?php

// app/Models/Contract.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    protected $fillable = [
        'formation_id',
        'teacher_name',
        'start_date',
        'end_date',
        'price',
    ];

    public function formation()
    {
        return $this->belongsTo(Formation::class);
    }
}
