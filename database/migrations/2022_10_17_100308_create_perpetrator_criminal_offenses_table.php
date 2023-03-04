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
        Schema::create('perpetrator_criminal_offenses', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('perpetrator_id');
            $table->string('crime_key'); // tipe jenis kejahatan (target potensi/pelaku)
            $table->unsignedInteger('crime_id'); // id jenis kejahatan
            $table->string('district_court'); // pengadilan negeri
            $table->string('police_station'); // polres/polsek
            $table->string('adjudication'); // penyelesaian
            $table->text('notes');
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
        Schema::dropIfExists('perpetrator_criminal_offenses');
    }
};
