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
            $table->string('name_second', 100);
            $table->integer('age');
            $table->string('email', 100);
            $table->string('phone', 100);
            $table->unsignedBigInteger('gender_id');
            $table->foreign('gender_id')->references('id')
                ->on('genders')
                ->onUpdate('NO ACTION')
                ->onDelete('NO ACTION');
            $table->unsignedBigInteger('city_id');
            $table->foreign('city_id')->references('id')
                ->on('cities')
                ->onUpdate('NO ACTION')
                ->onDelete('NO ACTION');
            $table->string('school', 100);
            $table->unsignedBigInteger('class_id');
            $table->foreign('class_id')
                ->references('id')
                ->on('school_classes')
                ->onUpdate('NO ACTION')
                ->onDelete('NO ACTION');
            $table->longText('favorite_subjects');
            $table->longText('hobbies');
            $table->unsignedBigInteger('english_level_id');
            $table->foreign('english_level_id')->references('id')
                ->on('english_levels')
                ->onUpdate('NO ACTION')
                ->onDelete('NO ACTION');
            $table->unsignedBigInteger('sport_id');
            $table->foreign('sport_id')->references('id')
                ->on('sports')
                ->onUpdate('NO ACTION')
                ->onDelete('NO ACTION');
            $table->longText('after_school_plans');
            $table->longText('strong_weak_sides');
            $table->longText('qualities_to_change');
            $table->longText('free_time_activities');
            $table->longText('difficult_situations');
            $table->longText('program_achievments');
            $table->longText('want_to_change');
            $table->string('hours', '50');
            $table->unsignedBigInteger('project_type_id');
            $table->foreign('project_type_id')->references('id')
                ->on('project_types')
                ->onUpdate('NO ACTION')
                ->onDelete('NO ACTION');
            $table->longText('able_mentor_info_source');
            $table->longText('notes');
            $table->boolean('is_approved')->default(0);

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
        Schema::dropIfExists('students');
    }
}
