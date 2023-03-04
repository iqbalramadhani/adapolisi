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
        Schema::create('offender_crime_indications', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('offender_id');
            $table->string('crime_key')->nullable(); // tipe jenis kejahatan (target potensi/pelaku)
            $table->unsignedInteger('crime_id')->nullable(); // id jenis kejahatan
            $table->date('date_incident')->nullable();
            $table->unsignedInteger('time_id')->nullable(); // id time pattern
            $table->string('location_incident')->nullable();
            $table->integer('rt')->nullable();
            $table->integer('rw')->nullable();
            $table->integer('province_id')->nullable();
            $table->integer('city_id')->nullable();
            $table->integer('district_id')->nullable();
            $table->integer('subdistrict_id')->nullable();
            $table->boolean('is_indication_alchohol')->default(false); // terindikasi minuman keras atau tidak
            $table->string('how_to_get_alchohol')->nullable();
            $table->boolean('is_indication_drug')->default(false); // terindikasi narkoba atau tidak
            $table->string('how_to_get_drug')->nullable();
            $table->unsignedInteger('equipment_id')->nullable(); // id alat senjata
            $table->unsignedInteger('how_get_equipment_id')->nullable(); // id cara peroleh alat senjata
            $table->unsignedInteger('motives_id')->nullable(); // id motif kejahatan
            $table->unsignedInteger('vehicle_id')->nullable(); // id sarana kendaraan
            $table->text('other_notes')->nullable();
            $table->boolean('is_gang_crime')->default(false);
            $table->string('lead_gang_name')->nullable();
            $table->string('gang_crime_name')->nullable();
            $table->integer('total_gang_member')->nullable();
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
        Schema::dropIfExists('offender_crime_indications');
    }
};
