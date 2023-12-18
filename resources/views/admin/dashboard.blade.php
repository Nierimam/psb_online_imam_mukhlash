<link rel="stylesheet" href="../../css/dashboard.css">
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
            <p>Total Murid:</p>
            <br>
            <h2>{{ $muridCount }}</h2>
            <!-- Angka dari database -->

        </div>
        <div class="box box-admin">
            <i class="bi bi-person-fill-gear" style="font-size: 24px"></i>
            <p>Total Admin:</p>
            <!-- Angka dari database -->
            <br>
            <h2>{{ $adminCount }}</h2>
        </div>
    </div>
</main>


@endsection