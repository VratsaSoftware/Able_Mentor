<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name', 100);
            $table->string('name_second', 100);
            $table->integer('age');
            $table->string('email', 100);
            $table->string('phone', 100);
            $table->unsignedBigInteger('gender');
            $table->unsignedBigInteger('city');
            $table->string('school', 100);
            $table->unsignedBigInteger('class');
            $table->longText('favorite_subjects');
            $table->longText('hobbies');
            $table->unsignedBigInteger('english_level');
            $table->unsignedBigInteger('sport');
            $table->longText('after_school_plans');
            $table->longText('strong_weak_sides');
            $table->longText('qualities_to_change');
            $table->longText('free_time_activities');
            $table->longText('difficult_situations');
            $table->longText('program_achievments');
            $table->longText('want_to_change');
            $table->unsignedBigInteger('hour_id');
            $table->unsignedBigInteger('project_type_id');
            $table->longText('able_mentor_info_source');
            $table->longText('notes');
            $table->boolean('is_approved');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
