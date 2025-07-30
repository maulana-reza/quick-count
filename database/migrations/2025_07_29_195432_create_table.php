<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::dropIfExists('log');
        Schema::dropIfExists('call_center');
        Schema::dropIfExists('laporan_kejadian');
        Schema::dropIfExists('chart');
        Schema::dropIfExists('formulir');
        Schema::dropIfExists('tps');
        Schema::dropIfExists('saksi');
        Schema::dropIfExists('paslon');
        Schema::table('users', function (Blueprint $table) {
            $table->string('no_hp')->nullable()->after('email');
        });
        Schema::create('paslon', function (Blueprint $table) {
            $table->id();
            $table->string('kepala');
            $table->string('wakil');
            $table->string('no_urut');
            $table->string('foto_kepala')->nullable();
            $table->string('foto_wakil')->nullable();
            $table->timestamps();
        });
        Schema::create('saksi', function (Blueprint $table) {
            $table->id();
            $table->string('nik')->nullable();
            $table->string('nama')->nullable();
            $table->string('tps')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('foto')->nullable();
            $table->timestamps();
        });
        Schema::create('tps', function (Blueprint $table) {
            $table->id();
            $table->string('alamat');
            $table->string('no_tps')->nullable();
            $table->foreignId('village_id')
                ->nullable()
                ->constrained(config('indonesia.villages_table', (new \Laravolt\Indonesia\Models\Village())->getTable()))
                ->cascadeOnDelete();
            $table->timestamps();
        });
        Schema::create('formulir', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Saksi::class, 'saksi_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignId('village_id')
                ->nullable()
                ->constrained(config('indonesia.villages_table', (new \Laravolt\Indonesia\Models\Village())->getTable()))
                ->cascadeOnDelete();
            $table->string('no_formulir')->nullable();
            $table->string('foto')->nullable();
            $table->string('status_form')->default('draft');
            $table->string('laporan_kejadian')->nullable();
            $table->string('foto_kejadian')->nullable();
            $table->string('status_kejadian')->nullable();
            $table->timestamps();
        });
        Schema::create('chart', function (Blueprint $table) {
            $table->id();
            $table->datetime('last_update')->nullable();
            $table->timestamps();
        });
        Schema::create('laporan_kejadian', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Saksi::class, 'saksi_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->string('kejadian');
            $table->string('foto')->nullable();
            $table->timestamps();
        });
        Schema::create('call_center', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('no_hp');
            $table->timestamps();
        });
        Schema::create('log', function (Blueprint $table) {
            $table->id();
            $table->string('aksi');
            $table->string('keterangan')->nullable();
            $table->foreignIdFor(\App\Models\User::class, 'user_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log');
        Schema::dropIfExists('call_center');
        Schema::dropIfExists('laporan_kejadian');
        Schema::dropIfExists('chart');
        Schema::dropIfExists('formulir');
        Schema::dropIfExists('tps');
        Schema::dropIfExists('saksi');
        Schema::dropIfExists('paslon');
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('no_hp');
            $table->string('no_hp')->nullable()->after('email');
        });
    }
};
