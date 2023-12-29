<link rel="stylesheet" href="../../../css/edituser.css">
@extends('layout.main')

@section('content')
<main class="main-content">
    @include('partials.alert')
    <h1>Edit User</h1>
    <!-- Main content here -->
    <div class="edit-user-container">
        <form action="{{ route('admin.update', $user->id) }}" method="post" enctype="multipart/form-data"
            class="edit-user-form">
            @csrf
            @method('PUT')

            <!-- Nama Lengkap Field -->
            <label for="nama_lengkap">Nama Lengkap:</label>
            <input type="text" id="nama_lengkap" name="nama_lengkap" value="{{ $user->nama_lengkap }}" required>

            <!-- Alamat KTP Field -->
            <label for="alamat_ktp">Alamat KTP:</label>
            <input type="text" id="alamat_ktp" name="alamat_ktp" value="{{ $user->alamat_ktp }}">

            <!-- tempat lahir Saat Ini Field -->
            <label for="alamat_saat_ini">Alamat Saat Ini:</label>
            <input type="text" id="alamat_saat_ini" name="alamat_saat_ini" value="{{ $user->alamat_saat_ini }}">

            <label for="tanggal_lahir">tanggal lahir:</label>
            <input type="text" id="tanggal_lahir" name="tanggal_lahir" value="{{ $user->tanggal_lahir }}">

            <label for="tempat_lahir">Tempat Lahir</label>
            <input type="text" id="tempat_lahir" name="tempat_lahir" value="{{ $user->tempat_lahir }}">

            <!-- Kecamatan Field -->
            <label for="kecamatan">Kecamatan:</label>
            <input type="text" id="kecamatan" name="kecamatan" value="{{ $user->kecamatan }}">

            <!-- Nomor Telepon Field -->
            <label for="nomor_telepon">Nomor Telepon:</label>
            <input type="number" id="nomor_telepon" name="nomor_telepon" value="{{ $user->nomor_telepon }}">

            <!-- Nomor HP Field -->
            <label for="nomor_hp">Nomor HP:</label>
            <input type="number" id="nomor_hp" name="nomor_hp" value="{{ $user->nomor_hp }}">

            <!-- Email Field -->
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ $user->email }}" required>

            {{--
            <!-- Password Field (For display purposes only, don't send password) -->
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="New Password" minlength="6"> --}}

            <!-- Jenis Kelamin Field -->
            <label for="jenis_kelamin">Jenis Kelamin:</label>
            <select id="jenis_kelamin" name="jenis_kelamin">
                <option value="pria" {{ $user->jenis_kelamin == 'pria' ? 'selected' : '' }}>Pria</option>
                <option value="wanita" {{ $user->jenis_kelamin == 'wanita' ? 'selected' : '' }}>Wanita</option>
            </select>

            <label for="province_id">Provinsi:</label>
            <select id="province_id" name="province_id" required onchange="fetchKabupaten()">
                <option value="">Pilih Provinsi</option>
                @foreach ($provinsis as $provinsi)
                <option value="{{ $provinsi->id }}" {{ $user->province_id == $provinsi->id ? 'selected' : '' }}>
                    {{ $provinsi->nama_provinsi }}
                </option>
                @endforeach
            </select>

            <label for="kabupaten_id">Kabupaten:</label>
            <select id="kabupaten_id" name="kabupaten_id" required>
                <option value="">Pilih Kabupaten</option>
                <!-- JavaScript akan mengisi opsi ini berdasarkan provinsi yang dipilih -->
                @foreach ($kabupatens as $kabupaten)
                <option value="{{ $kabupaten->id }}" {{ $user->kabupaten_id == $kabupaten->id ? 'selected' : '' }}>
                    {{ $kabupaten->nama_kabupaten }}
                </option>
                @endforeach
            </select>

            <!-- Kewarganegaraan Field -->
            <label for="kewarganegaraan">Kewarganegaraan:</label>
            <select id="kewarganegaraan" name="kewarganegaraan" required>
                <option value="asli" {{ $user->kewarganegaraan == 'asli' ? 'selected' : '' }}>WNI Asli</option>
                <option value="keturunan" {{ $user->kewarganegaraan == 'keturunan' ? 'selected' : '' }}>WNI
                    Keturunan
                </option>
                <option value="asing" {{ $user->kewarganegaraan == 'asing' ? 'selected' : '' }}>WNA</option>
            </select>

            <!-- Negara Asing Field -->
            <label for="negara_asing">Negara Asing (jika WNA):</label>
            <input type="text" id="negara_asing" name="negara_asing" value="{{ $user->negara_asing }}">

            <!-- Tanggal Lahir Field -->
            <label for="tanggal_lahir">Tanggal Lahir:</label>
            <input type="date" id="tanggal_lahir" name="tanggal_lahir"
                value="{{ $user->tanggal_lahir ? $user->tanggal_lahir->format('Y-m-d') : '' }}" required>

            <label for="status_menikah">Status Menikah:</label>
            <select id="status_menikah" name="status_menikah">
                <option value="belum_menikah" {{ $user->status_menikah == 'belum_menikah' ? 'selected' : '' }}>Belum
                    Menikah</option>
                <option value="menikah" {{ $user->status_menikah == 'menikah' ? 'selected' : '' }}>Menikah</option>
                <option value="lainnya" {{ $user->status_menikah == 'lainnya' ? 'selected' : '' }}>Lain-lain
                    (Janda/Duda)
                </option>
            </select>

            <label for="agama">Agama:</label>
            <select name="agama" id="agama" required>
                <option value="Islam" {{ $user->agama == 'Islam' ? 'selected' : '' }}>Islam</option>
                <option value="Katolik" {{ $user->agama == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                <option value="Kristen" {{ $user->agama == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                <option value="Hindu" {{ $user->agama == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                <option value="Budha" {{ $user->agama == 'Budha' ? 'selected' : '' }}>Budha</option>
                <option value="lainnya" {{ $user->agama == 'lainnya' ? 'selected' : '' }}>Lain-lain</option>
            </select>

            <!-- Jenis Kelamin Field -->
            <label for="status_user">Status User:</label>
            <select id="status_user" name="status_user">
                <option value="diterima" {{ $user->status_user == 'diterima' ? 'selected' : '' }}>Diterima</option>
                <option value="pending" {{ $user->status_user == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="ditolak" {{ $user->status_user == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
            </select>

            <!-- Role Field (assuming it exists in your user model) -->
            <label for="role">Role:</label>
            <select id="role" name="role">
                <option value="Admin" {{ $user->role == 'Admin' ? 'selected' : '' }}>Admin</option>
                <option value="Murid" {{ $user->role == 'Murid' ? 'selected' : '' }}>Murid</option>
            </select>

            <label for="foto_profile">Foto Profile:</label>
            <input type="file" id="foto_profile" name="foto_profile">
            <!-- Menampilkan foto profile yang sudah ada -->
            @if($user->foto_profile)
            <img src="{{ Storage::url($user->foto_profile) }}" alt="Foto Profile" width="100" />
            @endif

            <!-- Submit Button -->
            <button type="submit">Update User</button>
        </form>
    </div>
</main>
{{-- <script>
    function fetchKabupaten() {
        var provinceId = document.getElementById('province_id').value;
        var kabupatenSelect = document.getElementById('kabupaten_id');

        // Bersihkan pilihan kabupaten sebelumnya
        kabupatenSelect.innerHTML = '<option value="">Pilih Kabupaten</option>';

        if (provinceId) {
            // Lakukan request AJAX ke server
            fetch('/admin/get-kabupaten-by-province/' + provinceId)
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    data.forEach(function (kabupaten) {
                        var option = new Option(kabupaten.nama_kabupaten, kabupaten.id);
                        kabupatenSelect.add(option);
                    });
                })
                .catch(error => console.error('Error:', error));
        }
    }
</script> --}}

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