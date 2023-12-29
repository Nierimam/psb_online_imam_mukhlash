<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Informasi User</title>
    <link rel="stylesheet"
        href="../../Users/imammuklas/Documents/LaravelApplication/pmb_online_imam_mukhlash/public/css/pdfview.css">
</head>
<style>
    body {
        font-family: "Arial", sans-serif;
        font-size: 14px;
        background: #fff;
        margin: 0;
        padding: 20px;
    }

    .container {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #000;
        background: #fff;
    }

    .header {
        text-align: center;
        margin-bottom: 30px;
        padding-bottom: 10px;
        border-bottom: 2px solid #000;
    }

    .form-section {
        margin-bottom: 20px;
    }

    .info-block {
        margin-bottom: 20px;
    }

    .info-block h2 {
        font-size: 18px;
        border-bottom: 1px solid #000;
        padding-bottom: 5px;
    }

    .info-section {
        margin-bottom: 10px;
    }

    .info-section label {
        font-weight: bold;
    }

    .info-section p {
        background-color: #e7e7e7;
        /* Light grey background */
        padding: 5px;
        border-left: 3px solid #000;
        /* Thick left border */
    }

    .profile-pic {
        margin: 20px 50px auto;
        overflow: hidden;
        font-weight: bold;
        color: #333;
        text-align: center;
    }

    .profile-pic img {
        width: 50%;
        height: auto;
    }

    .info-container {
        display: flex;
        justify-content: space-between;
        /* This will space out the label and value */
        align-items: center;
        /* This will vertically center them in case they have different heights */
        margin-bottom: 10px;
    }

    .label,
    .value {
        flex: 1;
        /* This will make sure that label and value each take up half of the container */
        padding: 0 5px;
        /* This adds some padding on the sides */
    }

    .label {
        text-align: right;
    }

    h2 {
        color: #333;
    }

    .value {
        text-align: left;
    }

    /* You may need to add media queries to ensure the form is responsive on smaller screens. */
    @media (max-width: 768px) {
        .container {
            padding: 10px;
        }

        .header {
            margin-bottom: 20px;
        }

        .info-block h2 {
            font-size: 16px;
        }

        .info-section p {
            padding: 3px;
        }
    }
</style>

<body>

    <div class="container">
        <div class="header">
            Formulir Pendaftaran Calon Mahasiswa Baru Online
        </div>

        <div class="form-section">
            <!-- Personal Information -->
            <div class="info-block">
                <h2>Data Diri Calon Mahasiswa</h2>
                <div class="info-section">
                    <label>Nama Lengkap</label>
                    <p>{{ $user->nama_lengkap }}</p>
                </div>
                <div class="info-section">
                    <label>Email</label>
                    <p>{{ $user->email }}</p>
                </div>
                <div class="info-section">
                    <label>Alamat KTP</label>
                    <p>{{ $user->alamat_ktp }}</p>
                </div>
                <div class="info-section">
                    <label>Alamat Saat Ini</label>
                    <p>{{ $user->alamat_saat_ini }}</p>
                </div>
                <div class="info-section">
                    <label>Kecamatan</label>
                    <p>{{ $user->kecamatan }}</p>
                </div>
                <div class="info-section">
                    <label>Nomor Telepon</label>
                    <p>{{ $user->nomor_telepon }}</p>
                </div>
                <div class="info-section">
                    <label>Nomor HP</label>
                    <p>{{ $user->nomor_hp }}</p>
                </div>
                <div class="info-section">
                    <label>Jenis Kelamin</label>
                    <p>{{ $user->jenis_kelamin }}</p>
                </div>
                <div class="info-section">
                    <label>Provinsi</label>
                    <p>{{ $user->province ? $user->province->nama_provinsi : 'N/A' }}</p>
                </div>
                <div class="info-section">
                    <label>Kabupaten</label>
                    <p>{{ $user->kabupaten ? $user->kabupaten->nama_kabupaten : 'N/A' }}</p>
                </div>
                <div class="info-section">
                    <label>Kewarganegaraan</label>
                    <p>{{ $user->kewarganegaraan }}</p>
                </div>
                <div class="info-section">
                    <label>Negara Asing</label>
                    @if ($user->negara_asing == NULL)
                    <p> - </p>
                    @endif
                    <p>{{ $user->negara_asing }}</p>
                </div>
                <div class="info-section">
                    <label>Tanggal Lahir</label>
                    <p>{{ $user->tanggal_lahir ? $user->tanggal_lahir->format('Y-m-d') : 'N/A' }}</p>
                </div>
                <div class="info-section">
                    <label>Status Menikah</label>
                    <p>{{ $user->status_menikah }}</p>
                </div>
                <div class="info-section">
                    <label>Agama</label>
                    <p>{{ $user->agama }}</p>
                </div>
                <div class="info-section">
                    <label>Status User</label>
                    <p>{{ $user->status_user }}</p>
                </div>
                <div class="info-section">
                    <label>Role</label>
                    <p>{{ $user->role }}</p>
                </div>
                <div class="info-section">
                    <label>Foto Profile</label>
                    <div class="profile-pic">

                        @if($user->foto_profile && Storage::disk('public')->exists(str_replace('public/', '',
                        $user->foto_profile)))
                        <img src="{{ storage_path('app/public/' . str_replace('public/', '', $user->foto_profile)) }}"
                            alt="Foto Profile" />
                        @else
                        <p>Foto profil tidak tersedia.</p>
                        @endif
                    </div>
                </div>


                <!-- Profile Picture -->


                <!-- Additional sections can be added here -->
            </div>
        </div>

