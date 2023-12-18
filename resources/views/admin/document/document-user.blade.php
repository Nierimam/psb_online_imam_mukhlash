<link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" />
<link rel="stylesheet" href="../../css/listusers.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
<meta name="csrf-token" content="{{ csrf_token() }}">
@extends('layout.main')

@section('content')
<main class="main-content">
    @include('partials.alert')
    <!-- Konten utama di sini -->
    <h1>Halaman Document User</h1>
    <div class="card shadow mb-4">
        <div class="table-container">
            <div class="table-actions">
                {{-- <div></div> <!-- Placeholder for left side -->
                <a class="btn btn-info" href="{{ route('admin.tambahuser') }}"><i class="bi bi-person-fill-add"
                        style="font-size: 24px"></i> Tambah User</a> --}}
            </div>
            <div class="table-responsive">
                <table class="table" id="myTable" width="100%">
                    <thead>
                        <tr class="bg-info-subtle text-dark-light">
                            <th scope="col">No</th>
                            <th scope="col">Nama Surat</th>
                            <th scope="col">Nama User</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($documents as $document)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $document->nama_surat }}</td>
                            <td>
                                {{ $document->user->nama_lengkap }}
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="py-6 px-6 text-center">
                    <p class="mb-0 fs-4">Design and Developed by PSB Online</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Tambahkan lebih banyak konten sesuai kebutuhan -->
</main>
@endsection