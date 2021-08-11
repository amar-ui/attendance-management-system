<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = ['name', 'head_id', 'description'];

    public function subjectSemensterRelation()
    {
        return $this->hasMany(CourseSubjectRelaions::class, 'department_id', 'id');
    }
}
