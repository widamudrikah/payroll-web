<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Bendahara</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('mystle/style.css')}}">
    <style>
        html, body {
            height: 100%;
        }
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
            background-color: #f8f9fa;
        }
        main {
            flex: 1;
        }
    </style>
</head>
<body>

    @include('component.header')

    <!-- Main Content -->
    <main class="container my-4">
        @yield('content')
    </main>
    <!-- Sticky Footer -->
    @include('component.footer')

</body>
</html>
