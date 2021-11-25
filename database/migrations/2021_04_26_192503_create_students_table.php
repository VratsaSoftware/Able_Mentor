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
            $table->string('name', 100);
            $table->integer('age');
            $table->string('email', 100)->unique();
            $table->string('phone', 100);
            $table->unsignedBigInteger('gender_id');
            $table->unsignedBigInteger('city_id');
            $table->string('school', 100);
            $table->unsignedBigInteger('class_id');
            $table->longText('favorite_subjects');
            $table->longText('hobbies');
            $table->unsignedBigInteger('english_level_id');
            $table->unsignedBigInteger('sport_id');
            $table->longText('after_school_plans');
            $table->longText('strong_weak_sides');
            $table->longText('qualities_to_change');
            $table->longText('free_time_activities');
            $table->longText('difficult_situations');
            $table->longText('program_achievments');
            $table->longText('want_to_change');
            $table->integer('hours');
            $table->longText('able_mentor_info_source');
            $table->longText('notes')->nullable();
            $table->timestamps();

            $table->foreign('gender_id')->references('id')->on('genders')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('city_id')->references('id')->on('cities')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('class_id')->references('id')->on('school_classes')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('english_level_id')->references('id')->on('english_levels')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('sport_id')->references('id')->on('sports')->onUpdate('NO ACTION')->onDelete('NO ACTION');
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
