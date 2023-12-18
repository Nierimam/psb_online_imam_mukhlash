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
        Schema::table('users', function (Blueprint $table) {
            // Menghapus kolom 'role' yang lama
            $table->dropColumn('role');
        });

        Schema::table('users', function (Blueprint $table) {
            // Menambahkan kolom 'role' yang baru dengan opsi yang diperbarui
            $table->enum('role', ['Admin', 'Murid'])->default('Murid');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Menghapus kolom 'role' yang baru
            $table->dropColumn('role');
        });

        Schema::table('users', function (Blueprint $table) {
            // Mengembalikan kolom 'role' ke keadaan sebelumnya
            $table->enum('role', ['Admin', 'Mahasiswa'])->default('Mahasiswa');
        });
    }
};
