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
        Schema::table('offenders', function (Blueprint $table) {
            $table->unsignedInteger('polres_id')->nullable()->after('admin_id');
            $table->unsignedInteger('polsek_id')->nullable()->after('polres_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('offenders', function (Blueprint $table) {
            //
        });
    }
};
