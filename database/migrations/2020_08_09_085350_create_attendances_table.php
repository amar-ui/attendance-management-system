<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date');
            $table->integer('course_id')->comment('foreign key of courses table');
            $table->integer('subject_id')->comment('foreign key of subjects table');
            $table->integer('teacher_id')->comment('foreign key of users table');
            $table->tinyInteger('semester');
            $table->integer('total_students')->nullable('number of total students in the class');
            $table->integer('total_present')->nullable();
            $table->integer('total_absent')->nullable();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('attendances');
    }
}
