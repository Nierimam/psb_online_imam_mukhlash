<?php

namespace App\Http\Controllers;

use App\Models\Kabupaten;
use App\Models\Provinsi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SesiController extends Controller
{
    //
    public function index()
    {
        return view('login');
    }

    public function ProsesLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ], [
            'email.required' => 'Email harus diisi',
            'password.required' => 'Password harus diisi',
        ]);

        // Cek apakah ada user dengan email yang dimasukkan
        $user = User::where('email', $request->email)->first();

        // Jika user ditemukan, cek statusnya
        if ($user) {
            if ($user->status_user == 'pending') {
                return redirect('/')->with('warning', 'Maaf, akun Anda saat ini masih menunggu verifikasi admin. Silakan menunggu dalam 1x24 jam.');
            } elseif ($user->status_user == 'ditolak') {
                return redirect('/')->with('rejected', 'Maaf, akun Anda telah ditolak oleh admin. Mohon periksa kembali isian data Anda.');
            }
        }

        // Lakukan autentikasi jika status user bukan 'pending' atau 'ditolak'
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Lanjutkan dengan pengecekan role
            if (Auth::user()->role == 'Admin') {
                return redirect()->route('admin.dashboard')->with('success', 'Selamat Datang, Admin ' . Auth::user()->name . ' !');
            } elseif (Auth::user()->role == 'Murid') {
                return redirect()->route('murid.dashboard')->with('success', 'Selamat Datang, ' . Auth::user()->nama_lengkap . ' !');
            }
        } else {
            return redirect()->back()->withErrors('Email atau Password anda salah')->withInput();
        }
    }

    public function getProvinsi()
    {
        $provinsi = Provinsi::all();
        return response()->json($provinsi);
    }

    // public function getKabupaten(Request $request)
    // {
    //     $provinsiId = $request->input('provinsi_id');
    //     $kabupaten = Kabupaten::where('province_id', $provinsiId)->get();
    //     return response()->json($kabupaten);
    // }

    public function register()
    {
        $provinsis = Provinsi::all();
        return view('register', compact('provinsis'));
    }

    public function processRegister(Request $request)
    {
        // Validasi data input
        $validatedData = $request->validate([
            'nama_lengkap' => 'required|max:255',
            'alamat_ktp' => 'nullable',
            'alamat_saat_ini' => 'nullable',
            'tempat_lahir' => 'nullable',
            'kecamatan' => 'nullable',
            'province_id' => 'nullable|exists:provinsis,id',
            'kabupaten_id' => 'nullable|exists:kabupatens,id',
            'nomor_telepon' => 'nullable',
            'nomor_hp' => 'nullable',
            'email' => 'required|email|unique:users',
            'kewarganegaraan' => 'required',
            'negara_asing' => 'nullable',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'status_menikah' => 'required',
            'agama' => 'required',
            'password' => 'required|min:6',
        ]);

        // Hash password
        $validatedData['password'] = Hash::make($validatedData['password']);

        // Set role dan status user
        $validatedData['role'] = 'Murid'; // Contoh, sesuaikan dengan kebutuhan
        $validatedData['status_user'] = 'pending'; // Contoh, sesuaikan dengan kebutuhan

        // Buat user baru
        $user = User::create($validatedData);

        // Redirect ke halaman tertentu setelah registrasi sukses
        return redirect('/')->with('success', 'Registrasi berhasil!');
    }

    public function getKabupatenByProvince($provinceId)
    {
        $kabupatens = Kabupaten::where('province_id', $provinceId)->get();
        return response()->json($kabupatens);
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/')->with('success', 'Succesfully Logout You Account');
    }
}
