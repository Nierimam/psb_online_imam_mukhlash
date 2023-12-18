<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Menambahkan user Admin
        DB::table('users')->insert([
            'nama_lengkap' => 'Admin User',
            'email' => 'admin@example.com',
            'jenis_kelamin' => 'pria',
            'status_menikah' => 'belum_menikah',
            'agama' => 'Islam',
            'role' => 'Admin',
            'password' => Hash::make('password'), // Ganti dengan password yang aman
            // Tambahkan field lain jika diperlukan
        ]);

        // Menambahkan user Murid
        DB::table('users')->insert([
            'nama_lengkap' => 'Murid User',
            'email' => 'murid@example.com',
            'jenis_kelamin' => 'wanita',
            'status_menikah' => 'belum_menikah',
            'agama' => 'Kristen',
            'role' => 'Murid',
            'password' => Hash::make('password'), // Ganti dengan password yang aman
            // Tambahkan field lain jika diperlukan
        ]);
    }
}
