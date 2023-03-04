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
        Schema::create('master_list_polsek', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->unsignedInteger('polres_code');
            $table->foreign('polres_code')->references('id')->on('master_list_polres')->onUpdate('cascade')->onDelete('restrict');
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
        Schema::dropIfExists('master_list_polsek');
    }
};
