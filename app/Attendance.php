<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = ['date', 'department_id', 'subject_id', 'teacher_id', 'total_students', 'total_present', 'total_absent', 'description', 'semester'];

    public function attendanceLog()
    {
        return $this->hasMany(AttendanceLog::class, 'attendance_id', 'id');
    }

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id', 'id');
    }

    // public function teacherDetails()
    // {
    //     return $this->hasOneThrough(TeacherDetail::class, User::class, 'id', 'user_id', 'teacher_id', 'id');
    // }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id', 'id');
    }
}
