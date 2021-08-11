<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ['name', 'department_id', 'description'];

    public function subjectSemensterRelation()
    {
        return $this->hasMany(CourseSubjectRelaions::class, 'department_id', 'id');
    }

    public function department()
    {
        return $this->hasOne(Department::class, 'id', 'department_id');
    }
}
