<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonalInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personal_information', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned();
            $table->string('fathers_name_bangla');
            $table->string('mothers_name_bangla');
            $table->string('fathers_nid')->nullable();
            $table->string('mothers_nid')->nullable();
            $table->string('official_mobile')->nullable();
            $table->string('official_telephone')->nullable();
            $table->string('official_email')->nullable();
            $table->string('etin')->nullable();
            $table->string('nationality');
            $table->string('blood_group')->nullable();
            $table->string('passport_number')->nullable();
            $table->string('passport_exp_date')->nullable();
            $table->string('passport_issue_date')->nullable();
            $table->string('remarks')->nullable();
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
        Schema::dropIfExists('personal_information');
    }
}
