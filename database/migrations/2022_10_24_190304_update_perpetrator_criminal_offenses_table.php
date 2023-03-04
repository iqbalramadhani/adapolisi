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
            $table->dropColumn('crime_key');
            $table->dropColumn('crime_id');
            $table->string('crime')->nullable()->after('police_station');
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
