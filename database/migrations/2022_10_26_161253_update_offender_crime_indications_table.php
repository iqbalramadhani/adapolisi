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
            $table->unsignedInteger('crime_mode_id')->nullable()->after('motives_id'); // id modus kejahatan
            $table->string('plat_number')->nullable()->after('vehicle_id');
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
