<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeacherDetail extends Model
{
    protected $fillable = ['user_id', 'subject_id', 'department_id', 'phone', 'gender', 'address'];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
