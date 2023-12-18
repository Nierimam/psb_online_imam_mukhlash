<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MuridController extends Controller
{
    //
    public function ShowDashboardMurid()
    {
        $userId = Auth::id(); // Mendapatkan ID pengguna yang saat ini login
        $totalDownloads = Document::where('user_id', $userId)->count(); // Menghitung jumlah download

// Bawa variabel totalDownloads ke view
        return view('murid.dashboard', compact('totalDownloads'));

    }

    public function ShowProfile()
    {
        $userId = Auth::id(); // Mendapatkan ID pengguna yang saat ini login

        // Mengambil data pengguna berdasarkan ID yang login
        $user = User::find($userId);

        // Pastikan pengguna ditemukan
        if (!$user) {
            // Anda dapat melakukan redirect atau menampilkan error jika pengguna tidak ditemukan
            return redirect()->back()->withErrors('User tidak ditemukan.');
        }

        // Bawa variabel user ke view
        return view('murid.profile', compact('user'));
    }

    public function updatePhoto(Request $request)
    {
        $request->validate([
            'foto_profile' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = Auth::user();

        // Pastikan pengguna ditemukan
        if (!$user) {
            return redirect()->back()->withErrors('User tidak ditemukan.');
        }

        // Handle file upload
        if ($request->hasFile('foto_profile')) {
            // Hapus foto lama jika ada
            if ($user->foto_profile && Storage::exists($user->foto_profile)) {
                Storage::delete($user->foto_profile);
            }

            // Simpan foto baru
            $path = $request->file('foto_profile')->store('public/foto_profiles');
            $user->foto_profile = $path;

            // Simpan perubahan pada user
            $user->save(); // Penting untuk menyimpan perubahan ke database
        }

        return redirect()->back()->with('success', 'Foto profil berhasil diperbarui.');
    }

    public function downloadPdf()
    {
        $user = Auth::user(); // Mengambil user yang sedang login
        if (!$user) {
            // Jika tidak ada user yang login, kembalikan error atau lakukan redirect
            return redirect()->back()->withErrors('Tidak ada user yang login.');
        }

        // Membuat nama surat secara acak
        $randomName = Str::random(10); // String acak dengan panjang 10 karakter

        $pdf = PDF::loadView('murid.viewpdf', compact('user'));
        // ->setPaper('a4', 'landscape'); // Mengatur kertas ke ukuran A4 dan orientasi landscape

        // Menyimpan informasi download
        Document::create([
            'user_id' => $user->id,
            'nama_surat' => $randomName,
        ]);

        // Download PDF
        return $pdf->download($randomName . '.pdf');
    }
}
