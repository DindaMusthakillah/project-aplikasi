<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::create('mutasi_penduduk', function (Blueprint $table) {
        $table->id();
        $table->string('no_kk');
        $table->string('nama_lengkap');
        $table->string('nik')->unique();
        $table->string('jenis_kelamin', 20)->nullable();
        $table->string('tempat_lahir');
        $table->date('tanggal_lahir');
        $table->string('agama');
        $table->string('pendidikan');
        $table->string('jenis_pekerjaan');
        $table->string('golongan_darah')->nullable();
        $table->string('status_perkawinan');
        $table->date('tanggal_perkawinan')->nullable();
        $table->string('status_hubungan_dalam_keluarga');
        $table->string('kewarganegaraan');
        $table->string('nama_ayah');
        $table->string('nama_ibu');
        $table->string('dusun');
        $table->date('tanggal_mutasi')->nullable();
        $table->string('alamat_asal');
        $table->string('alamat_tujuan')->nullable();
        $table->string('status_mutasi')->nullable(); // Contoh: Pindah
        $table->text('keterangan')->nullable();
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mutasi_penduduk');
    }
};