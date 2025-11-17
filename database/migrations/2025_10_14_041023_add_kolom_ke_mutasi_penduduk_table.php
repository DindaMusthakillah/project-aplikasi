<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up()
{
    Schema::table('mutasi_penduduk', function (Blueprint $table) {
        $table->string('jenis_kelamin')->nullable();
        $table->string('tempat_lahir')->nullable();
        $table->date('tanggal_lahir')->nullable();
        $table->string('agama')->nullable();
        $table->string('pendidikan')->nullable();
        $table->string('jenis_pekerjaan')->nullable();
        $table->string('golongan_darah')->nullable();
        $table->string('status_perkawinan')->nullable();
        $table->date('tanggal_perkawinan')->nullable();
        $table->string('status_hubungan_dalam_keluarga')->nullable();
        $table->string('kewarganegaraan')->nullable();
        $table->string('nama_ayah')->nullable();
        $table->string('nama_ibu')->nullable();
        $table->string('dusun')->nullable();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mutasi_penduduk', function (Blueprint $table) {
            //
        });
    }
};
