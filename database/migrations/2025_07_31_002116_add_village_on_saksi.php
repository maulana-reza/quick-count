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
        Schema::table('saksi', function (Blueprint $table) {
           $table->foreignId('village_id')
                ->nullable()
                ->after('foto')
                ->constrained(config('indonesia.villages_table' ).(new \Laravolt\Indonesia\Models\Village())->getTable())
                ->cascadeOnDelete();
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
