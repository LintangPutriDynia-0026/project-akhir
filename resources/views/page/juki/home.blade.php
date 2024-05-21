@extends('layout.app')
@section('title', 'Home')
@section('content')
    <!-- Home Section -->
    <div class="container my-5">
        <div class="row align-items-center px-4">
            <div class="col-md-5 my-5">
                <img src="{{ asset('images/gambar-hero.png') }}" class="img-fluid mx-auto d-block" alt="Gambar Hero">
            </div>
            <div class="col-md-7 d-flex flex-column justify-content-center">
                <div class="ms-md-5">
                    <h1 class="h4">Hallo!</h1>
                    <h5 class="h1 fw-bold">
                        Selamat Datang di JUKI!
                    </h5>
                    <p class="fw-bold">
                        <b>Jaringan Usaha Kecil Indonesia.</b>
                        <br>Terkoneksi dengan Kreativitas Lokal: Temukan keunikan produk lokal kami
                        <br> yang penuh inspirasi dan cerita di halaman ini. Mari bergabung dalam perjalanan kami
                        menuju keberlanjutan dan keindahan, satu kreasi demi satu kreasi.
                    </p>
                    <button class="btn btn-primary fw-bold w-auto"
                        onclick="window.location.href='{{ route('login') }}';">Join Now!</button>
                </div>
            </div>
        </div>
    </div>
@endsection
