<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perpetrator_addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('perpetrator_id');
            $table->integer('type')->nullable()->comment('1 => Alamat Orang Tua, 2 => Alamat Pelaku Saat Ini');
            $table->string('address');
            $table->integer('rt');
            $table->integer('rw');
            $table->integer('province_id');
            $table->integer('city_id');
            $table->integer('district_id');
            $table->integer('subdistrict_id');
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
        Schema::dropIfExists('perpetrator_addresses');
    }
};
