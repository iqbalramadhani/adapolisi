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
        Schema::create('offender_external_visits', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('offender_id');
            $table->date('date_visit')->nullable();
            $table->time('time_visit_start_at');
            $table->time('time_visit_end_at');
            $table->string('pic_name')->nullable();
            $table->string('pic_position')->nullable();
            $table->string('pic_instance')->nullable();
            $table->string('pic_phone_number')->nullable();
            $table->text('activity')->nullable();
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
        Schema::dropIfExists('offender_external_visits');
    }
};
