<!-- Navbar UMKM-->
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-dark">
        <div class="container-fluid">
            <!-- Logo Website JUKI -->
            <a class="navbar-brand ms-4" href="{{ route('juki.index') }}">
                <img src="{{ asset('images/logo.png') }}" width="50" height="50" alt="Logo JUKI">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <!-- Menu Halaman Home -->
                    <li class="nav-item">
                        <a class="nav-link active text-white fw-bold" aria-current="page"
                            href="{{ route('juki.index') }}">Home</a>
                    </li>
                    <!-- Menampilkan Menu Halaman UMKM-->
                    <li class="nav-item">
                        <a class="nav-link text-white fw-bold" href="{{ route('umkm') }}">UMKM</a>
                    </li>
                    <!-- Menu Halaman About Us -->
                    <li class="nav-item">
                        <a class="nav-link text-white fw-bold" href="{{ route('about') }}">About
                            Us</a>
                    </li>
                    <!-- Menu Halaman Contact Us -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white fw-bold" href="#" id="navbarDropdown"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Contact Us
                        </a>
                        <ul class="dropdown-menu bg-dark border-3 border-primary" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="https://www.instagram.com/linputri_dynia912/"
                                    target="_blank" style="color: rgb(230, 51, 170);">Instagram</a></li>
                            <li><a class="dropdown-item" href="https://www.facebook.com/lintang.p.dynia/"
                                    target=" _blank" style="color: rgb(96, 96, 202);">Facebook</a></li>
                            <li><a class="dropdown-item" href="https://api.whatsapp.com/send?phone=62895424556262"
                                    target="_blank" style="color: rgb(22, 160, 56);">WhatsApp</a></li>
                        </ul>
                    </li>
                    <!-- Menampilkan Menu Halaman Info Loker -->
                    <li class="nav-item">
                        <a class="nav-link text-white fw-bold" href="{{ route('info-loker') }}">Info
                            Loker</a>
                    </li>
                    <!-- Menu Halaman Service -->
                    <li class="nav-item">
                        <a class="nav-link text-white fw-bold" href="{{ route('service') }}">Service</a>
                    </li>
                    <!-- Menampilkan Menu Halaman Admin Jika yang Login Role SuperAdmin-->
                    @auth
                        @if (Auth::user()->roles[0]->name == 'superadmin')
                            <li class="nav-item">
                                <a class="nav-link active text-info fw-bold" aria-current="page"
                                    href="{{ route('admin.dashboard') }}">Admin
                                    Dashboard</a>
                            </li>
                        @endif
                    @endauth
                </ul>
                <!-- Menampilkan Pencarian UMKM berdasarkan Kota -->
                <div class="ms-1 me-1">
                    <form class="d-flex">
                        <input class="form-control me-2" type="search" placeholder="Cari Kota UMKM"
                            aria-label="Search">
                        <button class="btn btn-info" type="submit">Cari</button>
                    </form>
                </div>
                <!-- Menampilkan Foto Profil, Email, dan Pilihan Menu Setelah Login-->
                <div class="navbar-nav me-4">
                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-warning fw-bold" href="#" id="gmailDropdown"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ Auth::user()->profilePhotoUrl }}" alt="Profile Image"
                                class="rounded-circle me-2" width="30" height="30">
                            {{ Auth::user()->email }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end bg-dark border-3 border-primary"
                            aria-labelledby="gmailDropdown">
                            <li><a class="dropdown-item text-white {{ Request::is('dashboard') ? 'active' : '' }}"
                                    href="{{ route('dashboard') }}"><i
                                        class="bi bi-speedometer2 me-2"></i>Dashboard</a>
                            </li>
                            <li><a class="dropdown-item text-white {{ Request::is('profil') ? 'active' : '' }}"
                                    href="{{ route('profil') }}"><i class="bi bi-person me-2"></i>Profil</a></li>
                            <li><a class="dropdown-item text-white {{ Request::is('loker') ? 'active' : '' }}"
                                    href="{{ route('loker') }}"><i class="bi bi-briefcase me-2"></i>Loker</a></li>
                            <li><a class="dropdown-item text-danger {{ Request::is('logout') ? 'active' : '' }}"
                                    href="{{ route('logout') }}"><i class="bi bi-box-arrow-right me-2"></i>Logout</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>
