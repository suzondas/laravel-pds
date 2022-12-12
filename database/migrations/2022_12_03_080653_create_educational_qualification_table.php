<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEducationalQualificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('educational_qualification', function (Blueprint $table) {
            $table->id();            $table->unsignedBigInteger('user_id');

            $table->string('institute');
            $table->string('principle_subject');
            $table->integer('degree_id');
            $table->integer('pass_year');
            $table->integer('division');
            $table->string('gpa_class');
            $table->string('distinction');
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
        Schema::dropIfExists('educational_qualification');
    }
}
