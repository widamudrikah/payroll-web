<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payroll Service</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">Payroll Service</a>
        </div>
    </nav>

    <div class="container text-center mt-5">
        <h1 class="display-4 fw-bold">Selamat Datang di Aplikasi Payroll</h1>
        <p class="lead">Sistem penggajian berbasis presensi untuk Karyawan & Bendahara.</p>
        <div class="mt-4">
            <a href="{{ route('login') }}" class="btn btn-primary me-2">Login</a>
            <a href="{{ route('register') }}" class="btn btn-outline-primary">Register</a>
        </div>
    </div>

    <footer class="text-center mt-5 text-muted">
        <small>&copy; {{ date('Y') }} SMK IDN Boarding School Akhwat</small>
    </footer>

</body>
</html>
