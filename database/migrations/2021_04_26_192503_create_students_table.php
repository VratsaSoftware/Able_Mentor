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
            $table->string('email', 100);
            $table->string('phone', 100);
            $table->unsignedBigInteger('season_id')->nullable();
            $table->unsignedBigInteger('gender_id');
            $table->unsignedBigInteger('city_id')->nullable();
            $table->string('school', 100);
            $table->unsignedBigInteger('class_id');
            $table->text('favorite_subjects');
            $table->text('hobbies');
            $table->unsignedBigInteger('english_level_id');
            $table->unsignedBigInteger('sport_id')->nullable();
            $table->text('after_school_plans');
            $table->text('strong_weak_sides')->nullable();
            $table->text('qualities_to_change');
            $table->text('free_time_activities');
            $table->text('difficult_situations');
            $table->text('program_achievments');
            $table->text('want_to_change');
            $table->integer('hours');
            $table->text('able_mentor_info_source');
            $table->longText('notes')->nullable();
            $table->timestamps();

            $table->unique(['email', 'season_id']);

            $table->foreign('gender_id')->references('id')->on('genders')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('city_id')->references('id')->on('cities')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('class_id')->references('id')->on('school_classes')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('english_level_id')->references('id')->on('english_levels')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('sport_id')->references('id')->on('sports')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('season_id')->references('id')->on('seasons');
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
