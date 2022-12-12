<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpouseInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spouse_information', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unique();
            $table->string('name')->nullable();
            $table->string('name_bangla')->nullable();
            $table->integer('nid')->nullable();
            $table->string('designation')->nullable();
            $table->string('occupation')->nullable();
            $table->string('location')->nullable();
            $table->string('home_dist')->nullable();
            $table->string('organization')->nullable();
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
        Schema::dropIfExists('spouse_information');
    }
}
