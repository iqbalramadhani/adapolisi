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
            $table->integer('adjudication')->change()->comment('1 => Restorative Justice, 2 => Pembinaan, 3 => Proses Hukum');
            $table->integer('status')->default(1)->comment('1 => Pendataan, 2 => Tindakan, 3 => Ditutup')->after('admin_id');
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
