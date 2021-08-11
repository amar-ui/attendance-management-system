<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeacherDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teacher_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->comment('foreign key of user table');
            $table->integer('department_id')->comment('foreign key of department table');
            $table->integer('subject_id')->comment('foreign key of subject table');
            $table->tinyInteger('gender')->comment('1->male, 2->female, 3->other');
            $table->string('phone', 191)->nullable();
            $table->string('address', 191)->nullable();
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
        Schema::dropIfExists('teacher_details');
    }
}
