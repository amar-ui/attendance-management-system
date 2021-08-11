<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseSubjectRelaions extends Model
{
    protected $fillable = ['department_id', 'semester', 'subject_id'];
}
