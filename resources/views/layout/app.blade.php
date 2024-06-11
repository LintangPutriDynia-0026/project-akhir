<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    @stack('styles')
    <style>
        /* CSS untuk menambahkan efek hover */
        .dropdown-item:hover {
            background-color: rgba(0, 0, 0, 0.5);
            /* Warna tipis saat hover */
        }

        /* CSS untuk menandai menu yang aktif */
        .dropdown-item.active {
            background-color: rgba(0, 0, 0, 10);
            /* Warna tipis untuk menu aktif */
        }
    </style>
</head>

<body style="background-image: url('{{ asset('images/background.png') }}');">
    <!-- Navbar -->
    @if ($navbar === 'navbar1')
        @include('component.navbar1')
    @elseif ($navbar === 'navbar2')
        @include('component.navbar2')
    @elseif ($navbar === 'navbar3')
        @include('component.navbar3')
    @elseif ($navbar === 'navbar4')
        @include('component.navbar4')
    @elseif ($navbar === 'navbar5')
        @include('component.navbar5')
    @elseif ($navbar === 'navbar6')
        @include('component.navbar6')
    @endif

    <!-- Halaman content -->
    <main class="flex-shrink-0">
        @yield('content')
    </main>

    <!-- Footer Section -->
    @if ($footer === 'footer')
        @include('component.footer')
    @endif

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @stack('scripts')
</body>

</html>