</body>

</html>

{{--
<!DOCTYPE html>
<html>

<head>
    <title>Informasi User</title>
    <style>
        @page {
            margin: 10mm;
        }

        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 12px;
            /* Mengatur ukuran font */
            margin: 0;
            padding: 0;
            background: #f8f8f8;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            padding: 20px;
            justify-content: center;
            background: white;
            margin: 20px auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            /* Batasi lebar maksimum kontainer */
        }

        .info-section {
            margin: 10px;
            padding: 10px;
            flex: 1 1 200px;
            /* Masing-masing blok akan memiliki basis 200px dan fleksibel */
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            background: #fff;
            text-align: center;
            /* Teks di tengah */
        }

        .info-section h2 {
            font-size: 14px;
            margin: 5px 0;
            color: #333;
            text-transform: uppercase;
        }

        .info-section p {
            font-size: 12px;
            margin: 5px 0;
            color: #666;
        }

        .profile-pic {
            text-align: center;
            /* Pusatkan gambar profil */
            padding: 10px;
        }

        .profile-pic img {
            max-width: 100px;
            /* Batasi lebar gambar */
            height: auto;
            border-radius: 50%;
            /* Membuat gambar bulat */
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="profile-pic">
            <!-- Tampilkan foto profil jika ada -->
            @if($user->foto_profile && Storage::disk('public')->exists(str_replace('public/', '', $user->foto_profile)))
            <img src="{{ storage_path('app/public/' . str_replace('public/', '', $user->foto_profile)) }}"
                alt="Foto Profile" />
            @else
            <p>Foto profil tidak tersedia.</p>
            @endif
        </div>

        <div class="info-section">
            <h2>Nama Lengkap</h2>
            <p>{{ $user->nama_lengkap }}</p>
        </div>

        <div class="info-section">
            <h2>Email</h2>
            <p>{{ $user->email }}</p>
        </div>

        <!-- Informasi Alamat KTP -->
        <div class="info-section">
            <h2>Alamat KTP</h2>
            <p>{{ $user->alamat_ktp }}</p>
        </div>

        <!-- Informasi Alamat Saat Ini -->
        <div class="info-section">
            <h2>Alamat Saat Ini</h2>
            <p>{{ $user->alamat_saat_ini }}</p>
        </div>

        <!-- Informasi Kecamatan -->
        <div class="info-section">
            <h2>Kecamatan</h2>
            <p>{{ $user->kecamatan }}</p>
        </div>

        <!-- Informasi Nomor Telepon -->
        <div class="info-section">
            <h2>Nomor Telepon</h2>
            <p>{{ $user->nomor_telepon }}</p>
        </div>

        <!-- Informasi Nomor HP -->
        <div class="info-section">
            <h2>Nomor HP</h2>
            <p>{{ $user->nomor_hp }}</p>
        </div>

        <!-- Informasi Jenis Kelamin -->
        <div class="info-section">
            <h2>Jenis Kelamin</h2>
            <p>{{ $user->jenis_kelamin }}</p>
        </div>

        <!-- Informasi Provinsi -->
        <div class="info-section">
            <h2>Provinsi</h2>
            <p>{{ $user->province ? $user->province->nama_provinsi : 'N/A' }}</p>
        </div>

        <!-- Informasi Kabupaten -->
        <div class="info-section">
            <h2>Kabupaten</h2>
            <p>{{ $user->kabupaten ? $user->kabupaten->nama_kabupaten : 'N/A' }}</p>
        </div>

        <!-- Informasi Kewarganegaraan -->
        <div class="info-section">
            <h2>Kewarganegaraan</h2>
            <p>{{ $user->kewarganegaraan }}</p>
        </div>

        <!-- Informasi Negara Asing -->
        <div class="info-section">
            <h2>Negara Asing</h2>
            <p>{{ $user->negara_asing }}</p>
        </div>

        <!-- Informasi Tanggal Lahir -->
        <div class="info-section">
            <h2>Tanggal Lahir</h2>
            <p>{{ $user->tanggal_lahir ? $user->tanggal_lahir->format('Y-m-d') : 'N/A' }}</p>
        </div>

        <!-- Informasi Status Menikah -->
        <div class="info-section">
            <h2>Status Menikah</h2>
            <p>{{ $user->status_menikah }}</p>
        </div>

        <!-- Informasi Agama -->
        <div class="info-section">
            <h2>Agama</h2>
            <p>{{ $user->agama }}</p>
        </div>

        <!-- Informasi Status User -->
        <div class="info-section">
            <h2>Status User</h2>
            <p>{{ $user->status_user }}</p>
        </div>

        <!-- Informasi Role -->
        <div class="info-section">
            <h2>Role</h2>
            <p>{{ $user->role }}</p>
        </div>
    </div>
</body>

</html> --}}