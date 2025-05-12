@extends('base')

@section('content')

<div class="container py-4">
    <h2 class="mb-3 fw-semibold">Absensi Hari Ini</h2>

    @if(session('message'))
    <div class="alert alert-primary" role="alert">
        {{ session('message') }}
    </div>
    @endif

    <!-- Tombol Presensi -->
    @if($hasCheckedInToday)
    <button class="btn btn-secondary" disabled>Kamu sudah absen hari ini</button>
    @else
    <form action="{{ route('attendance.store') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-primary">Absen Sekarang</button>
    </form>
    @endif
    <!-- Tabel Presensi -->
    <h5 class="mb-3">Daftar Presensi Bulan Ini (1 - 25)</h5>
    <div class="table-responsive">
        <table class="table table-bordered bg-white">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Tanggal</th>
                    <th>Jam</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($attendances as $index => $attendance)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $attendance->created_at->format('d M Y') }}</td>
                    <td>{{ $attendance->created_at->format('H:i') }} WIB</td>
                    <td>{{ $attendance->status }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center">Belum ada data presensi bulan ini.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection