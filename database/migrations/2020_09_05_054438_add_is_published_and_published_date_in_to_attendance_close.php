<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsPublishedAndPublishedDateInToAttendanceClose extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('attendance_closes', function (Blueprint $table) {
            $table->boolean('is_published')->default(0);
            $table->date('publish_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('attendance_closes', function (Blueprint $table) {
            $table->dropColumn('is_published', 'publish_date');
        });
    }
}
