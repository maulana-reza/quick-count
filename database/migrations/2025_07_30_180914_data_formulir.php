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
        Schema::create('data_formulir', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Formulir::class, 'formulir_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\Paslon::class, 'paslon_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();
            $table->integer('value')->nullable();
            $table->timestamps();
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
