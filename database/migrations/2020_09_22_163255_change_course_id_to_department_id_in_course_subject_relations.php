<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeCourseIdToDepartmentIdInCourseSubjectRelations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('course_subject_relaions', function (Blueprint $table) {
            $table->renameColumn('course_id', 'department_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('course_subject_relaions', function (Blueprint $table) {
            $table->renameColumn('department_id', 'course_id');
        });
    }
}
