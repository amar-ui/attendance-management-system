<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseSubjectRelaionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_subject_relaions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('course_id')->comment('foreign key from courses table');
            $table->integer('semester')->comment('semester');
            $table->integer('subject_id')->comment('foreign key from subjects table');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course_subject_relaions');
    }
}
