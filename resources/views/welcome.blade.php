
@extends('base')

@section('content')
    <div class="container text-center mt-5">
        <h1 class="display-4 fw-bold">Selamat Datang di Aplikasi Payroll</h1>
        <p class="lead">Sistem penggajian berbasis presensi untuk Karyawan & Bendahara.</p>
        <div class="mt-4">
            <a href="{{ route('login') }}" class="btn btn-primary me-2">Login</a>
            <a href="{{ route('register') }}" class="btn btn-outline-primary">Register</a>
        </div>
    </div>
@endsection