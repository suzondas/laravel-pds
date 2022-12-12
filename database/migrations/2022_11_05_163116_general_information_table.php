<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class GeneralInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_information', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unique();
            $table->string('fathers_name');
            $table->string('mothers_name');
            $table->date('date_of_birth');
            $table->date('date_of_prl');
            $table->string('rank');
            $table->integer('home_dist');
            $table->integer('designation');
            $table->integer('office_name');
            $table->date('order_date');
            $table->date('join_date');
            $table->integer('gender');
            $table->integer('religion');
            $table->integer('marital_status');
            $table->integer('nid');
            $table->integer('freedom_fighter');
            $table->string('email');
            $table->string('mobile');
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
        Schema::dropDatabaseIfExists('general_information');
    }
}
