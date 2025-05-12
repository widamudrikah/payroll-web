<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">
            Payroll <span class="text-warning">{{ Auth::check() ? ucfirst(Auth::user()->role) : '' }}</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                @auth
                    @if(Auth::user()->role === 'bendahara')
                        <li class="nav-item"><a class="nav-link" href="{{ route('manage.employee.index') }}">Kelola Karyawan</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('manage.attendance.index') }}">Rekap Absensi</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('manage.payroll.index') }}">Kelola Gaji</a></li>
                    @elseif(Auth::user()->role === 'karyawan')
                        <li class="nav-item"><a class="nav-link" href="{{ route('employee.dashboard') }}">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('attendance.index') }}">Absensi</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Gaji Saya</a></li>
                    @endif
                @endauth
            </ul>

            <ul class="navbar-nav ms-auto">
                @guest
                    <li class="nav-item">
                        <a class="btn btn-outline-light btn-sm" href="{{ route('login') }}">Login</a>
                    </li>
                @else
                    <li class="nav-item me-2 d-flex align-items-center text-white">
                        👤 {{ Auth::user()->name }}
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="btn btn-outline-light btn-sm">Logout</button>
                        </form>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
