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
        // tabel pelaku
        Schema::create('perpetrators', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nik')->unique();
            $table->string('name');
            $table->date('date_of_birth')->nullable();
            $table->enum("gender", ["P", "L"]);
            $table->unsignedInteger('job_id');
            $table->string('phone_number')->nullable();
            $table->string('email')->nullable();
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
        Schema::dropIfExists('perpetrators');
    }
};
