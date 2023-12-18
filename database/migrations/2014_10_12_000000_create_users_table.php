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
        Schema::create('users', function (Blueprint $table) {
            $table->string('nama_lengkap');
            $table->string('alamat_ktp')->nullable();
            $table->string('alamat_saat_ini')->nullable();
            $table->string('kecamatan')->nullable();
            $table->unsignedBigInteger('kabupaten_id')->nullable();
            $table->unsignedBigInteger('province_id')->nullable();
            $table->string('nomor_telepon')->nullable();
            $table->string('nomor_hp')->nullable();
            $table->string('email')->unique();
            $table->enum('kewarganegaraan', ['asli', 'keturunan', 'asing'])->default('asli');
            $table->string('negara_asing')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->enum('jenis_kelamin', ['pria', 'wanita']);
            $table->enum('status_menikah', ['belum_menikah', 'menikah', 'lainnya'])->default('belum_menikah');
            $table->enum('agama', ['Islam', 'Katolik', 'Kristen', 'Hindu', 'Budha', 'lainnya']);
            $table->enum('role', ['Admin', 'Mahasiswa'])->default('Mahasiswa');
            $table->string('password');
            $table->enum('status_user', ["diterima", "pending", "ditolak"])->default("pending");
            $table->rememberToken();
            $table->timestamps();

            // Kunci asing
            $table->foreign('province_id')->references('id')->on('provinsis')->onDelete('set null');
            $table->foreign('kabupaten_id')->references('id')->on('kabupatens')->onDelete('set null');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
