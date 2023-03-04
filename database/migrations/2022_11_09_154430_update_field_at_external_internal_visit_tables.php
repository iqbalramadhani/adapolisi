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
        Schema::table('offender_internal_visits', function (Blueprint $table) {
            $table->unsignedInteger('offender_id')->nullable()->change();
            $table->time('time_visit_start_at')->nullable()->change();
            $table->time('time_visit_end_at')->nullable()->change();
        });

        Schema::table('offender_external_visits', function (Blueprint $table) {
            $table->unsignedInteger('offender_id')->nullable()->change();
            $table->time('time_visit_start_at')->nullable()->change();
            $table->time('time_visit_end_at')->nullable()->change();
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
