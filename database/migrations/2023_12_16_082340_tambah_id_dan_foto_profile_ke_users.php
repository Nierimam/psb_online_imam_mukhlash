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
            $table->id(); // Menambahkan kolom id
            $table->string('foto_profile')->nullable()->after('role'); // Menambahkan kolom foto_profile
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('id'); // Menghapus kolom id
            $table->dropColumn('foto_profile'); // Menghapus kolom foto_profile
        });
    }
};
