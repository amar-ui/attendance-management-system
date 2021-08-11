<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentDetail extends Model
{
    protected $fillable = ['user_id', 'department_id', 'phone', 'gender', 'address', 'year'];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
