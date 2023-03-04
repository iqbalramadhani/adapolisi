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
        Schema::create('offenders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('type')->nullable()->comment('1 => Target Berpotensi, 2 => Target Pelaku');
            $table->unsignedInteger('perpetrator_id')->default(0);
            $table->unsignedInteger('admin_id');
            $table->string('adjudication')->nullable(); // cara penyelesaian
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offenders');
    }
};
