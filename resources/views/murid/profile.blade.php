<link rel="stylesheet" href="../../../css/change-profile.css">
@extends('layout.main')

@section('content')
<main class="main-content">
    @include('partials.alert')
    <!-- Konten utama di sini -->
    <h1>Halaman Change Profile</h1>
    <!-- Tambahkan lebih banyak konten sesuai kebutuhan -->
    <div class="content-wrapper">
        <div class="box box-user">
            <form action="{{ route('update.photo') }}" method="POST" enctype="multipart/form-data"
                class="form-container">
                @csrf
                @method('PUT')

                <label for="foto_profile" class="form-label">Ubah Foto Profile:</label>
                <input type="file" id="foto_profile" name="foto_profile" required class="input-file">

                <!-- Menampilkan foto profile yang sudah ada -->
                @if($user->foto_profile)
                <img src="{{ Storage::url($user->foto_profile) }}" alt="Foto Profile" class="image-preview" />
                @endif

                <button type="submit" class="submit-button">Ubah Foto</button>
            </form>
        </div>
        <a href="{{ route('users.pdf') }}" class="download-pdf">Unduh PDF <i class="bi bi-arrow-down-square-fill"
                style="font-size: 80px"></i></a>
    </div>
</main>


@endsection