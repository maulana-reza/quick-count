<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('formulir', function (Blueprint $table) {
            $table->integer('suara_tidak_sah')->default(0)->after('tps_id')->comment('Jumlah suara tidak sah');
            $table->integer('total_suara')->default(0)->after('suara_tidak_sah')->comment('Total suara yang masuk');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
