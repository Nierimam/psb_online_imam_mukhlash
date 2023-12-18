<link rel="stylesheet" href="../../../css/dashboard.css">
@extends('layout.main')

@section('content')
<main class="main-content">
    @include('partials.alert')
    <!-- Konten utama di sini -->
    <h1>Halaman Dashboard</h1>
    <!-- Tambahkan lebih banyak konten sesuai kebutuhan -->
    <div class="content-wrapper">
        <div class="box box-user">
            <i class="bi bi-person-fill" style="font-size: 24px"></i>
            <p>Total Download PDF:</p>
            <br>
            <h2>{{ $totalDownloads }}</h2>
            <!-- Angka dari database -->
        </div>
        <a href="{{ route('users.pdf') }}" class="download-pdf">Unduh PDF <i class="bi bi-arrow-down-square-fill"
                style="font-size: 80px"></i></a>
    </div>
</main>


@endsection