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
        Schema::table('offender_crime_indications', function (Blueprint $table) {
            $table->bigInteger('province_id')->change();
            $table->bigInteger('city_id')->change();
            $table->bigInteger('district_id')->change();
            $table->bigInteger('subdistrict_id')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
