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
        Schema::table('users', function (Blueprint $table) {
            $table->string('full_name',100)->after('id')->nullable();
            $table->unsignedBigInteger('role_id')->nullable();
            $table->foreign('role_id')->references('id')->on('roles')->onUpdate('cascade')->onDelete('cascade');
            $table->char('status',1)->default(0);
            $table->string('nomor_registrasi_pokok',50)->nullable();
            $table->unsignedInteger('polres_code')->nullable();
            $table->foreign('polres_code')->references('id')->on('master_list_polres')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedInteger('polsek_code')->nullable();
            $table->foreign('polsek_code')->references('id')->on('master_list_polsek')->onUpdate('cascade')->onDelete('cascade');
            $table->string('jabatan',100)->nullable();
            $table->string('no_telepon',20)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
