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
        Schema::create('kegiatan', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_selesai')->nullable();
            $table->string('sumber_informasi')->nullable();
            $table->string('kondisi_lapangan')->nullable();
            $table->string('penanganan')->nullable();
            $table->bigInteger('tim_id')->nullable();
            $table->bigInteger('koordinator_id')->nullable();
            $table->string('proses_pengerjaan')->nullable();
            $table->text('keterangan')->nullable();
            $table->text('status')->nullable();
            $table->string('foto1')->nullable();
            $table->string('foto2')->nullable();
            $table->string('foto3')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kegiatan');
    }
};
