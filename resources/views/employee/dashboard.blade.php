@extends('base')

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-5 fw-semibold">Dashboard Karyawan</h2>

    <div class="row g-4">
        <!-- Presensi -->
        <div class="col-md-6">
            <div class="card card-custom h-100 text-center p-4 bg-white">
                <h5 class="card-title text-dark">Presensi Harian</h5>
                <p class="card-text">Lakukan presensi kehadiran setiap hari.</p>
                <a href="#" class="btn btn-dark">Presensi Sekarang</a>
            </div>
        </div>

        <!-- Riwayat Gaji -->
        <div class="col-md-6">
            <div class="card card-custom h-100 text-center p-4 bg-white">
                <h5 class="card-title text-dark">Riwayat Gaji</h5>
                <p class="card-text">Lihat detail gaji bulanan kamu.</p>
                <a href="#" class="btn btn-dark">Lihat Gaji</a>
            </div>
        </div>
    </div>
</div>
@endsection