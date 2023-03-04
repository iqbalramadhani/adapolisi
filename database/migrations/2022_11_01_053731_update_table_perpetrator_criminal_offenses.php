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
        Schema::table('perpetrator_criminal_offenses', function (Blueprint $table) {
            $table->string('crime')->nullable()->change(); // tipe jenis kejahatan (target potensi/pelaku)
            $table->string('district_court')->nullable()->change(); // pengadilan negeri
            $table->string('police_station')->nullable()->change(); // polres/polsek
            $table->string('adjudication')->nullable()->change(); // penyelesaian
            $table->text('notes')->nullable()->change();
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
