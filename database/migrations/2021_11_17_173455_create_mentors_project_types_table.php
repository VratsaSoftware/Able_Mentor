<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMentorsProjectTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mentors_project_types', function (Blueprint $table) {
            $table->unsignedBigInteger('mentor_id');
            $table->unsignedBigInteger('project_type_id');

            $table->foreign('mentor_id')->references('id')->on('mentors');
            $table->foreign('project_type_id')->references('id')->on('project_types')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mentors_project_types');
    }
}
