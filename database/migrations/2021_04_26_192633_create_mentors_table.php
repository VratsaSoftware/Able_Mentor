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
            $table->integer('age');
            $table->string('email', 100);
            $table->string('phone', 100);
            $table->unsignedBigInteger('gender_id');
            $table->unsignedBigInteger('previous_season_id')->nullable();
            $table->unsignedBigInteger('current_season_id')->nullable();
            $table->unsignedBigInteger('city_id')->nullable();
            $table->text('work');
            $table->text('education');
            $table->text('experience')->nullable();
            $table->text('expertise');
            $table->text('difficult_situations');
            $table->text('want_to_change');
            $table->integer('hours');
            $table->string('cv_path')->nullable();
            $table->text('able_mentor_info');
            $table->longText('notes')->nullable();
            $table->timestamps();

            $table->unique(['email', 'current_season_id']);

            $table->foreign('current_season_id')->references('id')->on('seasons');
            $table->foreign('city_id')->references('id')->on('cities')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('previous_season_id')->references('id')->on('seasons');
            $table->foreign('gender_id')->references('id')->on('genders')->onUpdate('NO ACTION')->onDelete('NO ACTION');
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
