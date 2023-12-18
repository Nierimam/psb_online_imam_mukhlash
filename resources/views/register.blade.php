<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Signup Example</title>
    <link rel="stylesheet" href="../../css/register.css">
    <link rel="stylesheet" href="../../css/alert.css">
</head>

<body>
    <div class="form-wrapper">
        <div class="form-side">
            <form class="my-form" action="{{ route('register.proses') }}" method="POST">
                @include('partials.alert')
                @csrf
                <!-- Token CSRF untuk keamanan -->
                <div class="divider">
                    <span class="divider-line"></span>
                    Register
                    <span class="divider-line"></span>
                </div>
                <!-- Nama Lengkap -->
                <div class="form-grid">
                    <div class="text-field">
                        <label for="nama_lengkap">Nama Lengkap:
                            <input type="text" id="nama_lengkap" name="nama_lengkap" required>
                        </label>
                    </div>

                    <!-- Alamat KTP -->
                    <div class="text-field">
                        <label for="alamat_ktp">Alamat KTP:
                            <input type="text" id="alamat_ktp" name="alamat_ktp">
                        </label>
                    </div>

                    <!-- Alamat KTP -->
                    <div class="text-field">
                        <label for="tempat_lahir">Tempat Lahir:
                            <input type="text" id="tempat_lahir" name="tempat_lahir">
                        </label>
                    </div>

                    <!-- Alamat Saat Ini -->
                    <div class="text-field">
                        <label for="alamat_saat_ini">Alamat Saat Ini:
                            <input type="text" id="alamat_saat_ini" name="alamat_saat_ini">
                        </label>
                    </div>



                    <!-- Provinsi -->
                    <div class="text-field">
                        <label for="province_id">Provinsi:
                            <select id="province_id" name="province_id" required onchange="fetchKabupaten()">
                                <option value="">Pilih Provinsi</option>
                                @foreach ($provinsis as $provinsi)
                                <option value="{{ $provinsi->id }}">{{ $provinsi->nama_provinsi }}</option>
                                @endforeach
                            </select>
                        </label>
                    </div>



                    <!-- Kabupaten -->
                    <div class="text-field">
                        <label for="kabupaten_id">Kabupaten:
                            <select id="kabupaten_id" name="kabupaten_id" required>
                                <option value="">Pilih Kabupaten</option>
                                <!-- Opsi Kabupaten diisi oleh JavaScript -->
                            </select>
                        </label>
                    </div>
                    <!-- Kecamatan -->
                    <div class="text-field">
                        <label for="kecamatan">Kecamatan:
                            <input type="text" id="kecamatan" name="kecamatan">
                        </label>
                    </div>

                    <!-- Nomor Telepon -->
                    <div class="text-field">
                        <label for="nomor_telepon">Nomor Telepon:
                            <input type="number" id="nomor_telepon" name="nomor_telepon">
                        </label>
                    </div>

                    <!-- Nomor HP -->
                    <div class="text-field">
                        <label for="nomor_hp">Nomor HP:
                            <input type="number" id="nomor_hp" name="nomor_hp">
                        </label>
                    </div>

                    <!-- Email -->
                    <div class="text-field">
                        <label for="email">Email:
                            <input type="email" id="email" name="email" required>
                        </label>
                    </div>

                    <!-- Kewarganegaraan -->
                    <div class="text-field">
                        <label>Kewarganegaraan:</label>
                        <select name="kewarganegaraan" id="kewarganegaraan" required>
                            <option value="asli">WNI Asli</option>
                            <option value="keturunan">WNI Keturunan</option>
                            <option value="asing">WNA</option>
                        </select>
                    </div>

                    <!-- Negara Asing -->
                    <div class="text-field">
                        <label for="negara_asing">Negara Asing (jika WNA):</label>
                        <input type="text" id="negara_asing" name="negara_asing" disabled>
                    </div>

                    <!-- Tanggal Lahir -->
                    <div class="text-field-date">
                        <label for="tanggal_lahir">Tanggal Lahir (sesuai ijasah):</label>
                        <input type="date" id="tanggal_lahir" name="tanggal_lahir" required>
                    </div>

                    <!-- Jenis Kelamin -->
                    <div class="text-field">
                        <label>Jenis Kelamin:</label>
                        <select name="jenis_kelamin" required>
                            <option value="pria">Pria</option>
                            <option value="wanita">Wanita</option>
                        </select>
                    </div>

                    <!-- Status Menikah -->
                    <div class="text-field">
                        <label>Status Menikah:</label>
                        <select name="status_menikah" required>
                            <option value="belum_menikah">Belum Menikah</option>
                            <option value="menikah">Menikah</option>
                            <option value="lainnya">Lain-lain (Janda/Duda)</option>
                        </select>
                    </div>

                    <!-- Agama -->
                    <div class="text-field">
                        <label>Agama:</label>
                        <select name="agama" required>
                            <option value="Islam">Islam</option>
                            <option value="Katolik">Katolik</option>
                            <option value="Kristen">Kristen</option>
                            <option value="Hindu">Hindu</option>
                            <option value="Budha">Budha</option>
                            <option value="lainnya">Lain-lain</option>
                        </select>
                    </div>

                    <!-- Password -->
                    <div class="text-field">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                </div>
                <div class="form-actions">
                    <button class="my-form__button" type="submit">
                        Sign up
                    </button>
                    <div class="my-form__actions">
                        <div class="my-form__row">
                            <span>Sign in with your existing account.? Click here
                                <a href="/" title="Reset Password">
                                    Login
                                </a>
                            </span>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="info-side">
            <div class="welcome-message">
                <h2>PSB Online</h2>
            </div>
        </div>
    </div>

    <script>
        function fetchKabupaten() {
        var provinceId = document.getElementById('province_id').value;
        var kabupatenSelect = document.getElementById('kabupaten_id');

        // Bersihkan pilihan kabupaten sebelumnya
        kabupatenSelect.innerHTML = '<option value="">Pilih Kabupaten</option>';

        if (provinceId) {
            // Lakukan request AJAX ke server
            fetch('/get-kabupaten-by-province/' + provinceId)
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
    {{-- <script src="../js/script_login_regis.js"></script> --}}
</body>

</html>