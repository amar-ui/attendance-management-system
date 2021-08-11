<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttendanceClose extends Model
{
    protected $fillable = [
        'title',
        'total_working_days',
        'department_id',
        'subject_id',
        'semester',
        'date_from',
        'date_to',
        'description',
        'teacher_id'
    ];

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id', 'id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id', 'id');
    }
}
