<?php

namespace App\Http\Controllers;

use App\Models\Kabupaten;
use App\Models\Provinsi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    //
    public function index()
    {
        $adminCount = User::where('role', 'Admin')->count();
        $muridCount = User::where('role', 'Murid')->count();

        return view('admin.dashboard', compact('adminCount', 'muridCount'));
    }

    public function ShowListUser()
    {
        $allUsers = User::all();

        return view('admin.list-user', compact('allUsers'));
    }

    public function edit($id)
    {
        $user = User::with('kabupaten')->findOrFail($id); // Pastikan relasi dengan kabupaten terdefinisi
        $provinsis = Provinsi::all(); // Mengambil semua provinsi

        // Jika user memiliki provinsi, ambil kabupaten dari provinsi tersebut
        $kabupatens = collect();
        if ($user->province_id) {
            $kabupatens = Kabupaten::where('province_id', $user->province_id)->get();
        }

        return view('admin.edit-user', compact('user', 'provinsis', 'kabupatens'));

    }

    public function update(Request $request, $id)
    {
        // Validasi request
        $request->validate([
            'nama_lengkap' => 'required|max:255',
            'jenis_kelamin' => 'required',
            'status_menikah' => 'required',
            'tempat_lahir' => 'nullable',
            'agama' => 'required',
            'role' => 'required',
            'province_id' => 'required',
            'kabupaten_id' => 'required',
            'kecamatan' => 'required',
            'alamat_ktp' => 'required',
            'alamat_saat_ini' => 'required',
            'nomor_hp' => 'required',
            'nomor_telepon' => 'required',
            'negara_asing' => 'nullable',
            'kewarganegaraan' => 'required',
            'tanggal_lahir' => 'required|date',
            'email' => 'required|email|unique:users,email,' . $id,
            'foto_profile' => 'nullable|image|max:2048', // Maksimum 2MB
            'status_user' => 'required',
        ]);

        $user = User::findOrFail($id);

        // Handle file upload
        if ($request->hasFile('foto_profile')) {
            // Hapus foto lama jika ada
            if ($user->foto_profile && Storage::exists($user->foto_profile)) {
                Storage::delete($user->foto_profile);
            }

            // Simpan foto baru
            $path = $request->file('foto_profile')->store('public/foto_profiles');
            $user->foto_profile = $path;
        }
        $user->status_user = $request->status_user;

        // Update data user
        $user->update([
            'nama_lengkap' => $request->nama_lengkap,
            'jenis_kelamin' => $request->jenis_kelamin,
            'status_menikah' => $request->status_menikah,
            'tempat_lahir' => $request->tempat_lahir,
            'agama' => $request->agama,
            'role' => $request->role,
            'province_id' => $request->province_id,
            'kabupaten_id' => $request->kabupaten_id,
            'kecamatan' => $request->kecamatan,
            'alamat_ktp' => $request->alamat_ktp,
            'alamat_saat_ini' => $request->alamat_saat_ini,
            'nomor_hp' => $request->nomor_hp,
            'nomor_telepon' => $request->nomor_telepon,
            'negara_asing' => $request->negara_asing,
            'kewarganegaraan' => $request->kewarganegaraan,
            'tanggal_lahir' => $request->tanggal_lahir,
            'email' => $request->email,
            'status_user' => $request->status_user,
            // Tambahkan kolom lain sesuai kebutuhan
        ]);

        // Redirect ke halaman tertentu setelah update berhasil
        return redirect()->route('admin.listusers')->with('success', 'User berhasil diperbarui.');
    }

    public function ShowTambahUser()
    {
        $provinsis = Provinsi::all();

        return view('admin.tambah-user', compact('provinsis'));
    }

    public function getKabupatenByProvince($provinceId)
    {
        $kabupatens = Kabupaten::where('province_id', $provinceId)->get();
        return response()->json($kabupatens);
    }

    public function getProvinsi()
    {
        $provinsi = Provinsi::all();
        return response()->json($provinsi);
    }

    public function store(Request $request)
    {
        // Validasi request
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'kecamatan' => 'nullable',
            'tempat_lahir' => 'nullable',
            'tanggal_lahir' => 'nullable|date',
            'province_id' => 'nullable|exists:provinsis,id',
            'kabupaten_id' => 'nullable|exists:kabupatens,id',
            'alamat_ktp' => 'nullable',
            'alamat_saat_ini' => 'nullable',
            'kewarganegaraan' => 'required',
            'negara_asing' => 'nullable',
            'nomor_hp' => 'nullable|string',
            'jenis_kelamin' => 'required',
            'status_menikah' => 'required',
            'agama' => 'required',
            'role' => 'required|in:Admin,Murid',
            'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Membuat instance user baru
        $user = new User;
        $user->nama_lengkap = $request->nama_lengkap;
        $user->email = $request->email;
        $user->password = Hash::make($request->password); // Hashing the password
        $user->alamat_ktp = $request->alamat_ktp;
        $user->alamat_saat_ini = $request->alamat_saat_ini;
        $user->tempat_lahir = $request->tempat_lahir;
        $user->tanggal_lahir = $request->tanggal_lahir;
        $user->kewarganegaraan = $request->kewarganegaraan;
        $user->negara_asing = $request->negara_asing;
        $user->province_id = $request->province_id;
        $user->kabupaten_id = $request->kabupaten_id;
        $user->kecamatan = $request->kecamatan;
        $user->jenis_kelamin = $request->jenis_kelamin;
        $user->status_menikah = $request->status_menikah;
        $user->agama = $request->agama;
        // $user->status_user = $request->status_user;
        $user->nomor_telepon = $request->nomor_telepon;
        $user->nomor_hp = $request->nomor_hp;
        $user->role = $request->role;

        // Menangani file upload
        if ($request->hasFile('profile_pic')) {
            $file = $request->file('profile_pic');
            $filename = time() . '_' . $file->getClientOriginalName();
            // Simpan file dalam storage dan simpan pathnya di database
            $path = $file->storeAs('public/profile_pictures', $filename);
            $user->profile_pic = $filename;
        }

        // Menyimpan user
        $user->save();

        // Redirect kembali dengan pesan sukses
        return redirect()->route('admin.listusers')->with('success', 'User berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->delete();

        return response()->json(['message' => 'User deleted successfully']);
    }

}
