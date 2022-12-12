<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocalTrainingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('local_training', function (Blueprint $table) {
            $table->id();            $table->unsignedBigInteger('user_id');

            $table->string('course_title');
            $table->string('institution');
            $table->string('position');
            $table->date('from');
            $table->date('to');
            $table->string('duration');
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
        Schema::dropIfExists('local_training');
    }
}
