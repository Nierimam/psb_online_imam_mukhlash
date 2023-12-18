<link rel="stylesheet" href="../../../css/edituser.css">
@extends('layout.main')

@section('content')
<main class="main-content">
    @include('partials.alert')
    <h1>Halaman Tambah User</h1>

    <div class="edit-user-container">
        <form action="{{ route('proses.admin.tambahuser') }}" method="post" enctype="multipart/form-data"
            class="edit-user-form">
            @csrf

            <!-- Nama Lengkap Field -->
            <label for="nama_lengkap">Nama Lengkap:</label>
            <input type="text" id="nama_lengkap" name="nama_lengkap" required>

            <!-- Alamat KTP Field -->
            <label for="alamat_ktp">Alamat KTP:</label>
            <input type="text" id="alamat_ktp" name="alamat_ktp">

            <!-- Alamat Saat Ini Field -->
            <label for="alamat_saat_ini">Alamat Saat Ini:</label>
            <input type="text" id="alamat_saat_ini" name="alamat_saat_ini">

            <!-- Kecamatan Field -->
            <label for="kecamatan">Kecamatan:</label>
            <input type="text" id="kecamatan" name="kecamatan">

            <!-- Nomor Telepon Field -->
            <label for="nomor_telepon">Nomor Telepon:</label>
            <input type="number" id="nomor_telepon" name="nomor_telepon">

            <!-- Nomor HP Field -->
            <label for="nomor_hp">Nomor HP:</label>
            <input type="number" id="nomor_hp" name="nomor_hp">

            <!-- Email Field -->
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <!-- Jenis Kelamin Field -->
            <label for="jenis_kelamin">Jenis Kelamin:</label>
            <select id="jenis_kelamin" name="jenis_kelamin">
                <option value="pria">Pria</option>
                <option value="wanita">Wanita</option>
            </select>

            <!-- Provinsi Field -->
            <label for="province_id">Provinsi:</label>
            <select id="province_id" name="province_id" required onchange="fetchKabupaten()">
                <option value="">Pilih Provinsi</option>
                @foreach ($provinsis as $provinsi)
                <option value="{{ $provinsi->id }}">{{ $provinsi->nama_provinsi }}</option>
                @endforeach
            </select>

            <!-- Kabupaten Field -->
            <label for="kabupaten_id">Kabupaten:</label>
            <select id="kabupaten_id" name="kabupaten_id" required>
                <option value="">Pilih Kabupaten</option>
            </select>

            <!-- Kewarganegaraan Field -->
            <label for="kewarganegaraan">Kewarganegaraan:</label>
            <select id="kewarganegaraan" name="kewarganegaraan" required>
                <option value="asli">WNI Asli</option>
                <option value="keturunan">WNI Keturunan</option>
                <option value="asing">WNA</option>
            </select>

            <!-- Negara Asing Field -->
            <label for="negara_asing">Negara Asing (jika WNA):</label>
            <input type="text" id="negara_asing" name="negara_asing">

            <!-- Tanggal Lahir Field -->
            <label for="tanggal_lahir">Tanggal Lahir:</label>
            <input type="date" id="tanggal_lahir" name="tanggal_lahir" required>

            <label for="tempat_lahir"> Tempat Lahir:</label>
            <input type="text" id="tempat_lahir" name="tempat_lahir" required>

            <!-- Status Menikah Field -->
            <label for="status_menikah">Status Menikah:</label>
            <select id="status_menikah" name="status_menikah">
                <option value="belum_menikah">Belum Menikah</option>
                <option value="menikah">Menikah</option>
                <option value="lainnya">Lain-lain (Janda/Duda)</option>
            </select>

            <!-- Agama Field -->
            <label for="agama">Agama:</label>
            <select name="agama" id="agama" required>
                <option value="Islam">Islam</option>
                <option value="Katolik">Katolik</option>
                <option value="Kristen">Kristen</option>
                <option value="Hindu">Hindu</option>
                <option value="Budha">Budha</option>
                <option value="lainnya">Lain-lain</option>
            </select>

            <!-- Foto Profile Field -->
            <label for="foto_profile">Foto Profile:</label>
            <input type="file" id="foto_profile" name="foto_profile">

            <!-- Role Field -->
            <label for="role">Role:</label>
            <select id="role" name="role">
                <option value="Admin">Admin</option>
                <option value="Murid">Murid</option>
            </select>

            <!-- Submit Button -->
            <button type="submit">Tambah User</button>
        </form>
    </div>
</main>


<script>
    function fetchKabupaten() {
            var provinceId = document.getElementById('province_id').value;
            var kabupatenSelect = document.getElementById('kabupaten_id');
    
            // Bersihkan pilihan kabupaten sebelumnya
            kabupatenSelect.innerHTML = '<option value="">Pilih Kabupaten</option>';
    
            if (provinceId) {
                // Lakukan request AJAX ke server
                fetch('/admin/get-kabupaten-by-provinces/' + provinceId)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(function (kabupaten) {
                            var option = new Option(kabupaten.nama_kabupaten, kabupaten.id);
                            kabupatenSelect.add(option);
                        });
                    })
                    .catch(error => console.error('Error:', error));
            }
        }
</script>
<script>
    // Menggunakan DOMContentLoaded untuk memastikan elemen sudah siap sebelum diakses oleh JavaScript
    document.addEventListener('DOMContentLoaded', function() {
        // Mengakses select dan input
        var kewarganegaraanSelect = document.getElementById('kewarganegaraan');
        var negaraAsingInput = document.getElementById('negara_asing');
    
        // Fungsi untuk memperbarui status disabled dari input
        function updateNegaraAsingInput() {
            // Jika 'asing' dipilih, enable input 'negara_asing', jika tidak disable
            negaraAsingInput.disabled = !(kewarganegaraanSelect.value === 'asing');
        }
    
        // Event listener untuk mengubah status disabled ketika nilai select berubah
        kewarganegaraanSelect.addEventListener('change', updateNegaraAsingInput);
    
        // Panggil fungsi ini untuk set state awal ketika halaman dimuat
        updateNegaraAsingInput();
    });
</script>
@endsection