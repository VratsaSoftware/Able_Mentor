<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMentorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mentors', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('name_second', 100);
            $table->integer('age');
            $table->string('email', 100);
            $table->string('phone', 100);
            $table->unsignedBigInteger('gender_id');
            $table->foreign('gender_id')->references('id')->on('genders')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->integer('season');
            $table->unsignedBigInteger('city_id');
            $table->foreign('city_id')->references('id')->on('cities')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->longText('work');
            $table->longText('education');
            $table->longText('experience');
            $table->longText('expertise');
            $table->longText('difficult_situations');
            $table->longText('want_to_change');
            $table->integer('hours');
            $table->unsignedBigInteger('project_type_id');
            $table->foreign('project_type_id')->references('id')->on('project_types')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->string('cv_path', 100);
            $table->longText('able_mentor_info');
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
        Schema::dropIfExists('mentors');
    }
}