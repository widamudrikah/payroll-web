@extends('base')

@section('content')
<div class="container">
    <h2 class="mb-4 fw-semibold">Kelola Data Karyawan</h2>

    <!-- Tombol Tambah -->
    <div class="mb-3 text-end">
        <a href="{{ route('manage.employee.create') }}" class="btn btn-primary">+ Tambah Karyawan</a>
    </div>

    <!-- Tabel Karyawan -->
    <div class="table-responsive">
        @if(session('message'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session(' message ') }}'
            });
        </script>
        @endif

        <table class="table table-bordered table-hover align-middle bg-white">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Dibuat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($employees as $index => $employee)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $employee->user->name }}</td>
                    <td>{{ $employee->user->email }}</td>
                    <td>{{ ucfirst($employee->user->role) }}</td>
                    <td>{{ $employee->created_at->format('d M Y') }}</td>
                    <td>
                        <a href="{{ route('manage.employee.edit', $employee->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <!-- Tombol Hapus -->
                        <form action="{{ route('manage.employee.destroy', $employee->id) }}" method="POST" class="d-inline" id="delete-form-{{ $employee->id }}">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $employee->id }})">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">Belum ada data karyawan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Apakah kamu yakin?',
            text: "Karyawan ini akan dihapus!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Jika tombol "Hapus" diklik, submit form untuk hapus data
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
</script>
@endsection