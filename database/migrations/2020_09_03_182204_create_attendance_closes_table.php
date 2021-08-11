<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendanceClosesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendance_closes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->integer('teacher_id')->comment('foreign key from users');
            $table->integer('course_id')->comment('foreign key from course table');
            $table->integer('semester');
            $table->integer('subject_id')->comment('foreign key from subject table');
            $table->date('date_from');
            $table->date('date_to');
            $table->integer('total_working_days')->default(0);
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
        Schema::dropIfExists('attendance_closes');
    }
}
