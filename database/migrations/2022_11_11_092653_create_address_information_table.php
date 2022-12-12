<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('address_information', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unique();
            $table->string('house_permanent');
            $table->string('village_permanent');
            $table->string('post_office_permanent');
            $table->string('upazila_permanent');
            $table->string('district_permanent');
            $table->string('contact_permanent')->nullable();
            $table->string('house_present');
            $table->string('village_present');
            $table->string('post_office_present');
            $table->string('upazila_present');
            $table->string('district_present');
            $table->string('contact_present')->nullable();
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
        Schema::dropIfExists('address_information');
    }
}
